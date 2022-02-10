<?php

namespace App\Http\Controllers\Api\socio;

use App\Http\Controllers\Controller;
use App\Interfaces\Socio\FilialInterface;
use Illuminate\Http\Request;

class FiliaisSocioController extends Controller
{
    public function __construct(FilialInterface $filial)
    {
        $this->filial = $filial;
    }

    public function search(Request $request)
    {
        return $this->filial->search($request);
    }


    public function openAndClose(Request $request)
    {

        return $this->filial->open($request);
    }
}
