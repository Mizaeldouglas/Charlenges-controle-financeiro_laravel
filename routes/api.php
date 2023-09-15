<?php

use App\Http\Controllers\api\DespesasController;
use App\Http\Controllers\api\ReceitasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::resource('/receitas', ReceitasController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);

    Route::resource('/despesas', DespesasController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);

    Route::get('/receitas', [ReceitasController::class, 'findForDespesas']);
});