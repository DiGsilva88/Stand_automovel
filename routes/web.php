<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/viaturas', [ViaturaController::class, 'index']);
Route::get('/viaturas/{viatura}', [ViaturaController::class, 'show']);

Route::middleware(['auth'])->group(function () {

    Route::resource('clientes', ClienteController::class);

    Route::resource('vendas', VendaController::class);

    Route::resource('viaturas', ViaturaController::class)
         ->except(['index', 'show']);

});
