<?php

namespace App\Repositories;

use App\Http\Requests\EnderecoRequest;
use App\Http\Requests\RegiaoRequest;
use App\Interfaces\EnderecoInterface;
use App\Interfaces\RegiaoInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Departamento;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Regiao;
use App\Traits\Response;
use Illuminate\Http\Request;

class RegiaoRepository implements RegiaoInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function getAll()
    {
        try {
            $regiao = Regiao::all();
            return $this->success("Lista de Regiões", $regiao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function getStates(Request $request)
    {
        try {
            $estados = Estado::when($request->input('com-mix'), function ($q) {
                $q->whereHas('regioes', function ($q) {
                    $q->whereHas('mix', function ($q) {
                        $q->whereHas('produtos');
                    });
                });
            })
                ->get();
            return $this->success("Lista de Estados", $estados);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $regiao = Regiao::with("mix")->find($id);
            if (!$regiao) return $this->error("Não Possui Região $id", 404);
            return $this->success("Detalhes da Região", $regiao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function saveOrUpdate(RegiaoRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            $regiao = $id ? Regiao::find($id) : new Regiao();
            if ($id && !$regiao) return $this->error("Não Possui a Região $id", 404);

            $regiao->descricao = $request->descricao;
            $regiao->raio_entrega = $request->raio_entrega;
            $regiao->longitude = $request->longitude;
            $regiao->latitude = $request->latitude;
            $regiao->estados_id = $request->estados_id;

            // Save the
            $regiao->save();
            DB::commit();
            return $this->success(
                $id ? "Região Atualizado com sucesso"
                    : "Região Criado com sucesso",
                $regiao,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $regiao = Regiao::find($id);

            // Check the endereço
            if (!$regiao) return $this->error("Não Existe a Região $id", 404);

            // Deleta o endereço
            $regiao->delete();
            DB::commit();
            return $this->success("Região deletado com Sucesso", $regiao);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'descricao';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';
        $estado = $request->input('estado');
        $regiao = $request->input('regiao');

        $regioes = Regiao::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
        })->when($estado, function ($q) use ($estado) {
            $q->whereHas('estado', function ($q) use ($estado) {
                $q->where('id', $estado);
            });
        })
            ->when($regiao, function ($q) use ($regiao) {
                $q->where('id', $regiao);
            })
            ->with('estado')
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $regioes;
    }

    public function withMix(Request $request)
    {
        $regioes = Regiao::when($request->input('estado_id'), function ($q) use ($request) {
            $q->where('estados_id', $request->input('estado_id'));
        })
            ->get();

        return $this->success("Lista de regiões com Mix", $regioes);
    }
}
