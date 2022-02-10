<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Requests\SecaoRequest;
use App\Http\Requests\TipoCobrancaRequest;
use App\Interfaces\Painel\SecaoPainelInterface;
use App\Interfaces\Painel\TipoCobrancaPainelInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoCobrancaPainelController extends Controller
{


    public function __construct(TipoCobrancaPainelInterface $tipoCobranca)
    {
        $this->tipoCobranca = $tipoCobranca;
    }
    /**
     * Visualizar todos os tipos de cobranças
     *
     */

    public function getAll()
    {

        return $this->tipoCobranca->getAll();
    }

    /**
     * Visualizar apenas um tipo de cobrança
     */
    public function find($id)
    {
        return $this->tipoCobranca->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\TipoCobrancaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoCobrancaRequest $request)
    {
        return $this->tipoCobranca->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\TipoCobrancaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoCobrancaRequest $request, $id)
    {
        return $this->tipoCobranca->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->tipoCobranca->delete($id);
    }

}
