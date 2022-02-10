<?php

use App\Http\Controllers\Api\Painel\PainelController;
use App\Http\Controllers\Api\All\FilialController;
use App\Http\Controllers\Api\All\ContaBancariaController;
use App\Http\Controllers\Api\All\InstituicaoFinanceiraController;
use App\Http\Controllers\Api\Painel\ClientePainelController;
use App\Http\Controllers\Api\Painel\MixItemPainelController;
use App\Http\Controllers\Api\Painel\MixPainelController;
use App\Http\Controllers\Api\Painel\PromocaoPainelController;
use App\Http\Controllers\Api\Painel\DepartamentoPainelController;
use App\Http\Controllers\Api\Painel\EstoquePainelController;
use App\Http\Controllers\Api\Painel\NotificacaoPainelController;
use App\Http\Controllers\Api\Painel\PainelCupomDescontoController;
use App\Http\Controllers\Api\RegiaoController;
use App\Http\Controllers\Api\Painel\PrecoPainelController;
use App\Http\Controllers\Api\Painel\ProdutoPainelController;
use App\Http\Controllers\Api\Painel\SecaoController;
use App\Http\Controllers\Api\Painel\StatusPainelController;
use App\Http\Controllers\Api\Painel\TipoPagamentoPainelController;
use App\Http\Controllers\Api\Painel\SocioPainelController;
use App\Http\Controllers\Api\Painel\TipoCobrancaPainelController;
use App\Http\Controllers\Api\Painel\VendaPainelController;
use App\Http\Controllers\Api\Socio\DashboardSocioController;
use Illuminate\Support\Facades\Route;



/*Rotas de Promoções*/

Route::get('promocao/list', [PromocaoPainelController::class, 'getAll']);
Route::post('promocao/store', [PromocaoPainelController::class, 'store']);
Route::get('promocao/find/{id}', [PromocaoPainelController::class, 'find']);
Route::put('promocao/update/{id}', [PromocaoPainelController::class, 'update']);
Route::delete('promocao/destroy/{id}', [PromocaoPainelController::class, 'destroy']);
Route::post('promocao/search', [PromocaoPainelController::class, 'search']);
Route::get('promocao/to-datatable', [PromocaoPainelController::class, 'toDataTable']);



/*Rotas de Cupom de desconto*/
Route::get('cupom-desconto/list', [PainelCupomDescontoController::class, 'getAll']);
Route::post('cupom-desconto/store', [PainelCupomDescontoController::class, 'store']);
Route::get('cupom-desconto/find/{id}', [PainelCupomDescontoController::class, 'find']);
Route::put('cupom-desconto/update/{id}', [PainelCupomDescontoController::class, 'update']);
Route::delete('cupom-desconto/destroy/{id}', [PainelCupomDescontoController::class, 'destroy']);


/* Rotas de Produtos */
Route::group(['prefix' => 'produto'], function ($route) {
    $route->get('list', [ProdutoPainelController::class, 'getAll']);
    $route->post('search', [ProdutoPainelController::class, 'search']);
    $route->post('store', [ProdutoPainelController::class, 'store']);
    $route->get('find/{id}', [ProdutoPainelController::class, 'find']);
    $route->put('update/{id}', [ProdutoPainelController::class, 'update']);
    $route->delete('destroy/{id}', [ProdutoPainelController::class, 'destroy']);
    $route->get('to-datatable', [ProdutoPainelController::class, 'toDataTable']);
});


/* Rotas de filiais */
Route::get('filial/list', [FilialController::class, 'getAll']);
Route::post('filial/store', [FilialController::class, 'store']);
Route::get('filial/find/{id}', [FilialController::class, 'find']);
Route::put('filial/update/{id}', [FilialController::class, 'update']);
Route::delete('filial/destroy/{id}', [FilialController::class, 'destroy']);
Route::post('search', [FilialController::class, 'search']);
Route::get('to-datatable', [FilialController::class, 'toDataTable']);


