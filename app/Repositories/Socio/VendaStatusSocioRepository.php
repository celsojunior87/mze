<?php

namespace App\Repositories\Socio;

use App\Http\Requests\VendaStatusRequest;
use App\Interfaces\Socio\VendaStatusSocioInterface;
use App\Models\ContaReceber;
use App\Models\Estoque;
use App\Models\FilaVendaFilial;
use App\Models\Status;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\VendaStatus;
use App\Service\NotificationService;
use App\Traits\Response;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaStatusSocioRepository implements VendaStatusSocioInterface
{

    public function __construct(VendaStatus $model, NotificationService $notificationService)
    {
        $this->model = $model;
        $this->notificationService = $notificationService;
    }

    // Use ResponseAPI Trait in this repository
    use Response;

    public function getAll()
    {
        try {
            $vendaStatus = VendaStatus::all();
            return $this->success("Lista do Status na venda", $vendaStatus);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }


    public function update(VendaStatusRequest $request, $id = null)
    {
        $user = Auth::id();

        if (!$user) {

            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 401);
        }

        if (!$request->vendas_id) {
            return $this->error('O vendas_id é obrigatório.', 400);
        }

        if (!$request->filiais_id) {
            return $this->error('O filiais_id é obrigatório.', 400);
        }

        DB::beginTransaction();
        try {
            $venda = Venda::find($request->vendas_id);

            $status = Status::find($venda->status_id);

            $ordem = Status::where('ordem', $status->ordem + 1)->where('fluxo', $status->fluxo)->first();

            $vendaItem = VendaItem::where('vendas_id', $venda->id)
                ->first();
            if ($vendaItem->filiais_id != null && $vendaItem->filiais_id != $request->filiais_id) {
                return $this->error('Esta venda foi aceita por outro sócio.', 400);
            }

            if ($ordem->id == 6 || $ordem->id == 13) {
                return $this->error('A venda já foi finalizada.', 400);
            }

            $venda->status_id = $ordem->id;
            $venda->save();

            VendaStatus::where('vendas_id', $venda->id)
                ->where('status_id', $venda->status_id)
                ->update(['dt_atualizacao' => Carbon::now()]);


            if ($ordem->ordem == 2) {
                VendaItem::where('vendas_id', $venda->id)
                    ->update(['filiais_id' => $request->filiais_id]);

                FilaVendaFilial::where('filiais_id', $request->filiais_id)
                    ->where('vendas_id', $venda->id)
                    ->update(['dt_aceite' => Carbon::now()]);
            }

            if ($ordem->ordem == 4) {
                $vendaItens = VendaItem::where('vendas_id', $venda->id)->get();
                $this->updateEstoque($vendaItens);
            }

            if ($ordem->ordem == 5 || $ordem->ordem == 12) {
                $vendaItens = VendaItem::where('vendas_id', $venda->id)->get();
                $valorTotal = 0;
                foreach ($vendaItens as $item) {
                    $porcentagem = $item->perc_comissao / 100;
                    $vl_comissao = $item->valor * $porcentagem;
                    $vl_comissaoTotal = ($item->valor * $porcentagem) * $item->qt_pedida;
                    VendaItem::where('id', $item->id)
                        ->update(['qt_atendida' => $item->qt_pedida, 'vl_comissao' => $vl_comissao]);
                    $valorTotal += $vl_comissaoTotal;
                }
                $valorTotal = number_format($valorTotal, 2, '.', '');
                $venda = Venda::where('id', $venda->id)->first();
                $venda->vl_repasse = $valorTotal;
                $contaReceber = $this->createContasReceber($venda);
                $contaReceber->save();
            }

            DB::commit();

            $vendaStatus = VendaStatus::where('vendas_id', $venda->id)->get();

            $this->notificationService->sendNotificationMessageToCliente(
                [
                    "titulo" => "Status do pedido #" . $venda->num_pedido . " alterado", "descricao" => "Status alterado para: " . Status::find($ordem->id)->descricao,
                    "user_id" => $venda->clientes_id,
                    "vendaStatus" => $vendaStatus
                ]
            );
            return $this->success('Status atualizado com sucesso.', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }


    public function delete($id)
    {
    }

    /**
     * Atualiza itens no estoque
     */
    public function updateEstoque($vendaItens)
    {
        foreach ($vendaItens as $item) {
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

            Estoque::updateOrCreate(
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
     * Salva os dados na tabela de contas a receber
     */
    public function createContasReceber($venda)
    {
        $contasReceber = new ContaReceber();
        $contasReceber->vl_total = $venda->vl_total;
        $contasReceber->dt_pagamento = $venda->dt_venda;
        $contasReceber->vl_repasse = $venda->vl_repasse;
        $contasReceber->dt_repasse = new DateTime("Wednesday");
        $contasReceber->vendas_id = $venda->id;

        return $contasReceber;
    }
}
