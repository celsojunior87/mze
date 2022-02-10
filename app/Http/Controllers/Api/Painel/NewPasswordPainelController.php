<?php

namespace App\Http\Controllers\Api\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Cliente;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


class NewPasswordPainelController extends Controller
{

    use Response;

    public function painelForgotPassword(Request $request)
    {

        $email = Administrador::where('email', $request->email)->exists();

        if (!$email) {
            return $this->error("Não existe o email na base de dados", 400);
        }

        try {

            $expires = Carbon::now()->addHour()->timestamp;
            $data = [
                'expires' => $expires,
                'email' => $request->email
            ];

            $token = Crypt::encrypt(json_encode($data));

            $url = route('cliente.reset-password') . "?token=" . $token;

            $data = [
                'url' => $url
            ];

            Mail::send('auth.forgot-password', $data, function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Redefinir a senha');
            });

            return response()->json(['message' => "Enviamos por e-mail o link de redefinição de senha!"]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function painelResetPassword()
    {
        return view('auth.socio_reset_password');
    }

    public function painelNewPassword(Request $request)
    {
        $user = Administrador::where('email', $request->email)->firstOrFail();
        $data = json_decode(Crypt::decrypt($request->token), true);

        $emailCheck = $data['email'];
        $expires = $data['expires'];
        $email = $request->email;

        if (time() > $expires) {
            $mensagem = "Esse token está expirado";
            // Criar view que espera uma mensagem para exibir nesse retorno
            return view('auth.generic', array('message' => $mensagem, 'title' => 'Oppss!'));
        }

        if ($emailCheck == $email) {
            if ($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
                $user->update();
            }
        }

        $mensagem = "Senha alterada com sucesso!";
        // Criar view que espera uma mensagem para exibir nesse retorno
        return view('auth.generic', array('message' => $mensagem, 'title' => 'Success'));
    }
}
