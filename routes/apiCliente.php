<?php

use App\Http\Controllers\Api\All\ChatClienteSocioController;
use App\Http\Controllers\Api\All\FilialController;
use App\Http\Controllers\Api\Cliente\CieloController;
use App\Http\Controllers\Api\Cliente\ClienteController;
use App\Http\Controllers\Api\Cliente\DepartamentoClienteController;
use App\Http\Controllers\Api\Cliente\EnderecoClienteController;
use App\Http\Controllers\Api\Cliente\NotificacaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Cliente\cobrancaClienteClienteController;
use App\Http\Controllers\Api\Cliente\CobrancaClienteController;
use App\Http\Controllers\Api\Cliente\MixClienteController;
use App\Http\Controllers\Api\Cliente\MixController;
use App\Http\Controllers\Api\Cliente\MixItemClienteController;
use App\Http\Controllers\Api\Cliente\PrecoClienteController;
use App\Http\Controllers\Api\Cliente\PrecoController;
use App\Http\Controllers\Api\Cliente\ProdutoClienteController;
use App\Http\Controllers\Api\Cliente\PromocaoClienteController;
use App\Http\Controllers\Api\Cliente\StatusClienteController;
use App\Http\Controllers\Api\Cliente\VendaClienteController;
use App\Http\Controllers\Api\Painel\TipoCobrancaPainelController;
use Illuminate\Http\Request;



/*
 Rotas dos Usuarios
*/

Route::prefix('usuario')->group(function () {

    Route::get('/', function (Request $request) {

        return $request->user();
    });

    Route::put('update', [ClienteController::class, 'updateCustom']);


    /*
    Rotas de cadastro de Usuários
    */
});



Route::get('list', [ClienteController::class, 'getAll']);

/*
 Rotas dos Endereços
*/

Route::get('endereco/list', [EnderecoClienteController::class, 'getAll']);
Route::post('endereco/store', [EnderecoClienteController::class, 'store']);
Route::put('endereco/update/{id}', [EnderecoClienteController::class, 'update']);
Route::post('endereco/search', [EnderecoClienteController::class, 'search']);

/*
 Rotas de Filiais
*/

Route::prefix('filial')->group(function () {

    /*
            Rotas de Filiais
            */

    Route::get('list', [FilialController::class, 'getAll']);
    Route::get('find/{id}', [FilialController::class, 'find']);
    Route::post('store', [FilialController::class, 'store']);
    Route::put('update/{id}', [FilialController::class, 'update']);
    Route::delete('destroy/{id}', [FilialController::class, 'destroy']);
});


/* Rotas dos cobranca de clientes */
Route::get('cobranca-cliente/list', [CobrancaClienteController::class, 'getAll']);
Route::post('cobranca-cliente/store', [CobrancaClienteController::class, 'store']);
Route::get('cobranca-cliente/find/{id}', [CobrancaClienteController::class, 'find']);
Route::put('cobranca-cliente/update/{id}', [CobrancaClienteController::class, 'update']);
Route::delete('cobranca-cliente/destroy/{id}', [CobrancaClienteController::class, 'destroy']);
Route::post('cobranca-cliente/search/', [CobrancaClienteController::class, 'search']);


/* Rotas dos Departamentos */
Route::post('departamento/search', [DepartamentoClienteController::class, 'search']);
Route::get('departamento/list', [DepartamentoClienteController::class, 'getAll']);
Route::get('departamento/find/{id}', [DepartamentoClienteController::class, 'find']);

/* Rotas dos Preços */
Route::post('preco/search', [PrecoController::class, 'search']);

/* Rotas dos Produtos */
Route::get('produto/list', [ProdutoClienteController::class, 'getAll']);
Route::post('produto/search', [ProdutoClienteController::class, 'search']);
Route::post('produto/get-by-department', [ProdutoClienteController::class, 'getByDepartment']);

/* Rotas de Status */
Route::post('status/search', [StatusClienteController::class, 'search']);



/* Rota de Preços */
Route::get('preco/list', [PrecoClienteController::class, 'getAll']);
Route::get('preco/find/{id}', [PrecoClienteController::class, 'find']);
Route::post('preco/search', [PrecoClienteController::class, 'search']);

/* Rota de Promoções */
Route::get('promocao/list', [PromocaoClienteController::class, 'getAll']);
Route::post('promocao/search', [PromocaoClienteController::class, 'search']);

/* Rota de de Vendas */
Route::get('venda/list', [VendaController::class, 'getAll']);
Route::post('venda/cancela-venda', [VendaClienteController::class, 'update']);
Route::put('venda/avaliacao/{id}', [VendaClienteController::class, 'updateAvaliacao']);
Route::post('venda/insert', [VendaClienteController::class, 'insert']);
Route::post('venda/search', [VendaClienteController::class, 'search']);
Route::post('venda/partners', [VendaClienteController::class, 'listPartners']);


/* Rota de tipo de pagamentos */
// Route::get('list', [TipoPagamentoController::class, 'getAll']);


/* Rota de Mix */
Route::get('mix/list', [MixClienteController::class, 'getAll']);

/* Rota de Mix Item */
Route::get('mix-item/list', [MixItemClienteController::class, 'getAll']);


Route::prefix('chat')->group(function () {

    /*
    Rotas de Chat
    */
    Route::post('send', [ChatClienteSocioController::class, 'store']);
    Route::post('list', [ChatClienteSocioController::class, 'getAll']);
});


Route::prefix('cielo')->group(function () {

    /*
    Rotas dos Pagamentos
    */
    //Pagamentos cartao de credito
    Route::post('peyerCredit', [CieloController::class, 'peyerCredit']);

    //Pagamentos cartao de credito porm token
    Route::post('peyerCreditToken', [CieloController::class, 'peyerCreditToken']);

    //Pagamentos cartao de debito
    Route::post('peyerDebit', [CieloController::class, 'peyerDebit']);

    //Token cartao de debito
    Route::post('tokenize', [CieloController::class, 'tokenize']);
});


Route::prefix('notificacao')->group(function () {

    /*
    Rotas dos Notificações
    */
    Route::post('list', [NotificacaoController::class, 'getAll']);
    Route::post('store', [NotificacaoController::class, 'store']);
    Route::put('update/{id}', [NotificacaoController::class, 'update']);

    //    Route::post('send-all', [NotificationController::class, 'sendNotificationToAll']);
});

Route::prefix('tipo-cobranca')->group(function ($route) {
    $route->get('list', [TipoCobrancaPainelController::class, 'getAll']);
});
