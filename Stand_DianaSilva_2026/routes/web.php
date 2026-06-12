<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;

// Redireciona a página inicial diretamente para as viaturas
Route::redirect('/', '/viaturas');

// Rotas públicas (LIVRES DE LOGIN) para testar o CRUD à vontade

Route::resource('viaturas', ViaturaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('vendas', VendaController::class);

// Se o Breeze criou uma rota de dashboard, pode deixá-la aqui em baixo isolada
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
