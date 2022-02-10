<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MixRequest;
use App\Interfaces\MixInterface;
use App\Interfaces\Painel\MixPainelInterface;
use Illuminate\Http\Request;

class MixPainelController extends Controller
{
    public function __construct(MixPainelInterface $mix)
    {
        $this->mix = $mix;
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
     * Visualizar apenas uma mix
     */
    public function find($id)
    {
        return $this->mix->findById($id);
    }


    public function search(Request $request)
    {
        return $this->mix->search($request);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\MixRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MixRequest $request)
    {
        return $this->mix->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\MixRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MixRequest $request, $id)
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

    public function productsToDataTable(Request $request, $mixId)
    {
        return $this->mix->productsToDataTable($request, $mixId);
    }

    public function updateLinkedProducts(Request $request, $mixId)
    {
        return $this->mix->updateLinkedProducts($request, $mixId);
    }

    public function unlinkProduct(Request $request, $mixId)
    {
        return $this->mix->unlinkProduct($request, $mixId);
    }
}
