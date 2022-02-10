<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Interfaces\Painel\ProdutoPainelInterface;
use Illuminate\Http\Request;

class ProdutoPainelController extends Controller
{

    public function __construct(ProdutoPainelInterface $produto)
    {
        $this->produto = $produto;
    }

    public function getAll()
    {

        return $this->produto->getAll();
    }

     /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PromocaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        return $this->produto->saveOrUpdate($request);
    }

     /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\PromocaoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        return $this->produto->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->produto->delete($id);
    }



    public function search(Request $request)
    {
        return $this->produto->search($request);
    }


    public function toDataTable(Request $request)
    {
        return $this->produto->toDataTable($request);

    }
}


