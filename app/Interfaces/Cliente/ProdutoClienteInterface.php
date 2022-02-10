<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\ProdutoRequest;
use Illuminate\Http\Request;

interface ProdutoClienteInterface
{
    /**
     * Get all Produtos
     *
     * @method  GET api/produtos
     * @access  public
     */
    public function getAll();


    public function search(Request $request);




}

