<?php

namespace App\Repositories\Socio;


use App\Interfaces\Socio\VendaSocioInterface;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Estoque;
use App\Models\FilaVendaFilial;
use App\Models\Status;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\VendaStatus;
use App\Traits\Response;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Traits\VendaUtilitarios;

class VendaSocioRepository implements VendaSocioInterface
{

    public function __construct(Venda $model)
    {
        $this->model = $model;
    }
    // Use ResponseAPI Trait in this repository
    use Response, VendaUtilitarios;


    public function search($request)
    {

        if (!$request->filial_id) return $this->error("A regiao id é obrigatória", 400);
        $filialId = $request->filial_id;

        $status = DB::table('tb_status')->select('*')->where('fluxo', $request->fluxo)->get();

        $dtFim = new DateTime('NOW');
        $dtInicio = date_format($dtFim, 'Y-m-d');
        $dtInicio = date("Y-m-d", strtotime($dtInicio) - (15 * 24 * 60 * 60));
        $dtInicio = \DateTime::createFromFormat("Y-m-d H:i:s", "$dtInicio 23:59:59");


        $vendas = DB::table('tb_filas_vendas_filiais as filas')->where('filiais_id', $filialId)
            ->join('tb_vendas as vendas', 'vendas.id', '=', 'filas.vendas_id')
            ->where('filas.dt_rejeicao', '=', null)
            ->whereBetween('vendas.dt_venda', [$dtInicio, $dtFim])
            ->select(
                'filas.id as filas_id',
                'filas.dt_fila as filas_dt_fila',
                'filas.dt_aceite as filas_dt_aceite',
                'filas.dt_rejeicao as filas_dt_rejeicao',
                'filas.vendas_id as filas_vendas_id',
                'filas.filiais_id as filas_filiais_id',
                'filas.produtos_id as filas_produtos_id',
                'vendas.id as vendas_id',
                'vendas.dt_venda as vendas_dt_venda',
                'vendas.vl_total as vendas_vl_total',
                'vendas.vl_desconto as vendas_vl_desconto',
                'vendas.avaliacao as vendas_avaliacao',
                'vendas.num_pedido as vendas_num_pedido',
                'vendas.retirada as vendas_retirada',
                'vendas.agendado as vendas_agendado',
                'vendas.pgto_pix as vendas_pgto_pix',
                'vendas.dt_cancelamento as vendas_dt_cancelamento',
                'vendas.observacao as vendas_observacao',
                'vendas.clientes_id as vendas_clientes_id',
                'vendas.enderecos_id as vendas_enderecos_id',
                'vendas.cupom_descontos_id as vendas_cupom_descontos_id',
                'vendas.cobrancas_clientes_id as vendas_cobrancas_clientes_id',
                'vendas.status_id as vendas_status_id',
            )
            ->distinct('vendas.id')->get();

        $cont = 0;

        $ret = [];
        foreach ($status as $s) {
            $ret[$cont]['id'] = $s->id;
            $ret[$cont]['descricao'] = $s->descricao;
            $ret[$cont]['fluxo'] = $s->fluxo;
            $ret[$cont]['ordem'] = $s->ordem;
            $venda = [];
            $cont2 = 0;
            foreach ($vendas as $v) {
                if ($s->id == $v->vendas_status_id) {
                    $venda[$cont2]['id'] = $v->vendas_id;
                    $venda[$cont2]['dt_venda'] = $v->vendas_dt_venda;
                    $venda[$cont2]['vl_total'] = $v->vendas_vl_total;
                    $venda[$cont2]['vl_desconto'] = $v->vendas_vl_desconto;
                    $venda[$cont2]['avaliacao'] = $v->vendas_avaliacao;
                    $venda[$cont2]['num_pedido'] = $v->vendas_num_pedido;
                    $venda[$cont2]['retirada'] = $v->vendas_retirada;
                    $venda[$cont2]['agendado'] = $v->vendas_agendado;
                    $venda[$cont2]['pgto_pix'] = $v->vendas_pgto_pix;
                    $venda[$cont2]['dt_cancelamento'] = $v->vendas_dt_cancelamento;
                    $venda[$cont2]['observacao'] = $v->vendas_observacao;
                    $venda[$cont2]['clientes_id'] = $v->vendas_clientes_id;
                    $venda[$cont2]['enderecos_id'] = $v->vendas_enderecos_id;
                    $venda[$cont2]['cupom_descontos_id'] = $v->vendas_cupom_descontos_id;
                    $venda[$cont2]['cobrancas_clientes_id'] = $v->vendas_cobrancas_clientes_id;
                    $venda[$cont2]['status_id'] = $v->vendas_status_id;

                    $cliente = Cliente::where('id', $v->vendas_clientes_id)->first();
                    $venda[$cont2]['cliente'] = $cliente;

                    $endereco = Endereco::where('id', $v->vendas_enderecos_id)->first();
                    $venda[$cont2]['endereco'] = $endereco;

                    $vendaItens = VendaItem::where('vendas_id', $v->vendas_id)->with('produto')->get();
                    $venda[$cont2]['vendas_itens'] = $vendaItens;

                    // $venda[$cont2]['filas_vendas_filiais'] = $v->filas;

                    $cont2++;
                }
            }

            $ret[$cont]['vendas'] = $venda;
            $cont++;
        }

        return $this->success(
            "Lista de Vendas",
            $ret,
            200
        );
    }

