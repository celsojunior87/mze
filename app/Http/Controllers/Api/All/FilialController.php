<?php

namespace App\Http\Controllers\Api\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilialRequest;
use App\Interfaces\All\FilialInterface;

class FilialController extends Controller
{
    public function __construct(FilialInterface $filial)
    {
        $this->filial = $filial;
    }

    /**
     * Visualizar todos as filials
     *
     */

    public function getAll()
    {

        return $this->filial->getAll();
    }

    /**
     * Visualizar apenas um filial
     */
    public function find($id)
    {
        return $this->filial->findById($id);
    }

     /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\FilialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilialRequest $request)
    {
        return $this->filial->saveOrUpdate($request);
    }

     /**
     * Atualiza os filials
     *
     * @param  \App\Http\Requests\FilialRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilialRequest $request, $id)
    {
        return $this->filial->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->filial->delete($id);
    }
}
