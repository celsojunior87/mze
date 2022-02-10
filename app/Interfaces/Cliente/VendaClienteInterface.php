<?php


namespace App\Interfaces\Cliente;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\VendaAvaliacaoRequest;
use App\Http\Requests\VendaInsertRequest;
use App\Http\Requests\VendaRequest;

interface VendaClienteInterface
{


    public function UpdateCancelVenda($request);

    public function UpdateAvaliacaSocio(VendaAvaliacaoRequest $request, $id);

    public function search($request);

    public function listPartners($request);


    public function insert(VendaInsertRequest $request);
}
