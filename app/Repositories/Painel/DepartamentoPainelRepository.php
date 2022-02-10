<?php

namespace App\Repositories\Painel;

use App\Http\Requests\DepartamentoRequest;
use App\Interfaces\Painel\DepartamentoPainelInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Departamento;
use App\Models\Mix;
use App\Models\Produto;
use App\Traits\Response;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Traits\BaseUrlReturn;

class DepartamentoPainelRepository implements DepartamentoPainelInterface
{

    // Use ResponseAPI Trait in this repository
    use Response, ImageHandler, BaseUrlReturn;

    public function getAll()
    {
        try {
            $departamento = Departamento::all();
            return $this->success("Lista de Departamentos", $departamento);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findById($id)
    {
        try {
            $departamento = Departamento::find($id);
            if (!$departamento) return $this->error("Não Possui Departamento $id", 404);
            return $this->success("Detalhes do Departamento", $departamento);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(DepartamentoRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            $departamento = $id ? Departamento::find($id) : new Departamento;
            if ($id && !$departamento) return $this->error("Não Possui o Departamento $id", 404);
            $departamento->descricao = $request->descricao;
            $departamento->url = $request->url;
            $departamento['url'] = $this->createUrlImagem($request->url, Str::slug($departamento->descricao), 'departamentos');
            if ($departamento['url'] == false) {
                return response()->json(['message' => 'A imagem não é válida. Verifique o arquivo enviado.'], 401);
            }
            // Save the user
            $departamento->save();
            DB::commit();
            return $this->success(
                $id ? "Departamento Atualizado com sucesso"
                    : "Departamento Criado com sucesso",
                $departamento,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $departamento = Departamento::find($id);

            // Check the user
            if (!$departamento) return $this->error("Não Existe o departamento $id", 404);

            // Delete the user
            $departamento->delete();
            DB::commit();
            return $this->success("Departamento deletado com Sucesso", $departamento);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search($request)
    {
        try {

            $departamentos = Departamento::when($request->input('mix_id'), function ($q) use ($request) {
                $q->whereHas('produtos', function ($p) use ($request) {
                    $p->whereHas('mix', function ($m) use ($request) {
                        $m->where('mix_id', $request->input('mix_id'));
                    });
                });
            })
                ->when($request->input('id'), function ($q) use ($request) {
                    $q->where('id', $request->id);
                })
                ->orderBy('descricao')
                ->get();

            return $this->success("Lista de departamentos.", $departamentos);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'descricao';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';

        $regioes = Departamento::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
        })
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $regioes;
    }
}
