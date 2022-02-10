<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrecoRequest;
use App\Interfaces\Cliente\PrecoClienteInterface;
use Illuminate\Http\Request;

class PrecoClienteController extends Controller
{
    public function __construct(PrecoClienteInterface $preco)
    {
        $this->preco = $preco;
    }


    /**
     * Visualizar todos os Preco
     *
     */

    public function getAll()
    {
        return $this->preco->getAll();
    }



    /**
     * Pesquisa as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->preco->search($request);
    }
}
