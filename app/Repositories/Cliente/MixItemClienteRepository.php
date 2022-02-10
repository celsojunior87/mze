<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\MixItemRequest;
use App\Interfaces\Cliente\MixItemClienteInterface;
use App\Interfaces\MixItemInterface;
use Illuminate\Support\Facades\DB;
use App\Models\MixItem;
use App\Traits\Response;

class MixItemClienteRepository implements MixItemClienteInterface
{
    public function __construct(MixItem $mixItem)
    {
        $this->mixItem = $mixItem;
    }

    use Response;

    public function getAll()
    {
        try {
            $mixItem = MixItem::all();
            return $this->success("Lista de Mix Itens", $mixItem);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

}
