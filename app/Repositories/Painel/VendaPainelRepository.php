<?php

namespace App\Repositories\Painel;


use App\Interfaces\Painel\VendaPainelInterface;
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

class VendaPainelRepository implements VendaPainelInterface
{

    public function __construct(Venda $model)
    {
        $this->model = $model;
    }
    // Use ResponseAPI Trait in this repository
    use Response, VendaUtilitarios;


    public function pedidos($request)
    {
        $pedidosAndamentos = Venda::whereNotIn('status_id', [5, 6, 12, 13])->sum('vl_total');
        $pedidosConcluidos = Venda::whereIn('status_id', [5, 12])->count();
        $pedidosCancelados = Venda::whereIn('status_id', [6, 13])->count();

        $result[] = $pedidosCancelados;
        $result[] = $pedidosAndamentos;
        $result[] = $pedidosConcluidos;


        return $this->success(
            "Lista de Vendas",
            $result,
            200
        );
    }

    public function faturamento($request)
    {
        $ticketMedio = 0;

        $valorTotalFaturamento = (float)Venda::whereIn('status_id', [5, 12])->sum('vl_total');
        $qtdTotalVendas = Venda::whereIn('status_id', [5, 12])->count();
        $valorTotalComissao = (float)$valorTotalFaturamento * 0.1;

        if ($valorTotalFaturamento > 0 && $qtdTotalVendas > 0) {
            $ticketMedio = (float)$valorTotalFaturamento / $qtdTotalVendas;
        }

        $result['valor-total-faturamento'] = number_format($valorTotalFaturamento, 2, '.', ',');
        $result['valor-total-comissao'] = number_format($valorTotalComissao, 2, '.', ',');
        $result['qtd-total-vendas'] = $qtdTotalVendas;
        $result['ticket-medio'] = number_format($ticketMedio, 2, '.', ',');

        return $this->success(
            "Relatorios",
            $result,
            200
        );
    }
}
