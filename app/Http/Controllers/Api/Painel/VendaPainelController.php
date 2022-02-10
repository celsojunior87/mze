<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Interfaces\Painel\VendaPainelInterface;
use Illuminate\Http\Request;


class VendaPainelController extends Controller
{
    public function __construct(VendaPainelInterface $venda)
    {
        $this->venda = $venda;
    }

    public function pedidos(Request $request)
    {
        return $this->venda->pedidos($request);
    }

    public function faturamento(Request $request)
    {
        return $this->venda->faturamento($request);
    }
}
