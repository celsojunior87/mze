<?php

namespace App\Repositories\Painel;

use App\Http\Requests\TipoPagamentoRequest;
use App\Interfaces\Painel\TipoPagamentoPainelInterface;
use Illuminate\Support\Facades\DB;
use App\Models\TipoPagamento;
use App\Traits\Response;

class TipoPagamentoPainelRepository implements TipoPagamentoPainelInterface
{
    public function __construct(TipoPagamento $tipoPagamento)
    {
        $this->tipoPagamento = $tipoPagamento;
    }

    use Response;

    // public function getAll()
    // {
    //     try {
    //         $tipoPagamento = TipoPagamento::all();
    //         return $this->success("Lista de Tipo Pagamento", $tipoPagamento);
    //     } catch (\Exception $e) {
    //         return $this->error($e->getMessage(), $e->getCode());
    //     }
    // }
    public function findById($id)
    {
        try {
            $tipoPagamento = TipoPagamento::find($id);
            //$departamento = Departamento::find($produto->departamentos_id);
            //$produto->departamento = $departamento->descricao;
            if (!$tipoPagamento) return $this->error("Não Possui Mix $id", 404);
            return $this->success("Detalhes dos Tipos de Pagamento", $tipoPagamento);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(TipoPagamentoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $tipoPagamento = $id ? TipoPagamento::find($id) : new TipoPagamento;
            if ($id && !$tipoPagamento) return $this->error("Não Possui o Meio Pagamento $id", 404);

            $tipoPagamento->descricao = $request->descricao;
            $tipoPagamento->situacao = $request->situacao;

            $tipoPagamento->save();

            DB::commit();
            return $this->success(
                $id ? "Tipo Pagamento Atualizado com sucesso"
                    : "Tipo Pagamento Criado com sucesso",
                $tipoPagamento, $id ? 200 : 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $tipoPagamento = TipoPagamento::find($id);

            // Check the user
            if (!$tipoPagamento) return $this->error("Não Existe o Tipo de Pagamento $id", 404);

            // Delete the user
            $tipoPagamento->delete();
            DB::commit();
            return $this->success("Tipo de Pagamento deletado com Sucesso", $tipoPagamento);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


}
