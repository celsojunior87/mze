<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\EntradaMercadoriaItemPainelRequest;
use App\Http\Requests\EntradaMercadoriaPainelRequest;
use App\Http\Requests\EstoquePainelRequest;
use App\Http\Requests\PainelRequest;
use Illuminate\Http\Request;

interface EstoquePainelInterface
{
    public function auditoria(Request $request);
}
