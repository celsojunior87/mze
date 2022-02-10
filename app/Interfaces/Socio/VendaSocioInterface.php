<?php


namespace App\Interfaces\Socio;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\VendaInsertRequest;
use App\Http\Requests\VendaRequest;

interface VendaSocioInterface
{

    public function search($request);

    public function statusHistory($request);

    public function cancelaVenda($request);

    public function trocaProdutos($request);
}
