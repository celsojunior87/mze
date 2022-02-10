<?php

namespace App\Http\Controllers\Api\SelfCheckout;

use App\Http\Controllers\Controller;
use App\Interfaces\Cliente\DepartamentoClienteInterface;
use Illuminate\Http\Request;

class DepartamentoAutoAtendimentoController extends Controller
{

    public function __construct(DepartamentoClienteInterface $departamento)
    {
        $this->departamento = $departamento;
    }

    /**
     * Visualizar todos os departamentos
     *
     */

    public function getAll()
    {

        return $this->departamento->getAll();
    }

    /**
     * Visualizar apenas um departamento
     */
    public function find($id)
    {
        return $this->departamento->findById($id);
    }


    /**
     * Pesquisa as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->departamento->search($request);
    }
}

