<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Interfaces\Socio\DashboardSocioInterface;
use Illuminate\Http\Request;

class DashboardSocioController extends Controller
{


    public function __construct(DashboardSocioInterface $dashboard)
    {
        $this->dashboard = $dashboard;
    }


    public function search(Request $request)
    {

        return $this->dashboard->search($request);
    }
}
