<?php

namespace App\Repositories\Painel;

use App\Http\Requests\PrecoRequest;
use App\Interfaces\Painel\PrecoPainelInterface;
use App\Models\Filial;
use App\Models\Mix;
use Illuminate\Support\Facades\DB;
use App\Models\Preco;
use App\Traits\Response;

class PrecoPainelRepository implements PrecoPainelInterface
{
    public function __construct(Preco $preco)
    {
        $this->preco = $preco;
    }

    use Response;

    public function getAll()
    {
        try {
            $preco = Preco::all();
            return $this->success("Lista de preco", $preco);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findById($id)
    {
        try {
            $preco = Preco::find($id);
            //$departamento = Departamento::find($produto->departamentos_id);
            //$produto->departamento = $departamento->descricao;
            if (!$preco) return $this->error("Não Possui preco $id", 404);
            return $this->success("Detalhes dos Preços", $preco);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(PrecoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {

            $preco = $id ? Preco::find($id) : new Preco;
            if ($id && !$preco) return $this->error("Não Possui o preco $id", 404);
            $preco->preco = $request->preco;
            $preco->perc_comisao = $request->perc_comisao;
            $preco->valor_comisao = $request->valor_comisao;
            $preco->regioes_id = $request->regioes_id;
            $preco->produtos_id = $request->produtos_id;

            $preco->save();

            DB::commit();
            return $this->success(
                $id ? "Preco Atualizado com sucesso"
                    : "Preco Criado com sucesso",
                $preco,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $preco = Preco::find($id);

            // Check the user
            if (!$preco) return $this->error("Não Existe o preco $id", 404);

            // Delete the user
            $preco->delete();
            DB::commit();
            return $this->success("Preco deletado com Sucesso", $preco);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search($request)
    {
        if (!$request->regioes_id) return $this->error("A regiao id é obrigatória", 404);
        try {
            if ($request->filiais_id) {
                $filial = Filial::find($request->filiais_id);
                if (!$filial->mix_id) {
                    $preco = Preco::where('regioes_id', $request->regioes_id)
                        ->with('regiao', 'produto', 'departamento')
                        ->when($request->has('produtos_id'), function ($q) use ($request) {
                            return $q->where('produtos_id', $request->produtos_id);
                        })->get();
                    return $this->success("Detalhes dos Produtos", $preco);
                } else {
                    $mix = Mix::find($request->mix_id);
                    $preco = Preco::where('regioes_id', $mix->regioes_id)
                        ->with('regiao', 'produto', 'departamento')
                        ->when($request->has('produtos_id'), function ($q) use ($request) {
                            return $q->where('produtos_id', $request->produtos_id);
                        })->get();
                }
            } else if ($request->departamentos_id) {
                $preco = Preco::where('regioes_id', $request->regioes_id)
                    ->with('regiao', 'produto', 'departamento')
                    ->when($request->has('produtos_id'), function ($q) use ($request) {
                        return $q->where('produtos_id', $request->produtos_id);
                    })->whereHas('produto', function ($q) use ($request) {
                        return $q->where('tb_produtos.departamentos_id', $request->departamentos_id);
                    })
                    ->get();
                return $this->success("Detalhes dos Produtos", $preco);
            } else {
                $preco = Preco::where('regioes_id', $request->regioes_id)
                    ->with('regiao', 'produto', 'departamento')
                    ->when($request->has('produtos_id'), function ($q) use ($request) {
                        return $q->where('produtos_id', $request->produtos_id);
                    })->get();
                return $this->success("Detalhes dos Produtos", $preco);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }
}
