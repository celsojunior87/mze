<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueSocioRequest;
use App\Interfaces\Socio\EstoqueSocioInterface;
use App\Models\Socio;
use Illuminate\Http\Request;

class EstoqueSocioController extends Controller
{
    public function __construct(EstoqueSocioInterface $estoque, Socio $model)
    {
        $this->estoque = $estoque;
        $this->model = $model;
    }

    /**
     *
     * Salva as entradas de mercadorias , entrada de mercadorias itens e o estoque
     */
    public function store(EstoqueSocioRequest $request)
    {
        return $this->estoque->storeAll($request);
    }

    public function list(EstoqueSocioRequest $request)
    {
        return $this->estoque->list($request);
    }

    public function search(Request $request)
    {
        return $this->estoque->search($request);
    }

    public function auditoria(Request $request)
    {
        return $this->estoque->auditoria($request);
    }
}
