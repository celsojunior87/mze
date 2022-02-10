<?php

namespace App\Repositories\Socio;



use App\Interfaces\Socio\HomeSocioInterface;
use App\Models\Filial;
use App\Models\Socio;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Traits\Response;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class HomeSocioRepository implements HomeSocioInterface
{
    // Use ResponseAPI Trait in this repository

    use Response;


    public function __construct(Venda $model)
    {
        $this->model = $model;
    }

    public function search()
    {
        $user = Auth::id();

        if (!$user) {
            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 401);
        }

        $filial = Filial::where('socios_id', $user)->get('id');
        $receber = $this->model->getValoresReceber($filial);
        $finalizado = $this->model->getQuantidadePedidosFinalizados($filial);
        $andamento = $this->model->getQuantidadePedidosAndamento($filial);
        $idPedidoAtual = $this->model->getPedidoAtual($filial);
        $pedidoAtual = '';
        if ($idPedidoAtual) {
            $pedidoAtual = $this->model->getVendaById($idPedidoAtual->id);
            $data = strtotime($pedidoAtual->horaaceito);
            $data = date('d/m/Y H:i:s', $data);
            $pedidoAtual->horaaceito = $data;
        }
        $faturamento = $this->model->getFaturamento($filial, 'today 00:00');
        $faturamentoQuinze = $this->model->getFaturamento($filial, '-15 day 00:00');
        $faturamentoTrinta = $this->model->getFaturamento($filial, '-30 day 00:00');

        $arrPedidos = [
            "pedido_finalizados" => $finalizado,
            "pedido_andamentos" => $andamento,
            "pedido_atual" => $pedidoAtual,
            "receber" => $receber,
            'faturamento' => [
                "hoje" => (float)number_format($faturamento, 2, '.', ''),
                "15dias" => (float)number_format($faturamentoQuinze, 2, '.', ''),
                "30dias" => (float)number_format($faturamentoTrinta, 2, '.', ''),
            ]
        ];

        return $this->success("Detalhes dos Pedidos", $arrPedidos);
    }
}
