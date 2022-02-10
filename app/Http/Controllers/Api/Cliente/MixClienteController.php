<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Interfaces\Cliente\MixClienteInterface;
use Illuminate\Http\Request;

class MixClienteController extends Controller
{
    public function __construct(MixClienteInterface $mix)
    {
        $this->mix = $mix;
    }


    /**
     * Visualizar todos os mix
     *
     */

    public function getAll()
    {
        return $this->mix->getAll();
    }

   
}
