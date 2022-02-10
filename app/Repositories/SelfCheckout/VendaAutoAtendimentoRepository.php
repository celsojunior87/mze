<?php

namespace App\Repositories\SelfCheckout;

use App\Http\Requests\VendaRequest;
use App\Interfaces\SelfCheckout\VendaAutoAtendimentoInterface;
use App\Models\ContaReceber;
use App\Models\Estoque;
use App\Models\Filial;
use App\Models\Status;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\VendaStatus;
use App\Models\VendaTipoPagamento;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class VendaAutoAtendimentoRepository implements VendaAutoAtendimentoInterface
{

    public function __construct(Venda $model)
    {
        $this->model = $model;
    }
    // Use ResponseAPI Trait in this repository
    use Response;

    public function UpdateCancelVenda(VendaRequest $request, $id)
    {
        try {
            $venda = Venda::find($id);
            if (!$venda) return $this->error("Não Existe o Venda $id", 404);
            $venda->dt_cancelamento =  now();
            $venda->update();
            return response()->json(['Venda cancelada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json([$e], 500);
        }
    }

    public function search($request)
    {
        $usuarioId = 1;

        if ($usuarioId) {
            $venda = Venda::where('clientes_id', $usuarioId)
                ->with('filial', 'endereco', 'vendaItem', 'vendaStatus', 'TipoPagamento', 'produto')
                ->when($request->has('enderecos_id'), function ($q) use ($request) {
                    return $q->where('enderecos_id', $request->enderecos_id);
                })->get();

            return $this->success(
                "Lista de Vendas",
                $venda,
                200
            );
        } else {
            return response()->json(['Não existe Vendas para esse Usuário'], 200);
        }
    }

    public function insert($request)
    {
        if (!$request->token_filial) {
            return $this->error("O token é obrigatório", 401);
        }
        $filial = Filial::where(['token_filial' => $request->token_filial])->get()->toArray();
        $filial_id = $filial[0]['id'];

        $validaValoresVenda = $this->validaValoresVenda($request);

        if (!$validaValoresVenda) {
            return $this->error("O valor total não bate com a soma dos valores dos itens.", 401);
        }

        $cliente_id = 1;
        $vendaAprovada = true;

        DB::beginTransaction();
        try {
            if ($vendaAprovada) {
                //STATUS PEDIDO

                $venda = $this->createVenda($request, $cliente_id);
                $venda->save();

                $this->createVendaItens($venda['id'], $request->venda_itens, $filial_id);

                $cadastraStatus = $this->cadastraStatus($venda->id, $venda->retirada);

                if ($cadastraStatus === false) {
                    DB::rollBack();
                    return $this->error("Erro ao cadastrar status", 401);
                }

                $contaReceber = $this->createContasReceber($venda);
                $contaReceber->save();

                $this->updateEstoque($request->venda_itens, $filial_id);

                DB::commit();
                $result = ['status_venda' => 'Venda concluida com sucesso.'];
                return $this->success(
                    "Vendas Criado com sucesso",
                    $result,
                    200
                );

                $tipoPagamento = $this->createTipoPagamento($request->tipo_pagamento_id, $venda->id);
                $tipoPagamento->save();

                $statusPagamento = $this->createStatusPedido($venda);
                $statusPagamento->save();
            } else {
                return $this->error("Venda negada pelo emissor do cartão", 401);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([$e], 500);
        }
    }


    public function createVenda($arrayVendas, $user)
    {

        $venda = new Venda();
        $venda->dt_venda = Carbon::now();
        $venda->vl_total = $arrayVendas['vl_total'];
        $venda->vl_desconto = 0;
        $venda->avaliacao = 5;
        $venda->clientes_id = $user;
        $venda->enderecos_id = 1;
        $venda->agendado = 0;
        $venda->retirada = 0;
        $venda->num_pedido = $this->gerarNumPedido();
        return $venda;
    }

    public function gerarNumPedido()
    {
        $num_pedido = strtoupper(substr(md5(mt_rand()), 0, 6));
        $this->verificarExistenciaNumPedido($num_pedido);
        return $num_pedido;
    }

    public function verificarExistenciaNumPedido($num_pedido)
    {
        $query = DB::table('tb_vendas')->where('num_pedido', $num_pedido)->first();
        if ($query) {
            $num_pedido = $this->gerarNumPedido();
        }
    }

    public function createTipoPagamento($idTipoPagamento, $idVenda)
    {
        if ($idTipoPagamento and $idVenda) {
            $tipoPagamento = new VendaTipoPagamento();
            $tipoPagamento->tipo_pagamento_id = $idTipoPagamento;
            $tipoPagamento->vendas_id = $idVenda;
            return $tipoPagamento;
        } else {
            return $this->error("O id_tipo_pagamento é obrigatorio", 401);
        }
    }

    public function createStatusPedido($venda)
    {
        if ($venda) {
            $statusPagamento = new VendaStatus();
            $statusPagamento->dt_atualizacao = $venda->dt_venda;
            $statusPagamento->vendas_id = $venda->id;
            $statusPagamento->status_id = 5;

            return $statusPagamento;
        } else {
            return $this->error("O id_tipo_pagamento é obrigatorio", 401);
        }
    }

    public function createVendaItens($idVenda, $vendaItens, $filial_id)
    {
        foreach ($vendaItens as $arrVendaItem) {
            $vendaItem = new VendaItem();
            $vendaItem->qt_pedida = $arrVendaItem['qt_pedida'];
            $vendaItem->qt_atendida = $arrVendaItem['qt_atendida'];
            $vendaItem->valor = $arrVendaItem['valor'];
            $vendaItem->vl_desconto = 0.00;
            $vendaItem->perc_desc = 0;
            $vendaItem->filiais_id = $filial_id;
            $vendaItem->perc_comissao = 0;
            $vendaItem->vendas_id = $idVenda;
            $vendaItem->produtos_id = $arrVendaItem['produtos_id'];

            $vendaItem->save();
        }
    }

    /**
     * Valida valores do pedido
     */
    public function validaValoresVenda($dados)
    {
        $totalItens = 0;
        $totalItem = 0;

        foreach ($dados->venda_itens as $item) {
            $totalItens = $item['valor'] * $item['qt_pedida'];
            $totalItem += $totalItens;
        }

        if (trim($dados->vl_total) != trim($totalItem)) {
            return false;
        }
        return true;
    }

    /**
     * Verifica o status na tabela de status e salva na tabela de venda_status
     */
    public function cadastraStatus($idVenda)
    {
        DB::beginTransaction();
        try {

            $status = Status::where('fluxo', '=', 'RETIRAR')->get()->toArray();
            $tamanhoArr = count($status);
            foreach ($status as $key => $statusVenda) {
                if ($tamanhoArr == $key + 1) {
                    return '';
                }
                $vendaStatus = new VendaStatus();
                $vendaStatus->dt_atualizacao = Carbon::now();
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
     * Salva os dados na tabela de contas a receber
     */
    public function createContasReceber($venda)
    {
        $contasReceber = new ContaReceber();
        $contasReceber->vl_total = $venda->vl_total;
        $contasReceber->dt_pagamento = $venda->dt_venda;
        $contasReceber->vendas_id = $venda->id;

        return $contasReceber;
    }

    /**
     * Atualiza itens no estoque
     */
    public function updateEstoque($venda, $filial_id)
    {

        foreach ($venda as $item) {
            /*save estoque*/
            $estoque = new Estoque();
            $estoque->quantidade = $item['qt_atendida'];
            $estoque->produtos_id = $item['produtos_id'];
            $estoque->filiais_id =  $filial_id;


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
}
