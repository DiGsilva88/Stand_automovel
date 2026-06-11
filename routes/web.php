<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\VendaController;

Route::get('/', function () {
    return redirect()->route('viaturas.index');
});

Route::resource('clientes', ClienteController::class);
Route::resource('viaturas', ViaturaController::class);
Route::resource('vendas', VendaController::class);
