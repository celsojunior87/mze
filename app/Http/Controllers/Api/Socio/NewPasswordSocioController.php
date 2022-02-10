<?php

namespace App\Http\Controllers\Api\Socio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Socio;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class NewPasswordSocioController extends Controller
{

    use Response;

    public function socioForgotPassword(Request $request)
    {

        $email = Socio::where('email', $request->email)->exists();

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

            $url = route('socio.reset-password') . "?token=" . $token;

            $data = [
                'url' => $url
            ];

            Mail::send('auth.forgot-password', $data, function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Redefinir a senha', 'Mercadinho do Zé');
            });

            return response()->json(['message' => "Enviamos por e-mail o link de redefinição de senha!"]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function socioResetPassword()
    {
        return view('auth.socio_reset_password');
    }

    public function socioNewPassword(Request $request)
    {

        $user = Socio::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => "O e-mail informado não é o mesmo enviado para sua solicitação."]);
        }

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
        return view('auth.generic', array('message' => $mensagem, 'title' => 'Success!'));
    }
}
