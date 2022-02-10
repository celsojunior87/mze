<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrecoRequest;
use App\Interfaces\Painel\PrecoPainelInterface;
use App\Interfaces\PrecoInterface;
use Illuminate\Http\Request;

class PrecoPainelController extends Controller
{
    public function __construct(PrecoPainelInterface $preco)
    {
        $this->preco = $preco;
    }


    /**
     * Visualizar todos os Preco
     *
     */

    public function getAll()
    {
        return $this->preco->getAll();
    }

    /**
     * Visualizar apenas uma preco
     */
    public function find($id)
    {
        return $this->preco->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrecoRequest $request)
    {
        return $this->preco->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\PrecoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrecoRequest $request, $id)
    {
        return $this->preco->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->preco->delete($id);
    }

    /**
     * Pesquisa as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\PrecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->preco->search($request);
    }
}
