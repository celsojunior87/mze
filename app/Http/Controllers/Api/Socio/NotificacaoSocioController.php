<?php

namespace App\Http\Controllers\Api\Socio;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificacaoClienteRequest;
use App\Interfaces\Socio\NotificacaoSocioInterface;
use Illuminate\Http\Request;

class NotificacaoSocioController extends Controller
{
    public function __construct(NotificacaoSocioInterface $notificacao)
    {
        $this->notificacao = $notificacao;
    }

    /**
     * Visualizar todas as notificaçãoes
     *
     */

    public function getAll(Request $request)
    {
        return $this->notificacao->getAll($request);
    }

    public function store(NotificacaoClienteRequest $request)
    {
        return $this->notificacao->saveOrUpdate($request);
    }

    public function update(NotificacaoClienteRequest $request)
    {
        return $this->notificacao->saveOrUpdate($request);
    }
}
