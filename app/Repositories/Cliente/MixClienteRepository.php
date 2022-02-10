<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\MixRequest;
use App\Interfaces\Cliente\MixClienteInterface;
use App\Models\Mix;
use App\Traits\Response;

class MixClienteRepository implements MixClienteInterface
{
    public function __construct(Mix $mix)
    {
        $this->mix = $mix;
    }

    use Response;

    public function getAll()
    {
        try {
            $mix = Mix::all();
            return $this->success("Lista de Mix", $mix);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


}
