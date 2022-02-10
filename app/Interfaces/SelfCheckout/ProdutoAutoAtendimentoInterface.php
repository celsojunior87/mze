<?php

namespace App\Interfaces\SelfCheckout;

use App\Http\Requests\ProdutoRequest;
use Illuminate\Http\Request;

interface ProdutoAutoAtendimentoInterface
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

