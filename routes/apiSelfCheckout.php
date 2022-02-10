<?php

use App\Http\Controllers\Api\SelfCheckout\AutoAtendimentoControler;
use App\Http\Controllers\Api\SelfCheckout\DepartamentoAutoAtendimentoController;
use App\Http\Controllers\Api\SelfCheckout\PrecoAutoAtendimentoController;
use App\Http\Controllers\Api\SelfCheckout\ProdutoAutoAtendimentoController;
use App\Http\Controllers\Api\SelfCheckout\VendaAutoAtendimentoController;
use Illuminate\Support\Facades\Route;




Route::post('activate', [AutoAtendimentoControler::class, 'activate']);
Route::post('search', [AutoAtendimentoControler::class, 'search']);



/* Rotas dos Departamentos */
Route::post('departamento/search', [DepartamentoAutoAtendimentoController::class, 'search']);
Route::get('departamento/list', [DepartamentoAutoAtendimentoController::class, 'getAll']);
Route::get('departamento/find/{id}', [DepartamentoAutoAtendimentoController::class, 'find']);



/* Rotas dos Produtos */
Route::get('produto/list', [ProdutoAutoAtendimentoController::class, 'getAll']);
Route::post('produto/search', [ProdutoAutoAtendimentoController::class, 'search']);


/* Rota de Preços */
Route::get('preco/list', [PrecoAutoAtendimentoController::class, 'getAll']);
Route::get('preco/find/{id}', [PrecoAutoAtendimentoController::class, 'find']);
Route::post('preco/search', [PrecoAutoAtendimentoController::class, 'search']);


/* Rota de de Vendas */
Route::put('venda/update/{id}', [VendaAutoAtendimentoController::class, 'update']);
Route::post('venda/insert', [VendaAutoAtendimentoController::class, 'insert']);
Route::post('venda/search', [VendaAutoAtendimentoController::class, 'search']);
