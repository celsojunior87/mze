<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\MixItemRequest;

interface MixItemClienteInterface
{
    /**
     * Get all mix item
     *
     * @method  GET api/mix-item
     * @access  public
     */
    public function getAll();

  
}
