<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendaAvaliacaoRequest;
use App\Http\Requests\VendaInsertRequest;
use App\Http\Requests\VendaRequest;
use App\Interfaces\Cliente\VendaClienteInterface;
use Illuminate\Http\Request;

class VendaClienteController extends Controller
{
    public function __construct(VendaClienteInterface $venda)
    {
        $this->venda = $venda;
    }


    public function update(Request $request)
    {
        return $this->venda->UpdateCancelVenda($request);
    }

    public function updateAvaliacao(Request $request, $id)
    {
        return $this->venda->UpdateAvaliacaSocio($request, $id);
    }

    public function search(Request $request)
    {
        return $this->venda->search($request);
    }


    public function insert(VendaInsertRequest $request)
    {

        return $this->venda->insert($request);
    }

    public function listPartners(Request $request)
    {
        return $this->venda->listPartners($request);
    }
}
