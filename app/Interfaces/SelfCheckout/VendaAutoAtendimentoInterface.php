<?php


namespace App\Interfaces\SelfCheckout;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\VendaInsertRequest;
use App\Http\Requests\VendaRequest;
use Illuminate\Http\Request;

interface VendaAutoAtendimentoInterface
{


    public function UpdateCancelVenda(VendaRequest $request,$id);

    public function search($request);


    public function insert ($request);

}
