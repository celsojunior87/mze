<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendaStatusRequest;
use App\Interfaces\Socio\VendaStatusSocioInterface;
use Illuminate\Http\Request;

class VendaStatusSocioController extends Controller
{


    public function __construct(VendaStatusSocioInterface $vendaStatus)
    {
        $this->vendaStatus = $vendaStatus;
    }

    public function updateStatus(VendaStatusRequest $request)
    {

        return $this->vendaStatus->update($request);
    }
}
