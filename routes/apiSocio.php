<?php

use App\Http\Controllers\Api\All\FilialController;
use App\Http\Controllers\Api\All\InstituicaoFinanceiraController;
use App\Http\Controllers\Api\Socio\FilialSocioController;
use App\Http\Controllers\Api\Socio\NotificacaoSocioController;
use App\Http\Controllers\Api\Socio\SocioController;
use App\Http\Controllers\Api\Socio\VendaStatusSocioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\All\ChatClienteSocioController;
use App\Http\Controllers\Api\Socio\DashboardSocioController;
use App\Http\Controllers\Api\Socio\EstoqueSocioController;
use App\Http\Controllers\Api\Socio\FiliaisSocioController;
use App\Http\Controllers\Api\Socio\HomeSocioController;
use App\Http\Controllers\Api\Socio\StatusSocioController;
use App\Http\Controllers\Api\Socio\VendaSocioController;
use App\Http\Controllers\Api\Socio\VendaTrocaSocioController;
use Illuminate\Http\Request;

/*
    Rotas das filiais
*/

Route::get('usuario', [SocioController::class, 'client']);

Route::get('filial/list', [FilialController::class, 'getAll']);
Route::post('filial/store', [FilialController::class, 'store']);
Route::get('filial/find/{id}', [FilialController::class, 'find']);
Route::put('filial/update/{id}', [FilialController::class, 'update']);
Route::delete('filial/destroy/{id}', [FilialController::class, 'destroy']);
Route::post('search', [FilialController::class, 'search']);


/* Rotas das Instituições Financeiras */
Route::get('instituicao-financeira/list', [InstituicaoFinanceiraController::class, 'getAll']);
Route::post('instituicao-financeira/store', [InstituicaoFinanceiraController::class, 'store']);
Route::get('instituicao-financeira/find/{id}', [InstituicaoFinanceiraController::class, 'find']);
Route::put('instituicao-financeira/update/{id}', [InstituicaoFinanceiraController::class, 'update']);
Route::delete('instituicao-financeira/destroy/{id}', [InstituicaoFinanceiraController::class, 'destroy']);


/* Rotas dos Socios */
Route::get('list', [SocioController::class, 'getAll']);
Route::post('store', [SocioController::class, 'store']);
Route::get('find/{id}', [SocioController::class, 'find']);
Route::put('update/{id}', [SocioController::class, 'update']);
Route::delete('destroy/{id}', [SocioController::class, 'destroy']);


/* Rotas de Estoque */

Route::post('estoque/list', [EstoqueSocioController::class, 'list']);
Route::post('estoque/store', [EstoqueSocioController::class, 'store']);
Route::post('estoque/search', [EstoqueSocioController::class, 'search']);
Route::post('estoque/auditoria', [EstoqueSocioController::class, 'auditoria']);
// Route::get('find/{id}', [SocioController::class, 'find']);
// Route::put('update/{id}', [SocioController::class, 'update']);
// Route::delete('destroy/{id}', [SocioController::class, 'destroy']);


Route::prefix('chat')->group(function () {

    /*
    Rotas de Chat
    */
    Route::post('send', [ChatClienteSocioController::class, 'store']);
    Route::post('list', [ChatClienteSocioController::class, 'getAll']);
});



Route::post('venda/search', [VendaSocioController::class, 'search']);
Route::post('venda/status-history', [VendaSocioController::class, 'statusHistory']);
Route::post('venda/cancela-venda', [VendaSocioController::class, 'cancelaVenda']);
Route::post('venda/troca-produtos', [VendaSocioController::class, 'trocaProdutos']);

/* Rotas de Filiais */
Route::post('filial/search', [FiliaisSocioController::class, 'search']);
Route::post('filial/opening', [FiliaisSocioController::class, 'openAndClose']);

Route::prefix('venda-troca')->group(function ($route) {
    $route->get('list', [VendaTrocaSocioController::class, 'getAll']);
    $route->post('store', [VendaTrocaSocioController::class, 'store']);
    $route->get('find/{id}', [VendaTrocaSocioController::class, 'find']);
    $route->put('update/{id}', [VendaTrocaSocioController::class, 'update']);
    $route->delete('destroy/{id}', [VendaTrocaSocioController::class, 'destroy']);
});

Route::prefix('notificacao')->group(function () {

    /*
    Rotas dos Notificações
    */
    Route::post('list', [NotificacaoSocioController::class, 'getAll']);
    Route::post('store', [NotificacaoSocioController::class, 'store']);
    Route::put('update/{id}', [NotificacaoSocioController::class, 'update']);

    //    Route::post('send-all', [NotificationController::class, 'sendNotificationToAll']);
});


Route::prefix('venda-status')->group(function ($route) {
    $route->post('update', [VendaStatusSocioController::class, 'updateStatus']);
    // $route->post('store', [VendaStatusSocioController::class, 'store']);
    // $route->get('find/{id}', [VendaStatusSocioController::class, 'find']);
    // $route->put('update/{id}', [VendaStatusSocioController::class, 'update']);
    // $route->delete('destroy/{id}', [VendaStatusSocioController::class, 'destroy']);
});


Route::prefix('home')->group(function ($route) {
    $route->post('faturamento', [HomeSocioController::class, 'search']);
});

Route::prefix('dashboard')->group(function ($route) {
    $route->post('search', [DashboardSocioController::class, 'search']);
});

Route::prefix('status')->group(function ($route) {

    $route->post('search', [StatusSocioController::class, 'search']);
});

Route::post('update', [SocioController::class, 'updateDadosSocio']);
