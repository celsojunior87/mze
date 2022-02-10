<?php

namespace App\Http\Controllers\Api\SelfCheckout;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendaRequest;
use App\Interfaces\SelfCheckout\VendaAutoAtendimentoInterface;
use Illuminate\Http\Request;

class VendaAutoAtendimentoController extends Controller
{
    public function __construct(VendaAutoAtendimentoInterface $venda)
    {
        $this->venda = $venda;
    }


    public function update(VendaRequest $request,$id)
    {
        return $this->venda->UpdateCancelVenda($request,$id);
    }

    public function search(Request $request)
    {
        return $this->venda->search($request);
    }


    public function insert(Request $request)
    {
        return $this->venda->insert($request);
    }

}
