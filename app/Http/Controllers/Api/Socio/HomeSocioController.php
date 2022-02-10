<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Interfaces\Socio\HomeSocioInterface;
use Illuminate\Http\Request;

class HomeSocioController extends Controller
{


    public function __construct(HomeSocioInterface $home)
    {
        $this->home = $home;
    }


    public function search()
    {

        return $this->home->search();
    }
}
