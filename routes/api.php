<?php

use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// Rotas catehorias
Route::get('/categorias', [CategoriaProdutoController::class, 'index']);
Route::get('/categoria/{id}', [CategoriaProdutoController::class, 'show']);
Route::post('/categoria', [CategoriaProdutoController::class, 'store']);
Route::put('/categoria/{id}', [CategoriaProdutoController::class, 'update']);
Route::delete('/categoria/{id}', [CategoriaProdutoController::class, 'destroy']);

// Rotas catehorias
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produto/{id}', [ProdutoController::class, 'show']);
Route::post('/produto', [ProdutoController::class, 'store']);
Route::put('/produto/{id}', [ProdutoController::class, 'update']);
Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);
