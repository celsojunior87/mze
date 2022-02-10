<?php

namespace App\Http\Controllers\Api\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContaBancariaRequest;
use App\Interfaces\All\ContaBancariaInterface;

class ContaBancariaController extends Controller
{
    public function __construct(ContaBancariaInterface $conta)
    {
        $this->conta = $conta;
    }

    public function getAll()
    {
        return $this->conta->getAll();
    }

    public function find($id)
    {
        return $this->conta->findById($id);
    }

    public function store(ContaBancariaRequest $request)
    {
        return $this->conta->saveOrUpdate($request);
    }

    public function update(ContaBancariaRequest $request, $id)
    {
        return $this->conta->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->conta->delete($id);
    }
}
