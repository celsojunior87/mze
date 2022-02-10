<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\FilialRequest;

interface FilialClienteInterface
{
    /**
     * Get all Filiais
     *
     * @method  GET api/filiais
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/filial/{id}
     * @access  public
     */
    public function findById($id);

}