/* Rotas dos Departamentos */
Route::post('departamento/search', [DepartamentoPainelController::class, 'search']);
Route::get('departamento/list', [DepartamentoPainelController::class, 'getAll']);
Route::get('departamento/find/{id}', [DepartamentoPainelController::class, 'find']);
Route::post('departamento/store', [DepartamentoPainelController::class, 'store']);
Route::put('departamento/update/{id}', [DepartamentoPainelController::class, 'update']);
Route::delete('departamento/destroy/{id}', [DepartamentoPainelController::class, 'destroy']);
Route::get('departamento/to-datatable', [DepartamentoPainelController::class, 'toDataTable']);


/* Rotas de Tipo de Pagamentos */
Route::post('tipo-pagamento/search', [TipoPagamentoPainelController::class, 'search']);
Route::get('tipo-pagamento/list', [TipoPagamentoPainelController::class, 'getAll']);
Route::get('tipo-pagamento/find/{id}', [TipoPagamentoPainelController::class, 'find']);
Route::post('tipo-pagamento/store', [TipoPagamentoPainelController::class, 'store']);
Route::put('tipo-pagamento/update/{id}', [TipoPagamentoPainelController::class, 'update']);
Route::delete('tipo-pagamento/destroy/{id}', [TipoPagamentoPainelController::class, 'destroy']);



/* Rotas das Instituições Financeiras */
Route::get('instituicao-financeira/list', [InstituicaoFinanceiraController::class, 'getAll']);
Route::post('instituicao-financeira/store', [InstituicaoFinanceiraController::class, 'store']);
Route::get('instituicao-financeira/find/{id}', [InstituicaoFinanceiraController::class, 'find']);
Route::put('instituicao-financeira/update/{id}', [InstituicaoFinanceiraController::class, 'update']);
Route::delete('instituicao-financeira/destroy/{id}', [InstituicaoFinanceiraController::class, 'destroy']);


/* Rota de Preços */
Route::group(['prefix' => 'preco'], function ($route) {
    $route->get('list', [PrecoPainelController::class, 'getAll']);
    $route->get('find/{id}', [PrecoPainelController::class, 'find']);
    $route->post('search', [PrecoPainelController::class, 'search']);
    $route->post('store', [PrecoPainelController::class, 'store']);
    $route->put('update/{id}', [PrecoPainelController::class, 'update']);
    $route->delete('destroy/{id}', [PrecoPainelController::class, 'destroy']);
});

/* Rota de Mix */
Route::group(['prefix' => 'mix'], function ($route) {
    $route->get('list', [MixPainelController::class, 'getAll']);
    $route->post('search', [MixPainelController::class, 'search']);
    $route->post('store', [MixPainelController::class, 'store']);
    $route->get('find/{id}', [MixPainelController::class, 'find']);
    $route->put('update/{id}', [MixPainelController::class, 'update']);
    $route->delete('destroy/{id}', [MixPainelController::class, 'destroy']);
    $route->get('to-datatable', [MixPainelController::class, 'toDataTable']);
    $route->get('{id}/produtos/to-datatable', [MixPainelController::class, 'productsToDataTable']);
    $route->post('{id}/atualizar-produtos-vinculados', [MixPainelController::class, 'updateLinkedProducts']);
    $route->post('{id}/desvincular-produto', [MixPainelController::class, 'unlinkProduct']);
});

/* Rota de Mix Itens */
Route::group(['prefix' => 'mix-item'], function ($route) {
    $route->get('list', [MixItemPainelController::class, 'getAll']);
    $route->post('store', [MixItemPainelController::class, 'store']);
    $route->get('find/{id}', [MixItemPainelController::class, 'find']);
    $route->put('update/{id}', [MixItemPainelController::class, 'update']);
    $route->delete('destroy/{id}', [MixItemPainelController::class, 'destroy']);
    $route->get('to-datatable', [MixItemPainelController::class, 'toDatatable']);
});

Route::prefix('regiao')->group(function ($route) {
    $route->get('list', [RegiaoController::class, 'getAll']);
    $route->post('store', [RegiaoController::class, 'store']);
    $route->get('find/{id}', [RegiaoController::class, 'find']);
    $route->put('update/{id}', [RegiaoController::class, 'update']);
    $route->delete('destroy/{id}', [RegiaoController::class, 'destroy']);
    $route->get('to-datatable', [RegiaoController::class, 'toDataTable']);
    $route->get('com-mix', [RegiaoController::class, 'withMix']);
    $route->get('list/states', [RegiaoController::class, 'getStates']);
});

