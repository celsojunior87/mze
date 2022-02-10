<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificacaoClienteRequest;
use App\Interfaces\Cliente\NotificacaoClienteInterface;
use App\Models\Venda;
use Illuminate\Http\Request;
use OneSignal;
use App\Service\NotificationService;


class NotificacaoController extends Controller
{

    public function __construct(NotificacaoClienteInterface $notificacao, NotificationService $notificationService)
    {
        $this->notificacao = $notificacao;
        $this->notificationService = $notificationService;
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
        try {
//            OneSignal::addParams([
//                "app_url" => 'mzeappcliente://app/notification',
//                'headings' => [
//                    'en' => $request->titulo
//                ],
//                'ios_badgeType' => "Increase",
//                'ios_badgeCount' => 1
//            ])->sendNotificationToAll(
//                $request->descricao
//            );


            $venda = Venda::find(1);
            $this->notificationService->sendNotificationMessageToSocio(["titulo"=>"Solicitação de pedido #C23456", "descricao" => "Aceitar Pedido?", "user_id" => $request->socios_id, "data"=> $venda]);


        }catch (\Exception $e){
            return $e;
        }

        return $this->notificacao->saveOrUpdate($request);
    }

    public function update(NotificacaoClienteRequest $request)
    {
        return $this->notificacao->saveOrUpdate($request);
    }


}

//
//namespace App\Http\Controllers\Api\Cliente;
//
//use App\Http\Controllers\Controller;
//use App\Http\Requests\NotificacaoClienteRequest;
//use App\Interfaces\Cliente\NotificacaoClienteInterface;
//use Illuminate\Http\Request;
//use OneSignal;
//use Berkayk\OneSignal\OneSignalClient;
//
//
//class NotificacaoController extends Controller
//{
//
//    public function __construct(NotificacaoClienteInterface $notificacao)
//    {
//        $this->notificacao = $notificacao;
//    }
//
//    /**
//     * Visualizar todas as notificaçãoes
//     *
//     */
//
//    public function getAll(Request $request)
//    {
//
//        return $this->notificacao->getAll($request);
//    }
//
//    public function store(NotificacaoClienteRequest $request)
//    {
//        return env('SOCIO_ONESIGNAL_APP_ID');
//        try {
////            OneSignal::addParams([
////                "app_url" => 'mzeappcliente://app/notification',
////                'headings' => [
////                    'en' => $request->titulo
////                ],
////                'ios_badgeType' => "Increase",
////                'ios_badgeCount' => 1
////            ])->sendNotificationToAll(
////                $request->descricao
////            );
//
//
//            $params = array(
//                'app_id' => env('SOCIO_ONESIGNAL_APP_ID'),
//                'api_key' => env('SOCIO_ONESIGNAL_REST_API_KEY'),
////                'user_auth_key' => env('SOCIO_USER_AUTH_KEY'),
//                "app_url" => 'mzeappsocio://app/notification',
//                'headings' => array(
//                    'en' => $request->titulo
//                ),
//                'contents' => array(
//                    'en' => $request->descricao
//                ),
////                'big_picture' => 'https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png',
////                'ios_attachments' => [
////                    "id" => "https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png"
////                ],
//                'ios_badgeType' => 'Increase',
//                'ios_badgeCount' => 1,
//                'included_segments' => array("All"),
//                $buttons = null
//            );
//
////            $oneSignal = new OneSignalClient(env("SOCIO_ONESIGNAL_APP_ID"), env("SOCIO_ONESIGNAL_REST_API_KEY"),env("SOCIO_USER_AUTH_KEY"));
////
////
////            $oneSignal->sendNotificationCustom($params);
//
//            $content = array(
//                "en" => 'English Message'
//            );
//            $hashes_array = array();
//
//            $fields = array(
//                'app_id' => "0334809a-113a-45a1-aa69-224c8d601002",
//                'included_segments' => array(
//                    'All'
//                ),
//                'data' => array(
//                    "foo" => "bar"
//                ),
//                'contents' => $content,
//                'web_buttons' => $hashes_array
//            );
//
//            $fields = json_encode($params);
//            print("\nJSON sent:\n");
//            print($fields);
//
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                'Content-Type: application/json; charset=utf-8',
//                'Authorization: Basic ZDFjMzRkNWUtMjJmMi00YzhkLTk1YjgtZWU0NThjMThlZmM1'
//            ));
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//            curl_setopt($ch, CURLOPT_HEADER, FALSE);
//            curl_setopt($ch, CURLOPT_POST, TRUE);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//            $response = curl_exec($ch);
//            curl_close($ch);
//
//            return $response;
//
//        } catch (\Exception $e) {
//            return $e;
//        }
//
//        return $this->notificacao->saveOrUpdate($request);
//    }
//
//    public function update(NotificacaoClienteRequest $request)
//    {
//        return $this->notificacao->saveOrUpdate($request);
//    }
//
//
//}
