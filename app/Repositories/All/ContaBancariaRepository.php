<?php

namespace App\Repositories\All;

use App\Http\Requests\ContaBancariaRequest;
use App\Interfaces\All\ContaBancariaInterface;
use App\Models\ContaBancaria;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;

class ContaBancariaRepository implements ContaBancariaInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(ContaBancaria $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        try {
            $conta = $this->model->with('instituicaoFinanceira', 'socio')->paginate(10);
            return $this->success("Lista de Contas Bancárias", $conta);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $conta = $this->model->with('instituicaoFinanceira', 'socio')->find($id);
            if (!$conta) return $this->error("Conta Bancária com ID: $id não encontrada.", 404);
            return $this->success("Detalhes da Conta Bancária", $conta);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(ContaBancariaRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            $conta = $id ? $this->model->find($id) : new $this->model();
            if (!$conta) return $this->error("Conta Bancária com ID: $id não encontrada.", 404);

            $conta->nome = $request->nome;
            $conta->titular = $request->titular;
            $conta->agencia = $request->agencia;
            $conta->num_conta = $request->num_conta;
            $conta->cpf = $request->cpf;
            $conta->chave_pix = $request->chave_pix;
            $conta->socios_id = $request->socios_id;
            $conta->instituicoes_financeiras_id = $request->instituicoes_financeiras_id;
            $conta->save();


            DB::commit();
            return $this->success(
                $id ? "Conta Bancária Atualizada com sucesso"
                    : "Conta Bancária Criada com sucesso",
                $conta,
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
            $conta = $this->model->find($id);
            if (!$conta) return $this->error("Não Existe a filial $id", 404);
            $conta->delete();
            DB::commit();
            return $this->success("Conta Bancária deletada com Sucesso", $conta);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }
}
