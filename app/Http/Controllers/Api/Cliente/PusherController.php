<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Events\Messages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherController extends Controller
{
    public function send(Request $request)
    {
            try {

                event(new Messages('Message'));

                $app_id = env('PUSHER_APP_ID');
                $app_key = env('PUSHER_APP_KEY');
                $app_secret = env('PUSHER_APP_SECRET');
                $app_cluster = env('PUSHER_APP_CLUSTER');

                $pusher = new Pusher( $app_key, $app_secret, $app_id, array('cluster' => $app_cluster) );
                $pusher->trigger( 'message_1', 'my-event', ["mensagem"=>$request->mensagem] );
//                event(new Messages('teste'));
//                return "Event has been sent!";
            }catch (\Exception $e){
                return $e;
            }


    }
}
