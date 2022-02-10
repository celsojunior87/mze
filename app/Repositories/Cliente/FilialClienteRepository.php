<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\FilialRequest;
use App\Interfaces\Cliente\FilialClienteInterface;
use App\Interfaces\FilialInterface;
use App\Models\Filial;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use Illuminate\Support\Facades\Hash;

class FilialClienteRepository implements FilialClienteInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(Filial $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        try {
            //$filial = $this->model->with('endereco', 'socio')->paginate(10);
            dd('dasdasdasdas');
            $filial = $this->model->with('regiao', 'socio', 'endereco');
            return $this->success("Lista de Filiais", $filial);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $filial = $this->model->with('endereco', 'socio')->find($id);
            if (!$filial) return $this->error("Não Possui filiais $id", 404);
            return $this->success("Detalhes das filiais", $filial);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
