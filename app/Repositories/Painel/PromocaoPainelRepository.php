<?php

namespace App\Repositories\Painel;

use App\Http\Requests\PromocaoRequest;
use App\Interfaces\Painel\PromocaoPainelInterface;
use App\Models\Promocao;
use App\Models\Regiao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\ImageHandler;
use Illuminate\Support\Str;

class PromocaoPainelRepository implements PromocaoPainelInterface
{

    use Response, ImageHandler;


    public function __construct(Promocao $promocao)
    {
        $this->promocao = $promocao;
    }

    public function getAll()
    {
        try {
            $promocao = $this->promocao->with('regiao')->paginate();
            return $this->success("Lista de Promoções", $promocao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $promocao = $this->promocao->with('enderecos')->find($id);
            if (!$promocao) return $this->error("Não Possui Promoção $id", 404);
            return $this->success("Detalhes dos Produtos", $promocao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(PromocaoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $promocao = $id ? Promocao::find($id) : new Promocao;
            if ($id && !$promocao) return $this->error("Não Possui a Promoção $id", 404);
            $promocao->descricao = $request->descricao;
            $promocao->regioes_id = $request->regioes_id;
            $promocao->tipo = $request->tipo;
            $promocao->dt_inicial = $request->dt_inicial;
            $promocao->dt_final = $request->dt_final;
            $promocao->url_imagem = $this->createUrlImagem($request->url_imagem, Str::slug($promocao->descricao), 'promocao');
            if ($promocao->url_imagem == false) {
                return response()->json(['message' => 'A imagem não é válida. Verifique o arquivo enviado.'], 401);
            }
            $promocao->save();
            DB::commit();
            return $this->success(
                $id ? "Promoção Atualizada com sucesso"
                    : "Promoção Criada com sucesso",
                $promocao,
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
            $promocao = Promocao::find($id);

            // Check the user
            if (!$promocao) return $this->error("Não Existe a Promoção $id", 404);

            // Delete the user
            $promocao->delete();
            DB::commit();
            return $this->success("Promoção deletada com Sucesso", $promocao);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search($request)
    {
        try {
            $secao = Promocao::where('id', $request->id)->get();
            return $secao;
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'descricao';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';
        $promocoes = Promocao::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
        })
            ->with('regiao')
            ->orderBy($sort, $dir)
            ->paginate($items);
        return $promocoes;
    }
}
