<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Termo;
use Illuminate\Http\Request;

class TermoController extends Controller
{

    public function __construct(Termo $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {

        return $this->model->getTermo();

    }
}
