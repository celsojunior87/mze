<?php

namespace App\Interfaces\Socio;

use App\Http\Requests\EntradaMercadoriaItemSocioRequest;
use App\Http\Requests\EntradaMercadoriaSocioRequest;
use App\Http\Requests\EstoqueSocioRequest;
use App\Http\Requests\SocioRequest;
use Illuminate\Http\Request;

interface EstoqueSocioInterface
{

    public function storeAll(EstoqueSocioRequest $request);
    public function search(Request $request);
}
