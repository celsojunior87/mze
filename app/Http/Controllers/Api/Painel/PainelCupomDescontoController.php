<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CupomDescontoRequest;
use App\Interfaces\Painel\PainelCupomDescontoInterface;
use Illuminate\Http\Request;

class PainelCupomDescontoController extends Controller
{
    public function __construct(PainelCupomDescontoInterface $cupomDesconto)
    {
        $this->cupomDesconto = $cupomDesconto;
    }

    /**
     * Visualizar todos os endereços
     *
     */

    public function getAll()
    {

        return $this->cupomDesconto->getAll();
    }

    /**
     * Visualizar apenas um endereço
     */
    public function find($id)
    {
        return $this->cupomDesconto->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\CupomDescontoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CupomDescontoRequest $request)
    {

        return $this->cupomDesconto->saveOrUpdate($request);
    }

    /**
     * Atualiza os Cupons de Desconto
     *
     * @param  \App\Http\Requests\cupomDescontoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CupomDescontoRequest $request, $id)
    {
        return $this->cupomDesconto->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->cupomDesconto->delete($id);
    }
}
