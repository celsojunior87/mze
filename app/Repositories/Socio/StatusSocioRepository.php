<?php

namespace App\Repositories\Socio;

use App\Interfaces\Socio\DashboardSocioInterface;
use App\Interfaces\Socio\StatusSocioInterface;
use App\Models\Status;
use App\Models\Venda;
use App\Models\VendaStatus;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatusSocioRepository implements StatusSocioInterface
{
    // Use ResponseAPI Trait in this repository

    use Response;


    public function __construct(Status $model)
    {
        $this->model = $model;
    }

    public function search($request)
    {
        $vendas_id = $request->vendas_id;
        if (!$vendas_id) return $this->error("O vendas_id é obrigatorio", 404);

        try {
            $statusVenda = VendaStatus::where('vendas_id', $vendas_id)
                ->join('tb_status as status', 'status_id', '=', 'status.id')
                ->select(
                    'status.id',
                    'status.descricao',
                    'status.fluxo',
                    'status.ordem',
                    'dt_atualizacao',
                    'status_id',
                    'vendas_id'
                )
                ->orderBy('status.ordem')
                ->get();
            return $this->success("Lista de Status", $statusVenda);
        } catch (\Exception $e) {
            return $this->error("O fluxo informado não foi encontrado");;
        }
    }
}