Route::prefix('socio')->group(function ($route) {
    $route->get('list', [SocioPainelController::class, 'getAll']);
    $route->post('store', [SocioPainelController::class, 'store']);
    $route->get('find/{id}', [SocioPainelController::class, 'find']);
    $route->put('update/{id}', [SocioPainelController::class, 'update']);
    $route->delete('destroy/{id}', [SocioPainelController::class, 'destroy']);
    $route->get('to-datatable', [SocioPainelController::class, 'toDataTable']);
});

Route::prefix('secao')->group(function ($route) {
    $route->post('search', [SecaoController::class, 'search']);
    $route->get('list', [SecaoController::class, 'getAll']);
    $route->post('store', [SecaoController::class, 'store']);
    $route->get('find/{id}', [SecaoController::class, 'find']);
    $route->put('update/{id}', [SecaoController::class, 'update']);
    $route->delete('destroy/{id}', [SecaoController::class, 'destroy']);
    $route->get('to-datatable', [SecaoController::class, 'toDataTable']);
});

Route::prefix('conta-bancaria')->group(function ($route) {
    $route->get('list', [ContaBancariaController::class, 'getAll']);
    $route->post('store', [ContaBancariaController::class, 'store']);
    $route->get('find/{id}', [ContaBancariaController::class, 'find']);
    $route->put('update/{id}', [ContaBancariaController::class, 'update']);
    $route->delete('destroy/{id}', [ContaBancariaController::class, 'destroy']);
});


Route::prefix('status')->group(function ($route) {
    $route->get('list', [StatusPainelController::class, 'getAll']);
    $route->post('store', [StatusPainelController::class, 'store']);
    $route->get('find/{id}', [StatusPainelController::class, 'find']);
    $route->put('update/{id}', [StatusPainelController::class, 'update']);
    $route->delete('destroy/{id}', [StatusPainelController::class, 'destroy']);
    $route->get('to-datatable', [StatusPainelController::class, 'toDataTable']);
    $route->post('search', [StatusPainelController::class, 'search']);
});


Route::prefix('tipo-cobranca')->group(function ($route) {
    $route->get('list', [TipoCobrancaPainelController::class, 'getAll']);
    $route->post('store', [TipoCobrancaPainelController::class, 'store']);
    $route->get('find/{id}', [TipoCobrancaPainelController::class, 'find']);
    $route->put('update/{id}', [TipoCobrancaPainelController::class, 'update']);
    $route->delete('destroy/{id}', [TipoCobrancaPainelController::class, 'destroy']);
});


Route::prefix('notificacao')->group(function () {
    Route::post('list', [NotificacaoPainelController::class, 'getAll']);
    Route::post('store', [NotificacaoPainelController::class, 'store']);
    Route::get('to-datatable', [NotificacaoPainelController::class, 'toDataTable']);
    Route::put('update/{id}', [NotificacaoPainelController::class, 'update']);
    Route::post('search', [NotificacaoPainelController::class, 'search']);
    Route::post('destroy', [NotificacaoPainelController::class, 'destroy']);
});

Route::prefix('usuario')->group(function () {
    Route::post('store', [PainelController::class, 'store']);
    Route::get('to-datatable', [PainelController::class, 'toDataTable']);
    Route::put('update/{id}', [PainelController::class, 'update']);
    Route::post('search', [PainelController::class, 'search']);
    Route::post('destroy', [PainelController::class, 'destroy']);
});

Route::prefix('cliente')->group(function () {
    Route::get('list', [ClientePainelController::class, 'getAll']);
});

Route::prefix('dashboard')->group(function ($route) {
    $route->post('search', [DashboardSocioController::class, 'search']);
});



Route::prefix('venda')->group(function ($route) {
    $route->get('pedidos', [VendaPainelController::class, 'pedidos']);
    $route->post('faturamento', [VendaPainelController::class, 'faturamento']);
});

Route::prefix('estoque')->group(function ($route) {
    $route->post('auditoria', [EstoquePainelController::class, 'auditoria']);
});
