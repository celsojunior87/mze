<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegiaoRequest;
use App\Interfaces\RegiaoInterface;
use Illuminate\Http\Request;

class RegiaoController extends Controller
{


    public function __construct(RegiaoInterface $regiao)
    {
        $this->regiao = $regiao;
    }

    /**
     * Visualizar todos os regiaos
     *
     */

    public function getAll()
    {

        return $this->regiao->getAll();
    }

    public function getStates(Request $request)
    {

        return $this->regiao->getStates($request);
    }

    /**
     * Visualizar apenas uma regiao
     */
    public function find($id)
    {
        return $this->regiao->findById($id);
    }

     /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\RegiaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegiaoRequest $request)
    {
        return $this->regiao->saveOrUpdate($request);
    }

     /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\RegiaoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegiaoRequest $request, $id)
    {
        return $this->regiao->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->regiao->delete($id);
    }

    public function toDataTable(Request $request)
    {
        return $this->regiao->toDataTable($request);

    }

    public function withMix(Request $request)
    {
        return $this->regiao->withMix($request);

    }

}
