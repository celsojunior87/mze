<?php

namespace App\Repositories\Painel;

use App\Http\Requests\MixItemRequest;
use App\Interfaces\MixItemInterface;
use App\Interfaces\Painel\MixItemPainelInterface;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;
use App\Models\MixItem;
use App\Models\Regiao;
use App\Traits\Response;
use Illuminate\Http\Request;

class MixItemPainelRepository implements MixItemPainelInterface
{
    public function __construct(MixItem $mixItem)
    {
        $this->mixItem = $mixItem;
    }

    use Response;

    public function toDataTable(Request $request)
    {
        $items = $request->input('per_page') ?? 10;
        $regiaoId = $request->input('regiao_id');

        $regiao = Regiao::find($regiaoId);
        $mixPadraoId = $regiao->estado->regiao_padrao_id;

        $mixId = $request->input('mix_id') ??  $mixPadraoId;

        $mixes  = MixItem::where('mix_id', $mixId)
            ->with(['produto.secao', 'produto.departamento', 'produto.preco' => function ($q) use ($regiaoId) {
                $q->where('regioes_id', $regiaoId);
            }])
            ->when($request->input('departamento_id'), function ($q) use ($request) {
                $q->wherehas('produto.departamento', function ($dep) use ($request) {
                    $dep->where('id', $request->input('departamento_id'));
                });
            })
            ->when($request->input('secao_id'), function ($q) use ($request) {
                $q->wherehas('produto.secao', function ($sec) use ($request) {
                    $sec->where('id', $request->input('secao_id'));
                });
            })
            ->paginate($items);

        return $mixes;
    }


    public function getAll(Request $request)
    {
        try {
            $mixItem = MixItem::when($request->input('mix_id'), function ($q) use ($request) {
                $q->where('mix_id', $request->input('mix_id'));
            })
                ->when($request->input('regiao_id'), function ($q) use ($request) {
                    $q->with(['produto.preco' => function ($q) use ($request) {
                        $q->where('regioes_id', $request->input('regiao_id'));
                    }]);
                })
                ->with('produto', 'produto.departamento')->get();

            return $this->success("Lista de Mix Itens", $mixItem);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() !== 0 ? $e->getCode() : 500);
        }
    }

    public function findById($id)
    {
        try {
            $mixItem = MixItem::find($id);
            //$departamento = Departamento::find($produto->departamentos_id);
            //$produto->departamento = $departamento->descricao;
            if (!$mixItem) return $this->error("Não Possui Mix $id", 404);
            return $this->success("Detalhes dos Mix Itens", $mixItem);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(MixItemRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            dd($request);
            $mixItem = $id ? MixItem::find($id) : new MixItem;
            if ($id && !$mixItem) return $this->error("Não Possui o Mix Itens $id", 404);

            $mixItem->mix_id = $request->mix_id;
            $mixItem->produtos_id = $request->produtos_id;

            $mixItem->save();

            DB::commit();
            return $this->success(
                $id ? "Mix Itens Atualizado com sucesso"
                    : "Mix Itens Criado com sucesso",
                $mixItem,
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
            $mixItem = MixItem::find($id);

            // Check the user
            if (!$mixItem) return $this->error("Não Existe o Mix Itens $id", 404);

            // Delete the user
            $mixItem->delete();
            DB::commit();
            return $this->success("Mix Itens deletado com Sucesso", $mixItem);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
