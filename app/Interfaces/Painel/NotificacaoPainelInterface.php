<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\NotificacaoPainelRequest;
use Illuminate\Http\Request;

interface NotificacaoPainelInterface
{
    /**

     *
     * @method  GET api/
     * @access  public
     */
    public function getAll(Request $request);


    /**
     *
     *
     * @param   \App\Http\Requests\NotificacaoClienteRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/preco       For Create
     * @method  PUT     api/preco /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(NotificacaoPainelRequest $request, $id = null);

    public function toDataTable(Request $request);
}
