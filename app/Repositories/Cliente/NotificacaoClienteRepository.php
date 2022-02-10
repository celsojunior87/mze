<?php

namespace App\Repositories\Cliente;


use App\Http\Requests\NotificacaoClienteRequest;
use App\Interfaces\Cliente\NotificacaoClienteInterface;
use App\Models\ChatClienteSocio;
use App\Models\NotificaoCliente;
use App\Service\ChatService;
use App\Service\NotificationService;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;


class NotificacaoClienteRepository implements NotificacaoClienteInterface
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


    public function saveOrUpdate(NotificacaoClienteRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $notificacao = $id ? NotificaoCliente::find($id) : new NotificaoCliente;
            if ($id && !$notificacao) return $this->error("Não Possui o Notificações $id", 404);
            $notificacao->titulo = $request->titulo;
            $notificacao->descricao = $request->descricao;
            $notificacao->regioes_id = $request->regioes_id;
            $notificacao->clientes_id = $request->clientes_id;
            $notificacao->dt_agendamento = $request->dt_agendamento;
            $notificacao->dt_envio = $request->dt_envio;
            $notificacao->promocoes_id = $request->promocoes_id;
            $notificacao->save();

            if(isset($request->clientes_id)){
                $this->notificationService->sendNotificationMessageToCliente(["titulo"=>$request->titulo, "descricao" => $request->descricao, "user_id" => $request->clientes_id]);
            }else{
                $this->notificationService->sendNotificationToAll(["titulo"=>$request->titulo, "descricao" => $request->descricao, "user_id" => $request->clientes_id]);
            }

            DB::commit();
            return $this->success(
                $id ? "Notificação de Cliente Atualizado com sucesso"
                    : "Notificação de Cliente Criado com sucesso",
                $notificacao, $id ? 200 : 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }

    }

}
