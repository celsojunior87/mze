<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoPagamentoRequest;
use App\Interfaces\TipoPagamentoInterface;
use App\Models\TipoPagamento;
use Illuminate\Http\Request;

class TipoPagamentoClienteController extends Controller
{
    public function __construct(TipoPagamentoInterface $tipoPagamento)
    {
        $this->tipoPagamento = $tipoPagamento;
    }


    public function getAll()
    {
        return $this->tipoPagamento->getAll();
    }

}
