<?php

namespace App\Repositories\Painel;

use App\Interfaces\Painel\EstoquePainelInterface;
use App\Models\Auditoria;
use App\Models\AuditoriaItem;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use Carbon\Carbon;

class EstoquePainelRepository implements EstoquePainelInterface
{
    use Response;

    public function auditoria($request)
    {
        try {
            DB::beginTransaction();
            $auditoria = new Auditoria();
            $auditoria->descricao = $request->descricao;
            $auditoria->tipo = 4;
            $auditoria->dt_criacao = Carbon::now();
            $auditoria->filiais_id = $request->filiais_id;
            $auditoria->save();
            DB::commit();
            $dados = $request->itens;
            foreach ($dados as $d) {
                $auditoriaItens = new AuditoriaItem();
                $auditoriaItens->auditoria_id = $auditoria->id;
                $auditoriaItens->produtos_id = $d['id'];
                $auditoriaItens->save();
                DB::commit();
            }
            return $this->success("Auditoria agendada com sucesso.", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error("Erro ao cadastrar auditoria.", 400);
        }
    }
}
