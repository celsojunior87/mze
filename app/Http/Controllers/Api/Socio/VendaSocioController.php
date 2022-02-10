<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendaInsertRequest;
use App\Http\Requests\VendaRequest;
use App\Http\Requests\VendaSocioRequest;
use App\Interfaces\Cliente\VendaClienteInterface;
use App\Interfaces\Socio\VendaSocioInterface;
use Illuminate\Http\Request;

class VendaSocioController extends Controller
{
    public function __construct(VendaSocioInterface $venda)
    {
        $this->venda = $venda;
    }

    public function search(VendaSocioRequest $request)
    {
        return $this->venda->search($request);
    }

    public function statusHistory(Request $request)
    {
        return $this->venda->statusHistory($request);
    }

    public function cancelaVenda(Request $request)
    {
        return $this->venda->cancelaVenda($request);
    }

    public function trocaProdutos(Request $request)
    {
        return $this->venda->trocaProdutos($request);
    }
}
