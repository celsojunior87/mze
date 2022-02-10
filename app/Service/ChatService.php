<?php

namespace App\Service;
use App\Events\Messages;
use Pusher\Pusher;


class ChatService
{

    public function sendMessage($mensagem, $venda_id)
    {

        try {

            event(new Messages('Message'));

            $app_id = env('PUSHER_APP_ID');
            $app_key = env('PUSHER_APP_KEY');
            $app_secret = env('PUSHER_APP_SECRET');
            $app_cluster = env('PUSHER_APP_CLUSTER');

            $pusher = new Pusher( $app_key, $app_secret, $app_id, array('cluster' => $app_cluster) );
            $pusher->trigger( 'message_'.$venda_id, 'chat-cliente-socio', $mensagem );
//                event(new Messages('teste'));
//                return "Event has been sent!";
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
