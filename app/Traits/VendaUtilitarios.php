<?php

namespace App\Traits;

use App\Models\FilaVendaFilial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait VendaUtilitarios
{
    public function encontraVendedores($vendas_id = null)
    {

        $sql = "select
                distinct tb_vendas_itens.vendas_id
                from tb_vendas, tb_vendas_itens
                where tb_vendas.id = tb_vendas_itens.vendas_id
                and tb_vendas_itens.filiais_id is null
                and not exists (select 1
                                    from tb_filas_vendas_filiais filas
                                where filas.vendas_id = tb_vendas.id
                                and filas.produtos_id = tb_vendas_itens.produtos_id
                                and ((EXTRACT (EPOCH FROM  now() - filas.dt_fila::timestamp )::int/60) <= 5)
                                )
                and tb_vendas.dt_cancelamento is null";

        if ($vendas_id != null) {
            $sql .= " and tb_vendas.id = $vendas_id";
        }


        $pedidosPendentes = DB::select($sql);
        if (!empty($pedidosPendentes)) {

            foreach ($pedidosPendentes as $pedido) {
                $filiaisDisponiveis = $this->getFiliaisDisponiveis($pedido->vendas_id);
                foreach ($filiaisDisponiveis as $itemFilial) {

                    $produtosVenda = DB::select("select produtos_id from tb_vendas_itens where vendas_id = $itemFilial->vendas_id");
                    foreach ($produtosVenda as $produto) {
                        $filas = new FilaVendaFilial();
                        $filas->vendas_id = $itemFilial->vendas_id;
                        $filas->filiais_id = $itemFilial->filiais_id;
                        $filas->produtos_id = $produto->produtos_id;
                        $filas->dt_fila = Carbon::now();
                        $filas->save();
                    }
                }
            }

            return ["sucesso" => true, "mensagem" => "Produtos atribuidos com sucesso"];
        } else {
            return ["sucesso" => false, "mensagem" => "Seus produtos não foram encontrados em nenhum sócio da região"];
        }
    }

    private function getFiliaisDisponiveis($idvenda)
    {

        $sql = "
                select * from (
                    select distinct dados.vendas_id, dados.filiais_id, dados.distancia from (
                    select vendas.vendas_id,
                            vendas.filiais_id,
                            vendas.distancia,
                            vendas.produtos_id,
                            vendas.qt_pedida,
                            coalesce(tb_estoque.quantidade, 0) as qt_disponivel,

                            (select count(*) from tb_vendas_itens where tb_vendas_itens.vendas_id = vendas.vendas_id) as qt_itens_ped,

                            (select
                            count(tb_vendas_itens.id)
                            from tb_estoque, tb_vendas_itens
                            where  tb_estoque.filiais_id = vendas.filiais_id
                            and tb_vendas_itens.vendas_id = vendas.vendas_id
                            and tb_estoque.produtos_id = vendas.produtos_id
                            and tb_estoque.quantidade >= tb_vendas_itens.qt_pedida) as qt_encontrada

                    from (select tb_vendas.id as vendas_id,
                                    tb_filiais.id as filiais_id,
                                    fnc_calcula_distancia (endcliente.latitude,
                                                        endcliente.longitude,
                                                        endfiliais.latitude,
                                                        endfiliais.longitude)
                                        as distancia,
                                    tb_socios.raio_entrega,
                                    tb_vendas_itens.produtos_id,
                                    tb_vendas_itens.qt_pedida
                            from tb_vendas,
                                    tb_enderecos endcliente,
                                    tb_enderecos endfiliais,
                                    tb_socios,
                                    tb_vendas_itens,
                                    tb_filiais
                            where     0 = 0
                                    and tb_socios.id = tb_filiais.socios_id
                                    and tb_vendas_itens.vendas_id = tb_vendas.id
                                    and tb_vendas.enderecos_id = endcliente.id
                                    and tb_filiais.enderecos_id = endfiliais.id
                                    and endcliente.regioes_id = endfiliais.regioes_id
                                    and tb_vendas_itens.filiais_id is null
                                    and tb_filiais.filial_aberta = true
                                    and tb_vendas.id = $idvenda) vendas
                            left join tb_estoque on tb_estoque.produtos_id = vendas.produtos_id and tb_estoque.filiais_id = vendas.filiais_id
                    where     vendas.distancia <= vendas.raio_entrega
                            and vendas.filiais_id not in (select filiais_id
                                                            from tb_filas_vendas_filiais filas
                                                        where filas.vendas_id = vendas.vendas_id
                                                        and filas.filiais_id = vendas.filiais_id)

                            and not exists (select 1
                                                    from tb_filas_vendas_filiais filas
                                                where filas.vendas_id = vendas.vendas_id
                                                and filas.produtos_id = tb_estoque.produtos_id
                                                and ((EXTRACT (EPOCH FROM  now() - filas.dt_fila::timestamp )::int/60) <= 5)
                                                )
                    order by 7 desc, 2 asc
                    ) dados
                    where dados.qt_itens_ped = dados.qt_encontrada) dados2
                    limit 3";

        $filiaisDisponiveis = DB::select($sql);

        return $filiaisDisponiveis;
    }
}
