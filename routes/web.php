<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;

// Redireciona a página inicial diretamente para o dashboard
Route::redirect('/', '/dashboard');

// Todas as rotas públicas — sem necessidade de login

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('viaturas', ViaturaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('vendas', VendaController::class);
