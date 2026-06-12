<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('viaturas', ViaturaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('vendas', VendaController::class);

});
