<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Interfaces\Painel\StatusPainelInterface;
use Illuminate\Http\Request;

class StatusPainelController extends Controller
{
    public function __construct(StatusPainelInterface $status)
    {
        $this->status = $status;
    }


    /**
     * Visualizar todos os status
     *
     */

    public function getAll()
    {

        return $this->status->getAll();
    }

    /**
     * Visualizar apenas uma status
     */
    public function find($id)
    {
        return $this->status->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\StatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        return $this->status->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\StatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, $id)
    {
        return $this->status->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->status->delete($id);
    }
}
