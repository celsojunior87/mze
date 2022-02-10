<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\PrecoRequest;

interface PrecoClienteInterface
{
    /**
     * Get all preco
     *
     * @method  GET api/preco
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/preco/{id}
     * @access  public
     */
    public function findById($id);


    public function search($request);

   }
