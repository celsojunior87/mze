<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Interfaces\Cliente\StatusClienteInterface;
use Illuminate\Http\Request;

class StatusClienteController extends Controller
{
    public function __construct(StatusClienteInterface $status)
    {
        $this->status = $status;
    }

    public function search(Request $request)
    {
        return $this->status->search($request);
    }
}
