<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Interfaces\Socio\StatusSocioInterface;
use Illuminate\Http\Request;

class StatusSocioController extends Controller
{


    public function __construct(StatusSocioInterface $status)
    {
        $this->status = $status;
    }

    public function search(Request $request)
    {
        return $this->status->search($request);
    }
}
