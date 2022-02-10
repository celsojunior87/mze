<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Interfaces\Cliente\ProdutoClienteInterface;
use Illuminate\Http\Request;

class ProdutoClienteController extends Controller
{

    public function __construct(ProdutoClienteInterface $produto)
    {
        $this->produto = $produto;
    }


    public function getAll()
    {

        return $this->produto->getAll();
    }


    public function search(Request $request)
    {
        return $this->produto->search($request);
    }

    public function getByDepartment(Request $request)
    {
        return $this->produto->getByDepartment($request);
    }
}
