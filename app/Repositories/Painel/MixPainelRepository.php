<?php

namespace App\Repositories\Painel;

use App\Http\Requests\MixRequest;
use App\Interfaces\Painel\MixPainelInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Mix;
use App\Models\Produto;
use App\Traits\Response;
use Illuminate\Http\Request;

class MixPainelRepository implements MixPainelInterface
{
    public function __construct(Mix $mix)
    {
        $this->mix = $mix;
    }

    use Response;

    public function getAll(Request $request)
    {
        try {
            $mix = Mix::when($request->input('regiao_id'), function ($q) use ($request) {
                $q->where('regioes_id', $request->input('regiao_id'))
                    ->whereHas('produtos');
            })->get();
            return $this->success("Lista de Mix", $mix);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search(Request $request)
    {
        try {

            $mix = Mix::when($request->input('id'), function ($q) use ($request) {
                $q->whereId($request->id);
            })->when($request->input('estado_id'), function ($q) use ($request) {
                $q->whereHas('regiao', function ($q) use ($request) {
                    $q->whereHas('estado', function ($q) use ($request) {
                        $q->whereId($request->input('estado_id'));
                    });
                });
            })->get();

            return $this->success("Lista de Mix", $mix);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findById($id)
    {
        try {
            $mix = Mix::with('produtos')->find($id);
            if (!$mix) return $this->error("Não Possui Mix $id", 404);
            return $this->success("Detalhes dos Produtos", $mix);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(MixRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $mix = $id ? Mix::find($id) : new Mix;
            if ($id && !$mix) return $this->error("Não Possui o Mix $id", 404);

            $mix->titulo = $request->titulo;
            $mix->descricao = $request->descricao;
            $mix->regioes_id = $request->regioes_id;

            $mix->save();

            DB::commit();
            return $this->success(
                $id ? "Mix Atualizado com sucesso"
                    : "Mix Criado com sucesso",
                $mix,
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
            $mix = Mix::find($id);

            // Check the user
            if (!$mix) return $this->error("Não Existe o departamento $id", 404);

            // Delete the user
            $mix->delete();
            DB::commit();
            return $this->success("Departamento deletado com Sucesso", $mix);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'titulo';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';

        $mixes = Mix::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->orWhereRaw("UPPER(titulo) LIKE '%" . strtoupper($column) . "%'");
            $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
        })
            ->with('regiao')
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $mixes;
    }

    public function productsToDataTable(Request $request, $mixId)
    {
        $sort = $request->sort ?? 'titulo';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';


        if ($request->has('vinculados')) {
            $produtos = Produto::when($request->input('search'), function ($q) use ($request, $mixId) {
                $column = $request->input('search');
                $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
            })
                ->whereHas('mix', function ($q) use ($mixId) {
                    $q->where('mix_id', $mixId);
                })
                ->with('departamento')
                ->orderBy($sort, $dir)
                ->paginate($items);
        } else {
            $produtos = Produto::when($request->input('search'), function ($q) use ($request, $mixId) {
                $column = $request->input('search');
                $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
            })
                ->with('departamento')
                ->orderBy($sort, $dir)
                ->paginate($items);
        }

        return $produtos;
    }

    public function updateLinkedProducts(Request $request, $mixId)
    {
        DB::beginTransaction();
        try {
            $mix = Mix::findOrFail($mixId);
            if (!$mix) return $this->error("Não Existe o departamento $mixId", 404);

            $mix->produtos()->sync($request->produtos, false);

            DB::commit();
            return $this->success("Produtos vinculados com Sucesso", $mix);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function unlinkProduct(Request $request, $mixId)
    {
        DB::beginTransaction();
        try {
            $mix = Mix::findOrFail($mixId);
            if (!$mix) return $this->error("Não Existe o departamento $mixId", 404);

            $mix->produtos()->detach($request->produtoId);

            DB::commit();
            return $this->success("Produto desvinculado com Sucesso", $mix);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
