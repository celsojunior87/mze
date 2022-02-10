<?php

namespace App\Repositories;

use App\Http\Requests\ChatClienteSocioRequest;
use App\Http\Requests\FilialRequest;
use App\Interfaces\ChatClienteSocioInterface;
use App\Interfaces\FilialInterface;
use App\Models\ChatClienteSocio;
use App\Models\Cliente;
use App\Models\Filial;
use App\Models\Socio;
use App\Service\ChatService;
use App\Service\NotificationService;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChatClienteSocioRepository implements ChatClienteSocioInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(ChatClienteSocio $model, ChatService $chatService, NotificationService $notificationService)
    {
        $this->model = $model;
        $this->chatService = $chatService;
        $this->notificationService = $notificationService;
    }


    public function getAll(Request $request)
    {
        try {
            $vendas_id = $request->vendas_id;


            $chat = $this->model->where(
                function ($query) use ($vendas_id) {
                    $query->where(["vendas_id" => $vendas_id]);
                }
            )->get();

            return $this->success("Lista de Mensagens", $chat);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function search(Request $request)
    {
        try {
            $userFrom = $request->socios_id;
            $userTo = $request->clientes_id;
            $vendas_id = $request->vendas_id;


            $chat = $this->model->where(
                function ($query) use ($userFrom, $userTo, $vendas_id) {
                    $query->where([
                        "socios_id" => $userFrom,
                        "clientes_id" => $userTo,
                        "vendas_id" => $vendas_id
                    ]);
                }
            )->orWhere(
                function ($query) use ($userFrom, $userTo, $vendas_id) {
                    $query->where([
                        "socios_id" => $userTo,
                        "clientes_id" => $userFrom,
                        "vendas_id" => $vendas_id
                    ]);
                }
            )->orderBy('created_at', 'ASC')->get();

            return $this->success("Lista de Mensagens", $chat);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $chat = $this->model->with('regiao', 'socio')->find($id);
            if (!$chat) return $this->error("Não Possui filiais $id", 404);
            return $this->success("Detalhes das filiais", $chat);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(ChatClienteSocioRequest $request)
    {

        DB::beginTransaction();
        try {
            //            return $request->user();
            $chat = new ChatClienteSocio();

            $chat->mensagem = $request->mensagem;
            $chat->socios_id = $request->socios_id;
            $chat->cliente_remetente = $request->cliente_remetente;
            $chat->clientes_id = $request->clientes_id;
            $chat->vendas_id = $request->vendas_id;
            $chat->substituicao = $request->substituicao;
            $chat->dt_envio = new DateTime();
            //            $chat->dt_leitura = $request->dt_leitura;


            // Save the
            $chat->save();

            $this->chatService->sendMessage($chat, $request->vendas_id);

            $message =  $chat->mensagem;
            if (strlen($message) > 30)
                $message = substr($chat->mensagem, 0, 30) . '...';

            $user_id = $request->clientes_id;
            if ($request->cliente_remetente) {
                $user_id = $request->socios_id;
                $this->notificationService->sendNotificationMessageToSocio(["titulo" => "Nova mensagem de " . $request->user()->nome, "descricao" => $message, "user_id" => $user_id]);
            } else {
                $this->notificationService->sendNotificationMessageToCliente(["titulo" => "Nova mensagem de " . $request->user()->nome, "descricao" => $message, "user_id" => $user_id]);
            }


            DB::commit();
            return $this->success(
                "Mensagem Criada com sucesso",
                $chat,
                201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }
}
