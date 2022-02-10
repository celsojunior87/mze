<?php

namespace App\Repositories\SelfCheckout;

use App\Interfaces\SelfCheckout\DepartamentoAutoAtendimentoInterface;
use App\Models\Departamento;
use App\Models\Mix;
use App\Traits\Response;

class DepartamentoAutoAtendimentoRepository implements DepartamentoAutoAtendimentoInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

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
        if (!$request->regioes_id) return $this->error("O regioes id é obrigatória", 404);

        try {
            if ($request->input('mix_id')) {
                $mix = Mix::where('regioes_id', $request->regioes_id)->get()->toArray();
                if ($mix[0]['id'] != $request->input('mix_id')) {
                    return $this->error("O mix não pertence a essa região.", 400);
                }
                $departamentos = Departamento::whereHas('produtos', function ($produto) use ($request) {
                    return $produto->whereHas('mix', function ($mix) use ($request) {
                        return $mix->where('tb_mix.id', $request->mix_id);
                    });
                })->get();
            } else {
                $departamentos = Departamento::whereHas('produtos', function ($produto) use ($request) {
                    return $produto->whereHas('mix', function ($mix) use ($request) {
                        $mix_id = Mix::where('regioes_id', $request->regioes_id)->get()->toArray();
                        return $mix->where('tb_mix.id', $mix_id[0]['id']);
                    });
                })->get();
            }
            return $this->success("Detalhes dos Departamentos", $departamentos);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }
}
