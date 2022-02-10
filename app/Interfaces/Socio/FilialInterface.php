<?php

namespace App\Interfaces\Socio;

use App\Http\Requests\FilialRequest;
use Illuminate\Http\Request;

interface FilialInterface
{
    public function search(Request $request);

    public function open(Request $request);
}
