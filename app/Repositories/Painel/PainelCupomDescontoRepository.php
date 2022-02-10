<?php

namespace App\Repositories\Painel;

use App\Http\Requests\CupomDescontoRequest;
use App\Interfaces\Painel\PainelCupomDescontoInterface;
use App\Models\CupomDesconto;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;

class PainelCupomDescontoRepository implements PainelCupomDescontoInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(CupomDesconto $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        try {
            $cupomDesconto = $this->model->with('regiao')->paginate();
            return $this->success("Lista de Cupom de Desconto", $cupomDesconto);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(),404);
        }
    }

    public function findById($id)
    {
        try {
            $cupomDesconto = $this->model->with('regiao')->find($id);
            if(!$cupomDesconto) return $this->error("Não Possui Cupom de Desconto $id", 404);
            return $this->success("Detalhes dos Cupom de Desconto", $cupomDesconto);
        } catch(\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function saveOrUpdate(CupomDescontoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $cupomDesconto = $id ? CupomDesconto::find($id) : new CupomDesconto();
            if($id && !$cupomDesconto) return $this->error("Não Possui o Cupom de Desconto $id", 404);

            $cupomDesconto->codigo_cupom = $request->codigo_cupom;
            $cupomDesconto->dt_inicial = $request->dt_inicial;
            $cupomDesconto->dt_final = $request->dt_final;
            $cupomDesconto->perc_desc = $request->perc_desc;
            $cupomDesconto->vl_desc = $request->vl_desc;
            $cupomDesconto->regioes_id = $request->regioes_id;

            // Save the
            $cupomDesconto->save();
            DB::commit();
            return $this->success(
                $id ? "Cupom de Desconto Atualizado com sucesso"
                    : "Cupom de Desconto Criado com sucesso",
                $cupomDesconto, $id ? 200 : 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $cupomDesconto = CupomDesconto::find($id);
            if(!$cupomDesconto) return $this->error("Não Existe a Cupom de Desconto $id", 404);
            $cupomDesconto->delete();
            DB::commit();
            return $this->success("Cupom de Desconto deletado com Sucesso", $cupomDesconto);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }
}
