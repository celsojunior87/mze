<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\DepartamentoRequest;
use App\Interfaces\Cliente\DepartamentoClienteInterface;
use App\Interfaces\DepartamentoInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Departamento;
use App\Models\Mix;
use App\Models\Produto;
use App\Models\Regiao;
use App\Traits\Response;
use App\Traits\BaseUrlReturn;

class DepartamentoClienteRepository implements DepartamentoClienteInterface
{
    // Use ResponseAPI Trait in this repository
    use Response, BaseUrlReturn;

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


    public function search($request)
    {
        if (!$request->regioes_id) return $this->error("O regioes id é obrigatória", 400);
        try {
            $departamentos = $this->consultaDepartamento($request->regioes_id);
            $dados = [];
            foreach ($departamentos as $key => $dep) {
                $d['id'] = $dep->id;
                $d['descricao'] = $dep->descricao;
                $d['url'] = $this->getUrl($dep->url);
                $d['situacao'] = $dep->situacao;
                $d['created_at'] = $dep->created_at;
                $d['updated_at'] = $dep->updated_at;
                $dados[$key] = $d;
            }
            if ($dados) {
                return $this->success("Detalhes dos Departamentos", $dados);
            } {
                return $this->success("Não existem departamentos para esta região.", $dados);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 403);
        }
    }

    public function consultaDepartamento($regioes_id)
    {
        $sql = "select tb_departamentos.* from (
                select distinct tb_produtos.departamentos_id as departamentos_id
                from tb_mix_itens, tb_produtos
                where tb_mix_itens.produtos_id = tb_produtos.id
                and tb_mix_itens.mix_id in (select
                                            case when dados.mix_regiao = 0 then mix_regiao_padrao else mix_regiao
                                            end mix
                                            from
                                            (select
                                            tb_regioes.id,
                                            tb_estados.regiao_padrao_id,
                                            coalesce ((select id from tb_mix where regioes_id = tb_regioes.id),0) as mix_regiao,
                                            tb_mix.id as mix_regiao_padrao
                                            from tb_regioes, tb_estados, tb_mix
                                            where tb_regioes.estados_id = tb_estados.id
                                            and tb_mix.regioes_id = tb_estados.regiao_padrao_id
                                            and tb_regioes.id = $regioes_id) dados)) departamentos, tb_departamentos
                where departamentos.departamentos_id = tb_departamentos.id
                order by tb_departamentos.descricao
            ";

        $departamentos = DB::select($sql);

        return $departamentos;
    }
}
