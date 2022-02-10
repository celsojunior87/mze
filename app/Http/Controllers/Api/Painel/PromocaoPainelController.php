<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromocaoRequest;
use App\Interfaces\Painel\PromocaoPainelInterface;
use App\Interfaces\PromocaoInterface;
use Illuminate\Http\Request;

class PromocaoPainelController extends Controller
{

    public function __construct(PromocaoPainelInterface $promocao)
    {
        $this->promocao = $promocao;
    }


    /**
     * Visualizar todos os promocaos
     *
     */

    public function getAll()
    {

        return $this->promocao->getAll();
    }

    /**
     * Visualizar apenas uma promocao
     */
    public function find($id)
    {
        return $this->promocao->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PromocaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromocaoRequest $request)
    {
        return $this->promocao->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\PromocaoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromocaoRequest $request, $id)
    {
        return $this->promocao->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->promocao->delete($id);
    }

    /**
     * Pesquisa as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->promocao->search($request);
    }

    public function toDataTable(Request $request)
    {
        return $this->promocao->toDataTable($request);
    }
}
