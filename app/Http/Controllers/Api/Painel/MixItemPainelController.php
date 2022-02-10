<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MixItemRequest;
use App\Interfaces\Painel\MixItemPainelInterface;
use Illuminate\Http\Request;

class MixItemPainelController extends Controller
{
    public function __construct(MixItemPainelInterface $mixItem)
    {
        $this->mix = $mixItem;
    }


    /**
     * Visualizar todos os mix
     *
     */

    public function getAll(Request $request)
    {
        return $this->mix->getAll($request);
    }

    /**
     * Visualizar apenas uma mix item
     */
    public function find($id)
    {
        return $this->mix->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\MixRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MixItemRequest $request)
    {
        return $this->mix->saveOrUpdate($request);
    }

    /**
     * Atualiza o mix item
     *
     * @param  \App\Http\Requests\MixRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MixItemRequest $request, $id)
    {
        return $this->mix->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->mix->delete($id);
    }

    public function toDataTable(Request $request)
    {
        return $this->mix->toDataTable($request);
    }
}
