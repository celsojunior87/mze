<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromocaoRequest;
use App\Interfaces\Cliente\PromocaoClienteInterface;
use App\Interfaces\PromocaoInterface;
use Illuminate\Http\Request;

class PromocaoClienteController extends Controller
{

    public function __construct(PromocaoClienteInterface $promocao)
    {
        $this->promocao = $promocao;
    }


    /**
     * Visualizar todos os promocaos
     *
     */

    public function getAll()
    {

        return $this->promocao->getAll();
    }

    /**
     * Pesquisa as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->promocao->search($request);
    }
}
