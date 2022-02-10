<?PHP

use App\Http\Controllers\Api\Cliente\CieloController;
use App\Http\Controllers\Api\Cliente\EnderecoController;
use App\Http\Controllers\Api\Cliente\NotificationController;
use App\Http\Controllers\Api\Cliente\PusherController;
use App\Http\Controllers\Api\Cliente\ClienteController;
use App\Http\Controllers\Api\Cliente\NewPasswordClienteController;
use App\Http\Controllers\Api\Cliente\NewPasswordController;
use App\Http\Controllers\Api\Painel\NewPasswordPainelController;
use App\Http\Controllers\Api\RegiaoController;
use App\Http\Controllers\Api\Cliente\TermoController;
use App\Http\Controllers\Api\Painel\PainelController;
use App\Http\Controllers\Api\Socio\NewPasswordSocioController;
use App\Http\Controllers\Api\Socio\SocioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('forgot-password', [NewPasswordController::class, 'clienteForgotPassword']);

Route::middleware('auth:api')->get('/cliente', function (Request $request) {
    return $request->user();
});




Route::prefix('pagamento')->group(function () {

    /*
    Rotas dos Pagamentos
    */
    //Pagamentos cartao de credito
    Route::post('peyerCredit', [CieloController::class, 'peyerCredit']);

    //Pagamentos cartao de debito
    Route::post('peyerDebit', [CieloController::class, 'peyerDebit']);
});


Route::prefix('cliente')->middleware('auth:cliente')->group(base_path('routes/apiCliente.php'));
Route::prefix('painel')->middleware('auth:administrador')->group(base_path('routes/apiPainel.php'));
Route::prefix('socio')->middleware('auth:socio')->group(base_path('routes/apiSocio.php'));
Route::prefix('self-checkout')->group(base_path('routes/apiSelfCheckout.php'));



Route::namespace('Api\Socio')
    ->prefix('socio')
    ->group(function () {
        // Auth
        Route::post('signup', [SocioController::class, 'registration']);
        Route::post('login', [SocioController::class, 'login']);
        Route::post('forgot-password', [NewPasswordSocioController::class, 'socioForgotPassword']);
    });
/* Rotas do cadastro dos sócios */

/*
 *   Rota de Login
*/
Route::namespace('Api\Cliente')
    ->prefix('cliente')
    ->group(function () {
        // Auth
        Route::post('login', [ClienteController::class, 'login']);
        Route::post('signup', [ClienteController::class, 'registration']);
        Route::post('forgot-password', [NewPasswordClienteController::class, 'clienteForgotPassword']);
    });


/*
    Rotas dos socios
    */
Route::namespace('Api\Painel')
    ->prefix('painel')
    ->group(function () {
        // Auth
        Route::post('login', [PainelController::class, 'login']);
        Route::post('forgot-password', [NewPasswordPainelController::class, 'painelForgotPassword']);
    });


/*
Rotas dos socios
*/
Route::namespace('Api')
    ->prefix('socio')
    ->group(function () {


        Route::prefix('notification')->group(function () {

            /*
            Rotas dos Notificações
            */
            Route::post('send-socio', [NotificationController::class, 'sendNotificationToAll']);
        });
    });


Route::namespace('Api')
    ->prefix('cliente')
    ->middleware('auth:api')
    ->group(function () {



        Route::prefix('usuario')->group(function () {

            Route::get('/', function (Request $request) {

                return $request->user();
            });


            /*
            Rotas de cadastro de Usuários
            */


            Route::get('find/{id}', [ClienteController::class, 'find']);

            Route::delete('destroy/{id}', [ClienteController::class, 'destroy']);
        });

        Route::prefix('endereco')->group(function () {

            /*
            Rotas dos Endereços
            */


            Route::get('find/{id}', [EnderecoController::class, 'find']);

            Route::delete('destroy/{id}', [EnderecoController::class, 'destroy']);
        });


        Route::prefix('termo')->group(function () {

            /*
            Rotas dos Endereços
            */
            Route::get('list', [TermoController::class, 'getAll']);
        });






        // Route::prefix('venda')->group(function () {

        //     /*
        //     Rotas dos Endereços
        //     */

        //     Route::post('store', [VendaController::class, 'store']);
        //     Route::get('find/{id}', [VendaController::class, 'find']);

        //     Route::delete('destroy/{id}', [VendaController::class, 'destroy']);
        // });



        Route::prefix('regiao')->group(function () {

            /*
        Rotas da Região
        */
            Route::get('list', [RegiaoController::class, 'getAll']);
            Route::post('store', [RegiaoController::class, 'store']);
            Route::get('find/{id}', [RegiaoController::class, 'find']);
            Route::put('update/{id}', [RegiaoController::class, 'update']);
            Route::delete('destroy/{id}', [RegiaoController::class, 'destroy']);
        });



        Route::prefix('tipo-pagamento')->group(function () {

            /*
        Rotas de Tipo Pagamento
        */
            Route::get('list', [TipoPagamentoController::class, 'getAll']);
            Route::post('store', [TipoPagamentoController::class, 'store']);
            Route::get('find/{id}', [TipoPagamentoController::class, 'find']);
            Route::put('update/{id}', [TipoPagamentoController::class, 'update']);
            Route::delete('destroy/{id}', [TipoPagamentoController::class, 'destroy']);
        });




        // Route::prefix('preco')->group(function () {

        //     /*
        // Rotas de Tipo Pagamento
        // */
        //     Route::get('list', [PrecoController::class, 'getAll']);
        //     Route::post('store', [PrecoController::class, 'store']);
        //     Route::get('find/{id}', [PrecoController::class, 'find']);
        //     Route::put('update/{id}', [PrecoController::class, 'update']);
        //     Route::delete('destroy/{id}', [PrecoController::class, 'destroy']);
        // });
    });



Route::prefix('cliente')->middleware('auth:cliente')->group(base_path('routes/apiCliente.php'));
Route::prefix('painel')->middleware('auth:administrador')->group(base_path('routes/apiPainel.php'));
Route::prefix('socio')->middleware('auth:socio')->group(base_path('routes/apiSocio.php'));
