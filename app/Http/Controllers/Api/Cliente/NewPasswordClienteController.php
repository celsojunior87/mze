<?php

namespace App\Http\Controllers\Api\Cliente;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

class NewPasswordClienteController extends Controller
{

    use Response;

    public function clienteForgotPassword(Request $request)
    {

        $email = Cliente::where('email', $request->email)->exists();


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

    public function clienteResetPassword()
    {
        return view('auth.cliente_reset_password');
    }

    public function clienteNewPassword(Request $request)
    {
        $user = Cliente::where('email', $request->email)->firstOrFail();
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
