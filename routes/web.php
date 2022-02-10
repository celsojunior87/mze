<?php

use App\Http\Controllers\Api\Cliente\CieloController;
use App\Http\Controllers\Api\Cliente\NewPasswordController;
use App\Http\Controllers\Api\Painel\NewPasswordPainelController;
use App\Http\Controllers\Api\Socio\NewPasswordSocioController;
use App\Http\Controllers\Api\Socio\NewSocioPasswordController;
use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\Socio;
use App\Notifications\AdminEmailNotification;
use App\Notifications\ClienteEmailNotification;
use App\Notifications\SocioEmailNotification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pagamento', function () {
    return view('welcome');
});

Route::post('peyer', [CieloController::class, 'peyer'])->name("peyer");

Route::get('/termos-de-uso', function () {
    return view('termos-de-uso');
});



Route::get('/cliente/ativar/{hash}', function ($hash) {
    $email = Crypt::decrypt($hash);
    $user = Cliente::whereEmail($email)->firstOrFail();
    $expires = request()->get('expires');

    if ($user->hasVerifiedEmail()) {
        $title = "Sua conta já foi ativada.";
        $message = "Esse link já foi utilizado para ativar sua conta.";
        return view('auth.generic', compact('message', 'title'));
    }

    if (time() > $expires) {
        $user->notify(new ClienteEmailNotification($user));

        $title = "Este link já expirou!";
        $message = "Acesse novamente sua caixa de entrada e clique no novo link enviado para ativar sua conta.";
        return view('auth.generic', compact('message', 'title'));
    }

    $user->markEmailAsVerified();

    $title = "E-mail verificado com sucesso!";
    $message = "Agora você já pode fazer login no aplicativo com os dados informados no cadastro.";
    return view('auth.generic', compact('message', 'title'));
})->name('cliente.ativar');


Route::get('/socio/ativar/{hash}', function ($hash) {
    $email = Crypt::decrypt($hash);
    $user = Socio::whereEmail($email)->firstOrFail();
    $expires = request()->get('expires');

    if ($user->hasVerifiedEmail()) {
        $title = "Sua conta já foi ativada.";
        $message = "Esse link já foi utilizado para ativar sua conta.";
        return view('auth.generic', compact('message', 'title'));
    }

    if (time() > $expires) {
        $user->notify(new SocioEmailNotification($user));

        $title = "Este link já expirou!";
        $message = "Acesse novamente sua caixa de entrada e clique no novo link enviado para ativar sua conta.";
        return view('auth.generic', compact('message', 'title'));
    }

    $user->markEmailAsVerified();

    $title = "E-mail verificado com sucesso!";
    $message = "Agora você já pode fazer login no aplicativo com os dados informados no cadastro.";
    return view('auth.generic', compact('message', 'title'));
})->name('socio.ativar');


Route::get('/admin/ativar/{hash}', function ($hash) {
    $email = Crypt::decrypt($hash);
    $user = Administrador::whereEmail($email)->firstOrFail();
    $expires = request()->get('expires');

    if ($user->hasVerifiedEmail()) {
        $title = "Sua conta já foi ativada.";
        $message = "Esse link já foi utilizado para ativar sua conta.";
        return view('auth.generic', compact('message', 'title'));
    }

    if (time() > $expires) {
        $user->notify(new AdminEmailNotification($user));

        $title = "Este link já expirou!";
        $message = "Acesse novamente sua caixa de entrada e clique no novo link enviado para ativar sua conta.";
        return view('auth.generic', compact('message', 'title'));
    }

    $user->markEmailAsVerified();

    $title = "E-mail verificado com sucesso!";
    $message = "Agora você já pode fazer login no painel com seus dados de acesso.";
    return view('auth.generic', compact('message', 'title'));
})->name('admin.ativar');

//Route::view('forgot_password', view('auth.reset_password'))->name('password_reset');

Route::get('cliente/reset-password', [NewPasswordController::class, 'clienteResetPassword'])->name('cliente.reset-password');
Route::post('cliente/reset-password', [NewPasswordController::class, 'clienteNewPassword'])->name('cliente.new-password');

Route::get('socio/reset-password', [NewPasswordSocioController::class, 'socioResetPassword'])->name('socio.reset-password');
Route::post('socio/reset-password', [NewPasswordSocioController::class, 'socioNewPassword'])->name('socio.new-password');

Route::get('painel/reset-password', [NewPasswordPainelController::class, 'socioResetPassword'])->name('painel.reset-password');
Route::post('painel/reset-password', [NewPasswordPainelController::class, 'socioNewPassword'])->name('painel.new-password');
