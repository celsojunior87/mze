<?php

namespace App\Repositories\Painel;

use App\Http\Requests\ProdutoRequest;
use App\Interfaces\Painel\ProdutoPainelInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Traits\BaseUrlReturn;
use App\Traits\ImageHandler;
use App\Traits\Response;
use Illuminate\Http\Request;

class ProdutoPainelRepository implements ProdutoPainelInterface
{
    use ImageHandler, Response, BaseUrlReturn;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function getAll()
    {
        try {
            $result = $this->produto->getProdutosAndDepartamentos();
            return $this->success("Lista de Produtos", $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function search($request)
    {
        $descricao = $request->input('descricao');

        $search = Produto::when($request->input('id'), function ($q) use ($request) {
            $q->where('id', $request->input('id'));
        })->when($request->input('descricao'), function ($q) use ($descricao) {
            $q->orWhereRaw("UPPER(descricao) LIKE '%" . strtoupper($descricao) . "%'")
                ->orWhereRaw("UPPER(titulo) LIKE '%" . strtoupper($descricao) . "%'");
        })->with('departamento', 'secao')
            ->whereHas('departamento', function ($q) use ($descricao) {
                $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($descricao) . "%'");
            })->get();

        if ($search->count() > 0) {
            return $this->success("Lista de Produtos", $search);
        } else {
            return $this->error("Nenhum produto encontrado", 400);
        }
    }

    public function saveOrUpdate(ProdutoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $produto = $id ? Produto::find($id) : new Produto;

            if ($id && !$produto) return $this->error("Não Possui o Produto $id", 404);
            $produto->descricao = $request->descricao;
            $produto->descricao_detalhada = $request->descricao_detalhada;
            $produto->titulo = $request->titulo;
            $produto->ean = $request->ean;
            $produto->unidade = $request->unidade;
            $produto->ncm = $request->ncm;
            $produto->departamentos_id = $request->departamentos_id;
            $produto->secoes_id = $request->secoes_id;
            $produto->qt_caixa = $request->qt_caixa;
            $produto->situacao = $request->situacao == 'true'  ? 1 : 0;

            $urlImagem = $this->createUrlImagem($request->url_imagem, trim($produto['ean']), 'produtos');

            if (!$urlImagem) {
                return response()->json(['message' => 'A Imagem do Sócio não é válida. Verifique o arquivo enviado.'], 500);
            }

            $produto->url_imagem = $urlImagem;

            // Save the user
            $produto->save();

            DB::commit();
            return $this->success(
                $id ? "Produto atualizado com sucesso"
                    : "Produto cadastrado com sucesso",
                $produto,
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
            $produto = Produto::find($id);

            // Check the user
            if (!$produto) return $this->error("Não Existe o produto $id", 404);

            // Delete the user
            $produto->delete();
            DB::commit();
            return $this->success("Produto deletado com Sucesso", $produto);
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
        $situacao = $request->input('situacao');
        $departamentoId = $request->input('departamento_id');
        $secaoId = $request->input('secao_id');

        $produtos = Produto::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($column) . "%'");
            $q->orWhereRaw("UPPER(titulo) LIKE '%" . strtoupper($column) . "%'");
        })->when($situacao, function ($prod) use ($situacao) {
            $situacao = $situacao == 'ativos' ? 1 : 0;
            return $prod->where('situacao', $situacao);
        })->when($departamentoId, function ($prod) use ($departamentoId) {
            return $prod->where('departamentos_id', $departamentoId);
        })->when($secaoId, function ($prod) use ($secaoId) {
            return $prod->where('secoes_id', $secaoId);
        })
            ->with('departamento', 'secao')
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $produtos;
    }
}
