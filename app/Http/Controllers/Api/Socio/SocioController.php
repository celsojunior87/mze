<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocioRequest;
use App\Interfaces\Socio\SocioInterface;
use App\Models\Socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocioController extends Controller
{
    public function __construct(SocioInterface $socio, Socio $model)
    {
        $this->socio = $socio;
        $this->model = $model;
    }

    public function login(Request $request)
    {
        return $this->mainLogin($request, $this->model, 'socio');
    }

    /**Cadastrar os socios */

    public function registration(SocioRequest $request)
    {
        return $this->socio->registration($request);
    }


    public function getAll()
    {

        return $this->socio->getAll();
    }

    /**
     * Visualizar apenas um socio
     */
    public function find($id)
    {
        return $this->socio->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\SocioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioRequest $request)
    {
        return $this->socio->saveOrUpdate($request);
    }

    /**
     * Atualiza os socios
     *
     * @param  \App\Http\Requests\SocioRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocioRequest $request, $id)
    {
        return $this->socio->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->socio->delete($id);
    }

    public function search(Request $request)
    {
        return $this->socio->search($request);
    }

    public function updateDadosSocio(Request $request)
    {
        return $this->socio->updateDadosSocio($request);
    }

    public function toDataTable(Request $request)
    {
        return $this->socio->toDataTable($request);
    }
}
