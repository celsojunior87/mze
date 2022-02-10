<?php

namespace App\Service;
use Berkayk\OneSignal\OneSignalClient;
use Carbon\Carbon;
use OneSignal;


class NotificationService
{

    public function sendNotificationToAll($notificacao)
    {
        try {
            OneSignal::addParams([
                "app_url" => 'mzeappcliente://app/notification',
                'headings' => [
                    'en' => $notificacao['titulo']
                ],
                'ios_badgeType' => "Increase",
                'ios_badgeCount' => 1
            ])->sendNotificationToAll(
                $notificacao['descricao']
            );
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function sendNotificationToUser($notificacao)
    {
        try {
            OneSignal::addParams([
                "app_url" => 'mzeappcliente://app/notification',
                'headings' => [
                    'en' => $notificacao->titulo
                ],
                'ios_badgeType' => "Increase",
                'ios_badgeCount' => 1
            ])->sendNotificationToUser(
                $notificacao->descricao
            );
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function sendNotificationMessageToCliente($notificacao)
    {
        try {


            $url = 'mzeappcliente://app/notification';
            if (isset($notificacao['url'])) {
                $url = $notificacao['url'];
            }

            //            OneSignal::addParams([
            //                "app_url" => $url,
            //                'headings' => [
            //                    'en' => $notificacao['titulo']
            //                ],
            //                'ios_badgeType' => "Increase",
            //                'ios_badgeCount' => 1
            //            ])->sendNotificationUsingTags(
            //                $notificacao['descricao'],
            //                 array(["field" => "tag", "key" => "cliente_id", "relation" => "=", "value" => $notificacao['user_id']]),
            //                $url = null, $data = $notificacao, $buttons = null);


            $params = [
                'app_id' => env('ONESIGNAL_APP_ID'),
                'rest_api_key' => env('ONESIGNAL_REST_API_KEY'),
                'auth_key' => env('USER_AUTH_KEY'),
                "app_url" => $url,
                'headings' => [
                    'en' => $notificacao['titulo'],
                    'pt' => $notificacao['titulo']
                ],
                'contents' => [
                    'en' => $notificacao['descricao'],
                    'pt' => $notificacao['descricao']
                ],
                //                'big_picture' => 'https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png',
                //                'ios_attachments' => [
                //                    "id" => "https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png"
                //                ],
                'ios_badgeType' => 'Increase',
                'ios_badgeCount' => 1,
                'included_segments' => array(["field" => "tag", "key" => "cliente_id", "relation" => "=", "value" => $notificacao['user_id']]),
                $data = $notificacao,
                $buttons = null
            ];

            OneSignal::sendNotificationCustom($params);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function sendNotificationMessageToSocio($notificacao)
    {
        try {

            //            OneSignal::addParams([
            //                "app_url" => 'mzeappsocio://app/chat',
            //                'headings' => [
            //                    'en' => $notificacao['titulo']
            //                ],
            //                'ios_badgeType' => "Increase",
            //                'ios_badgeCount' => 1
            //            ])->sendNotificationUsingTags(
            //                $notificacao['descricao'],
            //                array(["field" => "tag", "key" => "socio_id", "relation" => "=", "value" => $notificacao['user_id']]),
            //                $url = null, $data = ["type" => "message"], $buttons = null);


            $url = 'mzeappsocio://app/notification';
            if (isset($notificacao['url'])) {
                $url = $notificacao['url'];
            }


            $params = [
                'app_id' => env('SOCIO_ONESIGNAL_APP_ID'),
                'rest_api_key' => env('SOCIO_ONESIGNAL_REST_API_KEY'),
                'auth_key' => env('SOCIO_USER_AUTH_KEY'),
                "app_url" => $url,
                'headings' => [
                    'en' => $notificacao['titulo'],
                    'pt' => $notificacao['titulo']
                ],
                'contents' => [
                    'en' => $notificacao['descricao'],
                    'pt' => $notificacao['descricao']
                ],
                //                'big_picture' => 'https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png',
                //                'ios_attachments' => [
                //                    "id" => "https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png"
                //                ],
                'ios_badgeType' => 'Increase',
                'ios_badgeCount' => 1,
                'filters' => array(["field" => "tag", "key" => "socio_id", "relation" => "=", "value" => $notificacao['user_id']]),
                'data' => $notificacao,
            ];

            $oneSignal = new OneSignalClient("0334809a-113a-45a1-aa69-224c8d601002", "ZDFjMzRkNWUtMjJmMi00YzhkLTk1YjgtZWU0NThjMThlZmM1", "OGM4MmM3ZGItY2E2NC00MjNhLTk2OTctOGQ0NDUxZWVlYmFi");


            $oneSignal->sendNotificationCustom($params);
        } catch (\Exception $e) {
            return $e;
        }

    }
}
