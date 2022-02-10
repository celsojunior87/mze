<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\VendaAvaliacaoRequest;
use App\Http\Requests\VendaInsertRequest;
use App\Interfaces\Cliente\VendaClienteInterface;
use App\Models\CobrancaCliente;
use App\Models\Estoque;
use App\Models\FilaVendaFilial;
use App\Models\Status;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\VendaStatus;
use App\Service\CardValidationService;
use App\Service\CieloService;
use App\Traits\Response;
use App\Traits\VendaUtilitarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service\NotificationService;


class VendaClienteRepository implements VendaClienteInterface
{

    public function __construct(
        Venda $model,
        CieloService $cieloService,
        CardValidationService $cardValidationService,
        NotificationService $notificationService
    ) {
        $this->cardValidationService = $cardValidationService;
        $this->model = $model;
        $this->cieloService = $cieloService;
        $this->notificationService = $notificationService;
    }

    // Use ResponseAPI Trait in this repository
    use Response, VendaUtilitarios;

    public function UpdateCancelVenda($request)
    {
        try {
            $venda = Venda::find($request->vendas_id);

            $status = Status::where('id', $venda->status_id)->first();

            $fluxo = $status->fluxo;
            if (!$venda) return $this->error("Não Existe o Venda $request->vendas_id", 404);

            $venda->dt_cancelamento = Carbon::now();
            $venda->status_id = 6;
            if ($fluxo == 'RECEBER') {
                $venda->status_id = 13;
            }
            $venda->update();
            return $this->success(
                "Venda cancelada com sucesso",
                $venda,
                200
            );
        } catch (\Exception $e) {
            return response()->json([$e], 500);
        }
    }


