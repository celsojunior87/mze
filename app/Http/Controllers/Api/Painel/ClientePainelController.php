<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Interfaces\Painel\ClientePainelInterface;
use Illuminate\Http\Request;

class ClientePainelController extends Controller
{


    public function __construct(ClientePainelInterface $userPainelInterface)
    {

        $this->userPainelInterface = $userPainelInterface;
    }


    public function getAll()
    {
        return $this->userPainelInterface->getAll();
    }
}
