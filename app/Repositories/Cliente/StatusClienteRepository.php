<?php

namespace App\Repositories\Cliente;

use App\Interfaces\Cliente\StatusClienteInterface;
use App\Models\Status;
use App\Models\VendaStatus;
use App\Traits\Response;

class StatusClienteRepository implements StatusClienteInterface
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
                    'vendas_id',
                )->orderBy('status.ordem')
                ->get();
            return $this->success("Lista de Status", $statusVenda);
        } catch (\Exception $e) {
            return $this->error("O fluxo informado não foi encontrado");;
        }
    }
}
