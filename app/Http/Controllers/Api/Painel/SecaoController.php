<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecaoRequest;
use App\Interfaces\Painel\SecaoPainelInterface;
use Illuminate\Http\Request;

class SecaoController extends Controller
{

    public function __construct(SecaoPainelInterface $secao)
    {
        $this->secao = $secao;
    }


    /**
     * Visualizar todos os secõess
     *
     */

    public function getAll()
    {

        return $this->secao->getAll();
    }

    /**
     * Visualizar apenas uma secao
     */
    public function find($id)
    {
        return $this->secao->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\SecaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecaoRequest $request)
    {
        return $this->secao->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\SecaoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SecaoRequest $request, $id)
    {
        return $this->secao->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->secao->delete($id);
    }

    /**
     * Pesquisa as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->secao->search($request);
    }

    public function toDataTable(Request $request)
    {
        return $this->secao->toDataTable($request);
    }
}
