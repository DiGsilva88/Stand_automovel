<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;

// Redireciona a página inicial diretamente para o dashboard (requer login)
Route::redirect('/', '/dashboard');

// Rotas públicas (LIVRES DE LOGIN) para testar o CRUD à vontade

Route::resource('viaturas', ViaturaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('vendas', VendaController::class);

// Painel principal — apenas para utilizadores autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
