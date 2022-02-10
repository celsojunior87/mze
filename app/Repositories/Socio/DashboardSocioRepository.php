<?php

namespace App\Repositories\Socio;

use App\Interfaces\Socio\DashboardSocioInterface;
use App\Models\Filial;
use App\Models\Venda;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardSocioRepository implements DashboardSocioInterface
{
    // Use ResponseAPI Trait in this repository

    use Response;


    public function __construct(Venda $model)
    {
        $this->model = $model;
    }

    public function search($request)
    {
        $user = Auth::id();

        if (!$user) {
            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 401);
        }

        if (!$request->data_inicial && !$request->data_final) {
            return response()->json(['error' => 'Por favor informar a data '], 401);
        }

        $filial = Filial::where('socios_id', $user)->get('id');

        $dataInicial = $request->data_inicial;
        $dataFinal = $request->data_final;

        $faturamento = $this->getFaturamento($dataInicial, $dataFinal);
        $receber = $this->getReceber($filial, $dataInicial, $dataFinal);
        $vendasConcluidas = $this->getVendasConcluidas($filial, $dataInicial, $dataFinal);
        $pedidosAll = $this->getAllPedidos($dataInicial, $dataFinal, $filial);

        foreach ($pedidosAll as $pedido) {
            $data = $pedido->dt_venda;
            $data = strtotime($data);
            $data = date('d/m/Y', $data);
            $pedidos = $pedido->num_pedido;
            $valor = (float)$pedido->valor;
            $taxa = (float)$pedido->vl_comissao;
            $repasse = $valor - $taxa;

            $todosPedidos[] = [
                "data" => $data,
                "pedido" => $pedidos,
                "valor" => $valor,
                "taxa" => $taxa,
                "repasse" => $repasse,
            ];
        }
        $dataInicial = strtotime($dataInicial);
        $dataInicial = date('d/m/Y', $dataInicial);
        $dataFinal = strtotime($dataFinal);
        $dataFinal = date('d/m/Y', $dataFinal);
        $arrPedidos = [
            "data_inicial" => $dataInicial,
            "data_final" => $dataFinal,
            "faturamento" => (float) number_format($faturamento, 2, '.', ''),
            "receber" => (float) number_format($receber, 2, '.', ''),
            "vendas_concluidas" => $vendasConcluidas,
            'pedidos' => !empty($todosPedidos) ? $todosPedidos : [],
        ];

        return $this->success("Detalhes do Dashboard", $arrPedidos);
    }

public function getVendasConcluidas($idFilial, $datainicial, $dataFinal)
    {
        $dtInicio = \DateTime::createFromFormat("Y-m-d H:i:s", "$datainicial 00:00:00");
        $dtFim = \DateTime::createFromFormat("Y-m-d H:i:s", "$dataFinal 23:59:59");
        $result = DB::table('tb_vendas_itens')
            ->join('tb_vendas as vendas', 'tb_vendas_itens.vendas_id', '=', 'tb_vendas_itens.id')
            ->whereIn('tb_vendas_itens.filiais_id', $idFilial)
            ->whereBetween('vendas.dt_venda', [$dtInicio, $dtFim])->get();
        $soma = 0;
        foreach ($result as $r) {
            if ($r->status_id == 5 || $r->status_id == 12) {
                $soma++;
            }
        }
        return $soma;
    }

    public function getReceber($idFilial, $dataInicial, $dataFinal)
    {
        $dtInicio = \DateTime::createFromFormat("Y-m-d H:i:s", "$dataInicial 00:00:00");
        $dtFim = \DateTime::createFromFormat("Y-m-d H:i:s", "$dataFinal 23:59:59");
        $result = DB::table('tb_vendas as vendas')
            ->join('tb_vendas_itens as vendaItens', 'vendaItens.vendas_id', '=', 'vendas.id')
            ->whereIN('vendaItens.filiais_id', $idFilial)
            ->whereBetween('vendas.dt_venda', [$dtInicio, $dtFim])->get();
        $somaComissao = 0;
        foreach ($result as $v) {
            if ($v->status_id == 5 || $v->status_id == 12) {
                $valorTotalItem = $v->vl_comissao * $v->qt_atendida;
                $somaComissao += $valorTotalItem;
            }
        }
        $somaComissao = number_format($somaComissao, 2, '.', '');
        return (float)$somaComissao;
    }


    public function getFaturamento($datainicial, $dataFinal)
    {
        $dtInicio = \DateTime::createFromFormat("Y-m-d H:i:s", "$datainicial 00:00:00");
        $dtFim = \DateTime::createFromFormat("Y-m-d H:i:s", "$dataFinal 23:59:59");
        $vendas = DB::table('tb_vendas_itens')
            ->join('tb_vendas as vendas', 'tb_vendas_itens.vendas_id', '=', 'vendas.id')
            ->whereBetween('vendas.dt_venda', [$dtInicio, $dtFim])->get();
        $somaVendas = 0;
        foreach ($vendas as $v) {
            if ($v->status_id == 5 || $v->status_id == 12) {
                $valorTotalItem = $v->valor * $v->qt_atendida;
                $somaVendas += $valorTotalItem;
            }
        }
        return $somaVendas;
    }


    public function getAllPedidos($dataInicial, $dataFinal, $idFilial)
    {
        $dtInicio = \DateTime::createFromFormat("Y-m-d H:i:s", "$dataInicial 00:00:00");
        $dtFim = \DateTime::createFromFormat("Y-m-d H:i:s", "$dataFinal 23:59:59");
        $result = DB::table('tb_vendas_itens')
            ->join('tb_vendas as vendas', 'tb_vendas_itens.vendas_id', '=', 'vendas.id')
            ->whereBetween('vendas.dt_venda', [$dtInicio, $dtFim])
            ->whereIN('tb_vendas_itens.filiais_id', $idFilial)
            ->distinct('vendas.id')->get();
        $resultado = array();
        foreach ($result as $r) {
            if ($r->status_id == 5 || $r->status_id == 12) {
                $resultado[] = $r;
            }
        }
        return $resultado;
    }
}
