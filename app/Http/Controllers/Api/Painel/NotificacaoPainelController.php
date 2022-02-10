<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificacaoClienteRequest;
use App\Http\Requests\NotificacaoPainelRequest;
use App\Interfaces\Painel\NotificacaoPainelInterface;
use Illuminate\Http\Request;

class NotificacaoPainelController extends Controller
{

    public function __construct(NotificacaoPainelInterface $notificacao)
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

    public function store(NotificacaoPainelRequest $request)
    {
        return $this->notificacao->saveOrUpdate($request);
    }

    public function toDataTable(Request $request)
    {
        return $this->notificacao->toDataTable($request);
    }

    public function update(NotificacaoPainelRequest $request, $id)
    {
        return $this->notificacao->saveOrUpdate($request, $id);
    }

    public function search(NotificacaoPainelRequest $request)
    {
        return $this->notificacao->search($request);
    }

    public function destroy(Request $request)
    {
        return $this->notificacao->destroy($request);
    }

}
