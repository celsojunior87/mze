<?php

namespace App\Http\Controllers\Api\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituicaoFinanceiraRequest;
use App\Interfaces\All\InstituicaoFinanceiraInterface;
use Illuminate\Http\Request;

class InstituicaoFinanceiraController extends Controller
{


    public function __construct(InstituicaoFinanceiraInterface $instituicaoFinanceiraInterface)
    {
        $this->instituicao = $instituicaoFinanceiraInterface;
    }

    /**
     * Visualizar todos os instituicaos
     *
     */

    public function getAll()
    {

        return $this->instituicao->getAll();
    }

    /**
     * Visualizar apenas um instituicao
     */
    public function find($id)
    {
        return $this->instituicao->findById($id);
    }

     /**
     * Salvar as informações no banco de dados
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InstituicaoFinanceiraRequest $request)
    {
        return $this->instituicao->saveOrUpdate($request);
    }

     /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\InstituicaoFinanceiraRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituicaoFinanceiraRequest $request, $id)
    {
        return $this->instituicao->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->instituicao->delete($id);
    }


}
