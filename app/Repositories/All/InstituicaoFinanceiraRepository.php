<?php

namespace App\Repositories\All;

use App\Http\Requests\InstituicaoFinanceiraRequest;
use App\Interfaces\All\InstituicaoFinanceiraInterface;
use Illuminate\Support\Facades\DB;
use App\Models\InstituicaoFinanceira;
use App\Traits\Response;
use Illuminate\Http\Request;

class InstituicaoFinanceiraRepository implements InstituicaoFinanceiraInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function getAll()
    {
        try {
            $instituicao = InstituicaoFinanceira::all();
            return $this->success("Lista de Instituições Financeiras", $instituicao);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findById($id)
    {
        try {
            $instituicao = InstituicaoFinanceira::find($id);
            if(!$instituicao) return $this->error("Não Possui Instituições Financeiras $id", 404);
            return $this->success("Detalhes das Instituicoes Financeiras", $instituicao);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(InstituicaoFinanceiraRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $instituicao = $id ? InstituicaoFinanceira::find($id) : new InstituicaoFinanceira;
            if($id && !$instituicao) return $this->error("Não Possui o Instituição Financeira $id", 404);
            $instituicao->descricao = $request->descricao;
            $instituicao->nome = $request->nome;
            $instituicao->codigo = $request->codigo;
            $instituicao->save();

            DB::commit();
            return $this->success(
                $id ? "Instituicao Financeira Atualizado com sucesso"
                    : "Instituicao Financeira Criado com sucesso",
                $instituicao, $id ? 200 : 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $instituicao = InstituicaoFinanceira::find($id);

            // Check the user
            if(!$instituicao) return $this->error("Não Existe o departamento $id", 404);

            // Delete the user
            $instituicao->delete();
            DB::commit();
            return $this->success("Departamento deletado com Sucesso", $instituicao);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
