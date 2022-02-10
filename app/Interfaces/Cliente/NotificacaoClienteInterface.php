<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\NotificacaoClienteRequest;
use Illuminate\Http\Request;

interface NotificacaoClienteInterface
{
    /**
     * Get all preco
     *
     * @method  GET api/preco
     * @access  public
     */
    public function getAll(Request $request);


    /**
     * Create | Update mix
     *
     * @param   \App\Http\Requests\NotificacaoClienteRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/preco       For Create
     * @method  PUT     api/preco /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(NotificacaoClienteRequest $request, $id = null);


}
