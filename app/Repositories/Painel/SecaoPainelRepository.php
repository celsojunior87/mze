<?php

namespace App\Repositories\Painel;

use App\Http\Requests\SecaoRequest;
use App\Interfaces\Painel\SecaoPainelInterface;
use App\Models\Secao;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\ImageHandler;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SecaoPainelRepository implements SecaoPainelInterface
{

    use Response, ImageHandler;


    public function __construct(Secao $secao)
    {
        $this->promocao = $secao;
    }

    public function getAll()
    {
        try {
            $secao = Secao::all();
            return $this->success("Lista de Seções", $secao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $secao = $this->secao->find($id);
            if (!$secao) return $this->error("Não Possui Seção $id", 404);
            return $this->success("Detalhes da Seção", $secao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(SecaoRequest $request, $id = null)
    {


        DB::beginTransaction();
        try {

            $secao = $id ? Secao::find($id) : new Secao;
            if ($id && !$secao) return $this->error("Não Possui a Seção $id", 404);
            $secao->descricao = $request->descricao;
            $secao->situacao = $request->situacao;
            $secao->departamentos_id = $request->departamentos_id;
            $secao['url'] = $this->createUrlImagem($request->url, Str::slug($secao->descricao), 'secao');

            if ($secao['url'] == false) {
                return response()->json(['message' => 'A imagem não é válida. Verifique o arquivo enviado.'], 401);
            }
            // Save the user
            $secao->save();
            DB::commit();
            return $this->success(
                $id ? "Seção Atualizada com sucesso"
                    : "Seção Criada com sucesso",
                $secao,
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
            $secao = Secao::find($id);

            // Check the user
            if (!$secao) return $this->error("Não Existe a Seção $id", 404);

            // Delete the user
            $secao->delete();
            DB::commit();
            return $this->success("Seção deletada com Sucesso", $secao);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search($request)
    {
        try {
            $secoes = Secao::when($request->input('departamento_id'), function ($q) use ($request) {
                $q->where('departamentos_id', $request->input('departamento_id'))
                    ->whereHas('produto');
            })
                ->when($request->input('id'), function ($q) use ($request) {
                    $q->where('id', $request->id);
                })
                ->orderBy('descricao')
                ->get();

            return $this->success("Lista de Seções.", $secoes);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'descricao';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';

        $result = DB::table('tb_secoes')
            ->join('tb_departamentos', 'tb_secoes.departamentos_id', '=', 'tb_departamentos.id')
            ->select(
                'tb_secoes.*',
                'tb_departamentos.id as departamentos_id',
                'tb_departamentos.descricao as departamentos_descricao',
            )->when($request->input('search'), function ($q) use ($request) {
                $column = $request->input('search');
                $q->whereRaw("UPPER(tb_secoes.descricao) LIKE '%" . strtoupper($column) . "%'");
                $q->orWhereRaw("UPPER(tb_departamentos.descricao) LIKE '%" . strtoupper($column) . "%'");
            })
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $result;
    }
}