    public function statusHistory($request)
    {
        if (!$request->vendas_id) return $this->error("A regiao id é obrigatória", 400);
        $vendasId = $request->vendas_id;

        $status = VendaStatus::where('vendas_id', $vendasId)
            ->join('tb_status', 'tb_status.id', '=', 'tb_vendas_status.status_id')
            ->select(
                'tb_vendas_status.id',
                'tb_vendas_status.dt_atualizacao',
                'tb_vendas_status.status_id',
                'tb_status.descricao',
                'tb_status.fluxo',
                'tb_status.ordem',
            )
            ->get();


        return $this->success(
            "Lista de Vendas",
            $status,
            200
        );
    }

    public function cancelaVenda($request)
    {
        if (!$request->vendas_id) return $this->error("A vendas id é obrigatória", 400);
        if (!$request->filiais_id) return $this->error("A filiais id é obrigatória", 400);
        if (!$request->motivo_rejeicao) return $this->error("O motivo rejeicao é obrigatório", 400);

        $statusVenda = Venda::where('id', $request->vendas_id)->first();

        $fila = FilaVendaFilial::where('vendas_id', $request->vendas_id)
            ->where('filiais_id', $request->filiais_id)->first();

        if (!empty($fila->dt_rejeicao)) {
            return $this->error("Esta venda já foi cancelada anteriormente.", 400);
        }

        $status_id = $statusVenda->$statusVenda;

        if ($status_id == 5 || $status_id == 12) {
            return $this->error("Não é possível cancelar esta venda, esta venda já foi finalizada.", 400);
        }

        if ($status_id == 6 || $status_id == 13) {
            return $this->error("Não é possível cancelar esta venda, esta venda foi cancelada pelo cliente.", 400);
        }

        VendaItem::where('vendas_id', $request->vendas_id)
            ->update(['filiais_id' => null]);

        FilaVendaFilial::where('vendas_id', $request->vendas_id)
            ->where('filiais_id', $request->filiais_id)
            ->update(['dt_rejeicao' => Carbon::now(), 'motivo_rejeicao' => $request->motivo_rejeicao]);

        $this->encontraVendedores($request->vendas_id);

        return $this->success(
            "Venda Cancelada com sucesso",
            200
        );
    }

    public function trocaProdutos($request)
    {
        if (!$request->vendas_id) {
            return $this->error("A vendas_id é obrigatoria.", 400);
        }
        if ($request->venda_itens) {
            foreach ($request->venda_itens as $v) {
                if (empty($v['id'])) {
                    return $this->error("O vendas itens id é obrigatorio.", 400);
                }

                if (!isset($v['qt_atendida']) || trim($v['qt_atendida']) == '') {
                    return $this->error("A qt_atendida é obrigatoria.", 400);
                }

                if (empty($v['produtos_id'])) {
                    return $this->error("O produtos_id é obrigatorio.", 400);
                }

                if (empty($v['filiais_id'])) {
                    return $this->error("A filiais_id é obrigatoria.", 400);
                }
                VendaItem::where('id', $v['id'])->update(['qt_atendida' => $v['qt_atendida'], 'dt_atualizacao' => Carbon::now()]);
            }
            $venda = Venda::find($request->vendas_id);
            $venda->status_id = $venda->status_id + 1;
            $venda->save();

            $vendaItens = VendaItem::where('vendas_id', $request->vendas_id)->get();
            $this->updateEstoque($vendaItens);

            return $this->success("Troca envida para o cliente.", 200);
        }
        return $this->error("O array vendas_itens é obrigatório.", 400);
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
            ])->first();

            $qtd_antiga = 0;

            if ($prod != null) {
                $qtd_antiga = $prod['quantidade'];
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
}
