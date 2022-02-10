<?php

namespace App\Repositories\Painel;


use App\Http\Requests\NotificacaoPainelRequest;
use App\Interfaces\Painel\NotificacaoPainelInterface;
use App\Models\Cliente;
use App\Models\NotificacaoSocio;
use App\Models\NotificaoCliente;
use App\Service\NotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificacaoPainelRepository implements NotificacaoPainelInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function getAll($request)
    {
        try {
            $clientes_id = $request->user()->id;
            $regioes_id = $request->regioes_id;

            $notificacao = NotificaoCliente::where(
                function ($query) use ($regioes_id) {
                    $query->where(["regioes_id" => $regioes_id])->orWhere("regioes_id", "=", null);
                }
            )->where(
                function ($query) use ($clientes_id) {
                    $query->where(["clientes_id" => $clientes_id])->orWhere("clientes_id", "=", null);
                }
            )->orderBy('created_at', 'ASC')->get();

            return $this->success("Lista de Notificações dos Clientes", $notificacao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function toDataTable(Request $request)
    {
        if (!$request->fluxo) {
            return $this->error('O fluxo é obrigatório.', 400);
        }

        $sort = $request->sort ?? 'descricao';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';
        $fluxo = Str::slug($request->fluxo);


        if ($fluxo == 'clientes') {
            $result = NotificaoCliente::with('cliente')->with('regiao')
                ->orderBy($sort, $dir)
                ->paginate($items);
        }

        if ($fluxo == 'socios') {
            $result = NotificacaoSocio::with('socio')->with('regiao')
                ->orderBy($sort, $dir)
                ->paginate($items);
        }

        return $result;
    }

    public function saveOrUpdate(NotificacaoPainelRequest $request, $id = null)
    {
        if (!$request->fluxo) {
            return $this->error('O fluxo é obrigatório.', 400);
        }

        DB::beginTransaction();
        try {
            $fluxo = Str::slug($request->fluxo);

            if ($fluxo == 'socios') {
                $notificacao = $id ? NotificacaoSocio::find($id) : new NotificacaoSocio();
                if (($request->regioes_id && $request->socios_id) || (is_null($request->regioes_id) && is_null($request->socios_id))) {
                    return $this->error("Escolha região ou sócio", 400);
                }
            }

            if ($fluxo == 'clientes') {
                $notificacao = $id ? NotificaoCliente::find($id) : new NotificaoCliente();
                if (($request->regioes_id && $request->clientes_id) || (is_null($request->regioes_id) && is_null($request->clientes_id))) {
                    return $this->error("Escolha região ou cliente", 400);
                }
            }

            if ($id && !$notificacao) return $this->error("Não Possui o Notificações $id", 400);
            $notificacao->titulo = $request->titulo;
            $notificacao->descricao = $request->descricao;

            if ($request->regioes_id) {
                $notificacao->regioes_id = $request->regioes_id;
            }

            if ($request->clientes_id) {
                $notificacao->clientes_id = $request->clientes_id;
            }

            if ($request->socios_id) {
                $notificacao->socios_id = $request->socios_id;
            }

            if ($request->promocoes_id) {
                $notificacao->promocoes_id = $request->promocoes_id;
            }

            $notificacao->dt_agendamento = $request->dt_agendamento;
            $notificacao->dt_envio = $request->dt_envio;

            $notificacao->save();

            if (is_null($notificacao->dt_agendamento)) {
                $sent = $this->sendNotification($fluxo, $notificacao);
                if ($sent) {
                    $notificacao->dt_envio = Carbon::now();
                    $notificacao->save();
                }
            }

            DB::commit();
            return $this->success(
                $id ? "Notificação Atualizada com sucesso"
                    : "Notificação Criada com sucesso",
                $notificacao,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 400);
        }
    }

    public function sendNotification($fluxo, $notificacao)
    {
        if ($fluxo === 'clientes') {
            $user_id = $notificacao->clientes_id;
            $this->notificationService->sendNotificationMessageToCliente(
                [
                    "titulo" => $notificacao->titulo,
                    "descricao" => $notificacao->descricao,
                    "user_id" => $user_id
                ]
            );
        }

        if ($fluxo === 'socios') {
            $user_id = null;
            $this->notificationService->sendNotificationMessageToSocio(
                [
                    "titulo" => $notificacao->titulo,
                    "descricao" => $notificacao->descricao,
                    "user_id" => $user_id
                ]
            );
        }

        return true;

        // elseif ($notificacao->regioes_id !== null) {

        //     $clientes = Cliente::whereHas('regiao', function ($q) use ($notificacao) {
        //         $q->where('id', $notificacao->regioes_id);
        //     })->get();

        //     foreach ($clientes as $cliente) {
        //         $this->notificationService->sendNotificationMessageToCliente(["titulo" => $notificacao->titulo, "descricao" => $notificacao->descricao, "user_id" => $cliente->id]);
        //     }
        // }

        // if ($notificacao->clientes_id !== null) {
        //     $user_id = $notificacao->clientes_id;
        //     $this->notificationService->sendNotificationMessageToSocio(["titulo" => $notificacao->titulo, "descricao" => $notificacao->descricao, "user_id" => $notificacao->clientes_id]);
        // } else {
        //     $this->notificationService->sendNotificationMessageToCliente(["titulo" => "Nova mensagem de " . $request->user()->nome, "descricao" => $message, "user_id" => $user_id]);
        // }
    }

    public function search($request)
    {
        if (!$request->fluxo) {
            return $this->error('O fluxo é obrigatório.', 400);
        }

        try {
            $fluxo = Str::slug($request->fluxo);

            if ($fluxo == 'socios') {
                $result = NotificacaoSocio::when($request->input('id'), function ($q) use ($request) {
                    $q->where('id', $request->id)->get();
                });
            }

            if ($fluxo == 'clientes') {
                $result = NotificaoCliente::when($request->input('id'), function ($q) use ($request) {
                    $q->where('id', $request->id)->get();
                });
            }


            return $this->success("Lista de notificações", $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function destroy($request)
    {
        if (!$request->fluxo) {
            return $this->error('O fluxo é obrigatório.', 400);
        }

        try {

            $fluxo = Str::slug($request->fluxo);

            if ($fluxo == 'socios') {
                $result = NotificacaoSocio::find($request->id);
            }

            if ($fluxo == 'clientes') {
                $result = NotificaoCliente::find($request->id);
            }

            if ($result->exists) {
                $result->delete();
            }

            return $this->success("Notificação deletada com Sucesso", $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
