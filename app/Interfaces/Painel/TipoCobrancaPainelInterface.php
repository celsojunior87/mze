<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\TipoCobrancaRequest;
use App\Http\Requests\TipoPagamentoRequest;

interface TipoCobrancaPainelInterface
{


    /**
     * Get all tipo-cobranca
     *
     * @method  GET api/tipo-cobranca
     * @access  public
     */
    public function getAll();

    /**
     * Get secao By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/tipo-cobranca/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update mix
     *
     * @param   \App\Http\Requests\PrecoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/preco       For Create
     * @method  PUT     api/tipo-cobranca /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(TipoCobrancaRequest $request, $id = null);

    /**
     * Delete user
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/preco /{id}
     * @access  public
     */
    public function delete($id);


}
