<?php

namespace App\Http\Controllers\Api\All;

use App\Events\Messages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatClienteSocioRequest;
use App\Interfaces\ChatClienteSocioInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OneSignal;

class ChatClienteSocioController extends Controller
{
    public function __construct(ChatClienteSocioInterface $chatClienteSocio)
    {
        $this->chatClienteSocio = $chatClienteSocio;
    }

    public function getAll(Request $request)
    {
//        return $request->user();
        return $this->chatClienteSocio->getAll($request);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\ChatClienteSocioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatClienteSocioRequest $request)
    {
//        return $request->user();
        return $this->chatClienteSocio->saveOrUpdate($request);
    }
}
