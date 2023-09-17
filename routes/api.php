<?php

use App\Http\Controllers\api\DespesasController;
use App\Http\Controllers\api\ReceitasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {

    /*****************************  /RECEITAS  *****************************/

    Route::resource('/receitas', ReceitasController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
    Route::get('/receitas', [ReceitasController::class, 'findForReceitas']);
    Route::get('/receitas/{ano}/{mes}', [ReceitasController::class, 'listarPorMes']);



    /*****************************  /RECEITAS  *****************************/

    Route::resource('/despesas', DespesasController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
    Route::get('/despesas', [DespesasController::class, 'findForDespesas']);
    Route::get('/despesas/{ano}/{mes}', [DespesasController::class, 'listarPorMes']);
});
