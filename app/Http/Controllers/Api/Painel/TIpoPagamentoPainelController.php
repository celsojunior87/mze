<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoPagamentoRequest;
use App\Interfaces\Painel\TipoPagamentoPainelInterface;
use App\Models\TipoPagamento;
use Illuminate\Http\Request;

class TipoPagamentoPainelController extends Controller
{
    public function __construct(TipoPagamentoPainelInterface $tipoPagamento)
    {
        $this->tipoPagamento = $tipoPagamento;
    }


    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\TipoPagamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoPagamentoRequest $request)
    {
        return $this->tipoPagamento->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\TipoPagamentoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoPagamentoRequest $request, $id)
    {
        return $this->tipoPagamento->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->tipoPagamento->delete($id);
    }
}
