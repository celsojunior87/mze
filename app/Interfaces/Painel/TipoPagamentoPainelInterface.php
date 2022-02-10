<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\TipoPagamentoRequest;

interface TipoPagamentoPainelInterface
{




    /**
     * Create | Update mix
     *
     * @param   \App\Http\Requests\PrecoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/preco       For Create
     * @method  PUT     api/preco /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(TipoPagamentoRequest $request, $id = null);

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
