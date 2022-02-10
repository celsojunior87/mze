<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocioPainelRequest;
use App\Interfaces\Painel\SocioPainelInterface;
use App\Models\Socio;
use Illuminate\Http\Request;

class SocioPainelController extends Controller
{
    public function __construct(SocioPainelInterface $socio, Socio $model)
    {
        $this->socio = $socio;
        $this->model = $model;
    }

    public function login(Request $request)
    {
        return $this->mainLogin($request, $this->model, 'socio');
    }

    /**Cadastrar os socios */

    public function registration(SocioPainelRequest $request)
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
     * @param  \Illuminate\Http\Requests\SocioPainelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioPainelRequest $request)
    {
        return $this->socio->saveOrUpdate($request);
    }

    /**
     * Atualiza os socios
     *
     * @param  \App\Http\Requests\SocioPainelRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocioPainelRequest $request, $id)
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

    public function toDataTable(Request $request)
    {
        return $this->socio->toDataTable($request);
    }
}
