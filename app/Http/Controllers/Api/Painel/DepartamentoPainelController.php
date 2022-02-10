<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentoRequest;
use App\Interfaces\Painel\DepartamentoPainelInterface;
use Illuminate\Http\Request;

class DepartamentoPainelController extends Controller
{

    public function __construct(DepartamentoPainelInterface $departamento)
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
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\DepartamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {
        return $this->departamento->saveOrUpdate($request);
    }

     /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\DepartamentoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoRequest $request, $id)
    {
        return $this->departamento->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->departamento->delete($id);
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

    public function toDataTable(Request $request)
    {
        return $this->departamento->toDataTable($request);
    }
}

