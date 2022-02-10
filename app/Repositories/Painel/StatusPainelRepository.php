<?php

namespace App\Repositories\Painel;

use App\Http\Requests\PromocaoRequest;
use App\Http\Requests\StatusRequest;
use App\Interfaces\Painel\PromocaoPainelInterface;
use App\Interfaces\Painel\StatusPainelInterface;
use App\Models\Promocao;
use App\Models\Regiao;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use Illuminate\Http\Client\Request;

class StatusPainelRepository implements StatusPainelInterface
{

    use Response;


    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function getAll()
    {
        try {
            $status = $this->status->all();
            return $this->success("Lista de Status", $status);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $status = $this->status->find($id);
            if (!$status) return $this->error("Não Possui Status $id", 404);
            return $this->success("Detalhes dos Status", $status);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(StatusRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {

            $status = $id ? Status::find($id) : new Status;
            if ($id && !$status) return $this->error("Não Possui o Status $id", 404);
            $status->descricao = $request->descricao;
            $status->fluxo = $request->fluxo;
            $status->ordem = $request->ordem;
            $status->save();
            DB::commit();
            return $this->success(
                $id ? "Status Atualizado com sucesso"
                    : "Status Criada com sucesso",
                $status,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 401);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $status = Status::find($id);

            // Check the user
            if (!$status) return $this->error("Não Existe o Status $id", 404);

            // Delete the user
            $status->delete();
            DB::commit();
            return $this->success("Status deletado com Sucesso", $status);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'descricao';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';

        $regioes = Status::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
        })
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $regioes;
    }
}