    public function UpdateAvaliacaSocio(VendaAvaliacaoRequest $request, $id)
    {
        try {
            $venda = Venda::find($id);
            if (!$venda) return $this->error("Não Existe o Venda $id", 404);
            $venda->avaliacao = $request->avaliacao;
            $venda->update();
            return response()->json(['Avaliação efetuada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json([$e], 500);
        }
    }

    public function search($request)
    {
        $user = Auth::user();

        if ($user) {
            $venda = Venda::where('clientes_id', $user->id)->orderby('id', 'DESC')
                ->with('endereco', 'vendaItem', 'vendaItem.produto', 'vendaStatus')->get();
            return $this->success(
                "Lista de Vendas",
                $venda,
                200
            );
        } else {
            return response()->json(['Não existe Vendas para esse Usuário'], 200);
        }
    }


    public function listPartners($request)
    {
        $user = Auth::user();

        if ($user) {
            $vendasItens = VendaItem::where('vendas_id', $request->vendas_id)->with('filial')->get()->unique('filiais_id');

            $partners = [];
            foreach ($vendasItens as $key => $item) {
                $partners[$key] = $item->filial;
                $partners[$key]["itens"] = VendaItem::where('vendas_id', $request->vendas_id)->where('filiais_id', $item->filiais_id)->with('produto')->get();
            }

            return $this->success(
                "Lista de filiais da venda",
                $partners,
                200
            );
        } else {
            return response()->json(['Não existe Vendas para esse Usuário'], 403);
        }
    }

    /**
     * Toda a Operação do fluxo da venda
     */
    public function insert(VendaInsertRequest $request)
    {

        $user = Auth::user();
        if (!$user) {
            return $this->error("Favor fazer o login", 401);
        }

        $validaValoresVenda = $this->validaValoresVenda($request);
        if (!$validaValoresVenda) {
            return $this->error("O valor total não bate com a soma dos valores dos itens.", 200);
        }

        $vendaAprovada = true;

        DB::beginTransaction();
        try {
            if ($vendaAprovada) {

                $venda = $this->createVenda($request->venda, $user);
                $cobrancaCliente = CobrancaCliente::find($venda->cobrancas_clientes_id);
                if (!$cobrancaCliente) {
                    return $this->error("Cobrança cliente id não encontrada.", 403);
                }

                $this->cieloService->peyerCreditToken($venda->vl_total, $cobrancaCliente->titular, $request->cvv, $cobrancaCliente->token);

                $venda->save();
                DB::commit();

                $this->createVendaItens($venda['id'], $request['venda']['venda_itens']);


                $consultaStatus = $this->consultarStatus($venda->id, $venda->retirada);

                if ($consultaStatus === false) {
                    return $this->error("Erro ao cadastrar status", 403);
                }


                $this->encontraVendedores($venda->id);


                $vendedores = FilaVendaFilial::where('vendas_id', $venda->id)
                    ->join('tb_vendas', 'tb_vendas.id', 'tb_filas_vendas_filiais.vendas_id')
                    ->join('tb_filiais', 'tb_filiais.id', 'tb_filas_vendas_filiais.filiais_id')
                    ->select(
                        'num_pedido',
                        'socios_id'
                    )
                    ->distinct('filiais_id')
                    ->get();

                $venda = Venda::find($venda->id);
                foreach ($vendedores as $v) {
                    $this->notificationService
                        ->sendNotificationMessageToSocio(
                            [
                                "titulo" => "Solicitação de pedido #" . $v->num_pedido,
                                "descricao" => "Aceitar Pedido?",
                                "user_id" => $v->socios_id,
                                "data" => $venda
                            ]
                        );
                }

                DB::commit();

                $result = ['status_venda' => 'Venda concluida com sucesso.'];
                return $this->success(
                    "Vendas Criado com sucesso",
                    $result,
                    200
                );
            }
            return $this->error("Venda negada pelo emissor do cartão", 403);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([$e], 500);
        }
    }

    /**
     * Salva os dados da venda Item
     */
    public function createVendaItens($idVenda, $vendaItens)
    {
        foreach ($vendaItens as $arrVendaItem) {
            $vendaItem = new VendaItem();
            $vendaItem->qt_pedida = $arrVendaItem['qt_pedida'];
            //$vendaItem->dt_atualizacao = $arrVendaItem['dt_atualizacao'];
            $vendaItem->valor = $arrVendaItem['valor'];
            $vendaItem->vl_desconto = $arrVendaItem['vl_desconto'];
            $vendaItem->perc_desc = $arrVendaItem['perc_desc'];
            if (!empty($arrVendaItem['filiais_id'])) {
                $vendaItem->filiais_id = $arrVendaItem['filiais_id'];
            }
            $vendaItem->perc_comissao = $arrVendaItem['perc_comissao'];
            $vendaItem->vendas_id = $idVenda;
            $vendaItem->produtos_id = $arrVendaItem['produtos_id'];

            $vendaItem->save();
        }
    }

    /**
     * Verifica o status na tabela de status e salva na tabela de venda_status
     */
    public function consultarStatus($idVenda, $retirada)
    {
        DB::beginTransaction();
        try {
            $status = Status::whereIn('fluxo', ['RECEBER'])->get()->toArray();

            if ($retirada == 1) {
                $status = Status::whereIn('fluxo', ['RETIRAR'])->get()->toArray();
            }

            foreach ($status as $key => $statusVenda) {
                $vendaStatus = new VendaStatus();
                if ($key == 0) {
                    $vendaStatus->dt_atualizacao = Carbon::now();
                }
                $vendaStatus->vendas_id = $idVenda;
                $vendaStatus->status_id = $statusVenda['id'];
                $vendaStatus->save();
                DB::commit();
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Save Vendas
     */
    public function createVenda($arrayVendas, $user)
    {

        try {
            $venda = new Venda();
            $venda->dt_venda = Carbon::now();
            $venda->vl_total = $arrayVendas['vl_total'];
            $venda->vl_desconto = $arrayVendas['vl_desconto'];
            $venda->clientes_id = $user->id;
            $venda->retirada = $arrayVendas['retirada'];
            $venda->status_id = 7;
            if ($arrayVendas['retirada'] == true) {
                $venda->status_id = 1;
            }
            $venda->cobrancas_clientes_id = $arrayVendas['cobrancas_clientes_id'];
            $venda->cupom_descontos_id = $arrayVendas['cupom_descontos_id'];
            $venda->enderecos_id = $arrayVendas['enderecos_id'] ?? 1;
            $venda->agendado = $arrayVendas['agendado'] ?? 0;
            $venda->num_pedido = $this->gerarNumPedido();
            return $venda;
        } catch (\Throwable $e) {
            return response()->json([$e], 500);
        }
    }

    /**
     * Gera numero do pedido
     */
    public function gerarNumPedido()
    {
        $num_pedido = strtoupper(substr(md5(mt_rand()), 0, 6));
        $this->verificarExistenciaNumPedido($num_pedido);
        return $num_pedido;
    }

    /**
     * Verifica Existencia numero do Pedido
     */
    public function verificarExistenciaNumPedido($num_pedido)
    {
        $query = DB::table('tb_vendas')->where('num_pedido', $num_pedido)->first();
        if ($query) {
            $num_pedido = $this->gerarNumPedido();
        }
    }

    /**
     * Atualiza itens no estoque
     */
    public function updateEstoque($venda)
    {


        foreach ($venda['venda_itens'] as $item) {


            /*save estoque*/
            $estoque = new Estoque();
            $estoque->quantidade = $item['qt_pedida'];
            $estoque->produtos_id = $item['produtos_id'];
            $estoque->filiais_id = $item['filiais_id'];


            $prod = Estoque::where([
                ['produtos_id', $estoque->produtos_id],
                ["filiais_id", $estoque->filiais_id]
            ])->get()->toArray();

            $qtd_antiga = 0;
            if (array_key_exists('0', $prod)) {
                $qtd_antiga = $prod[0]['quantidade'];
            }
            $teste = Estoque::updateOrCreate(
                [
                    "produtos_id" => $estoque->produtos_id,
                    "filiais_id" => $estoque->filiais_id
                ],
                [
                    "produtos_id" => $estoque->produtos_id,
                    "filiais_id" => $estoque->filiais_id,
                    "quantidade" => $qtd_antiga - $estoque->quantidade
                ]

            );
            DB::commit();
        }
    }

    /**
     * Valida valores do pedido
     */
    public function validaValoresVenda($dados)
    {
        $totalItem = 0;
        foreach ($dados->venda['venda_itens'] as $itens) {
            $totalItem += ($itens['valor'] * $itens['qt_pedida']);
        }

        if (round($dados->venda['vl_total'], 2) != round($totalItem, 2)) {
            return false;
        }

        return true;
    }
}
