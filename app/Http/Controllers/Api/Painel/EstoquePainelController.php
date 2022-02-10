<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Interfaces\Painel\EstoquePainelInterface;
use Illuminate\Http\Request;

class EstoquePainelController extends Controller
{
    public function __construct(EstoquePainelInterface $estoque)
    {
        $this->estoque = $estoque;
    }

    public function auditoria(Request $request)
    {
        return $this->estoque->auditoria($request);
    }
}
