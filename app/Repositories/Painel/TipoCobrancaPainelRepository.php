<?php

namespace App\Repositories\Painel;

use App\Http\Requests\SecaoRequest;
use App\Http\Requests\TipoCobrancaRequest;
use App\Interfaces\Painel\SecaoPainelInterface;
use App\Interfaces\Painel\TipoCobrancaPainelInterface;
use App\Models\secao;
use App\Models\TipoCobranca;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\ImageHandler;
use Illuminate\Support\Str;

class TipoCobrancaPainelRepository implements TipoCobrancaPainelInterface
{

    use Response;


    public function __construct(TipoCobranca $tipoCobranca)
    {
        $this->tipoCobranca = $tipoCobranca;
    }

    public function getAll()
    {
        try {
            $tipoCobranca = TipoCobranca::all();
            return $this->success("Lista de Tipo de Cobranças", $tipoCobranca);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $tipoCobranca = $this->tipoCobranca->find($id);
            if (!$tipoCobranca) return $this->error("Não Possui Seção $id", 404);
            return $this->success("Detalhes da Seção", $tipoCobranca);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function saveOrUpdate(TipoCobrancaRequest $request, $id = null)
    {


        DB::beginTransaction();
        try {

            $tipoCobranca = $id ? TipoCobranca::find($id) : new TipoCobranca;
            if ($id && !$tipoCobranca) return $this->error("Não Possui o Tipo de Cobrança $id", 404);
            $tipoCobranca->descricao = $request->descricao;
            $tipoCobranca->situacao = $request->situacao;
            // Save the tipo de cobrança
            $tipoCobranca->save();
            DB::commit();
            return $this->success(
                $id ? "Tipo de Cobrança Atualizada com sucesso"
                    : "Tipo de Cobrança com sucesso",
                $tipoCobranca,
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
            $tipoCobranca = TipoCobranca::find($id);

            // Check the user
            if (!$tipoCobranca) return $this->error("Não Existe a tipo de cobrança $id", 404);

            // Delete the user
            $tipoCobranca->delete();
            DB::commit();
            return $this->success("Seção deletada com Sucesso", $tipoCobranca);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


}
