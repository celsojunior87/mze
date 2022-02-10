<?php


namespace App\Interfaces\Painel;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Client\Request;

interface ClientePainelInterface
{



    /**
     * Get all users
     *
     * @method  GET api/cliente
     * @access  public
     */
    public function getAll();
}
