<?php

namespace App\Interfaces\SelfCheckout;

use App\Http\Requests\PrecoRequest;

interface PrecoAutoAtendimentoInterface
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
