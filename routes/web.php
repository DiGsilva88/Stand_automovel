<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\FavoritoController;
use App\Http\Middleware\EnsureUserIsAdminOrSeller;
use Illuminate\Support\Facades\Route;

// ==========================================
// ROTAS PÚBLICAS (Qualquer visitante acede)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catálogo público de Viaturas (Leitura)
Route::get('/viaturas', [ViaturaController::class, 'index'])->name('viaturas.index');

// Formulário público de marcação de visita / Test Drive
Route::get('/marcar-visita', [VisitaController::class, 'create'])->name('visitas.create');
Route::post('/marcar-visita', [VisitaController::class, 'store'])->name('visitas.store');


// ==========================================
// ÁREA INTERNA PROTEGIDA (Exige Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Comum (Diferencia Cliente/Admin dinamicamente no Controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ------------------------------------------
    // ÁREA EXCLUSIVA DO CLIENTE (My Garage)
    // ------------------------------------------
    Route::get('/my-garage', [FavoritoController::class, 'index'])->name('garage.index');
    Route::post('/viaturas/{viatura}/favorito', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');

    // Gestão do Perfil do Utilizador (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------------------------
    // ROTAS ACESSÍVEIS POR ADMINS E VENDEDORES
    // ------------------------------------------
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {

        Route::resource('clientes', ClienteController::class);
        Route::resource('vendas', VendaController::class);
    });

    // ------------------------------------------
    // SUBGRUPO EXCLUSIVO DE ADMINISTRADORES
    // ------------------------------------------
    Route::middleware(['admin'])->group(function () {

        // Ações Críticas de Viaturas (Criar, Editar, Eliminar)
        Route::resource('viaturas', ViaturaController::class)->except(['index']);

        // Lógica de Aceitar/Recusar pedidos de Test Drive
        Route::patch('/admin/visitas/{visita}/confirmar', [VisitaController::class, 'confirmar'])->name('admin.visitas.confirmar');
        Route::patch('/admin/visitas/{visita}/cancelar', [VisitaController::class, 'cancelar'])->name('admin.visitas.cancelar');

    }); // Fecha o grupo admin

}); // Fecha o grupo auth e verified

require __DIR__.'/auth.php';
