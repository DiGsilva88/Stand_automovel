<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\FavoritoController;
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
Route::middleware(['web', 'auth', 'verified'])->group(function () {

    // Dashboard Principal do Painel Administrativo
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestão do Perfil do Utilizador (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Área do Cliente (My Garage)
    Route::get('/my-garage', [FavoritoController::class, 'index'])->name('garage.index');
    Route::post('/viaturas/{viatura}/favorito', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');

    // ------------------------------------------------------------
    // ÁREA EXCLUSIVA DE ADMINISTRADORES (Diana Silva / Admin)
    // ------------------------------------------------------------
    Route::group(['middleware' => function ($request, $next) {
        // Validação direta baseada nos dados fornecidos
        if (auth()->user()->email === 'admin@ssautomoveis.pt' || (isset(auth()->user()->role) && auth()->user()->role === 'admin')) {
            return $next($request);
        }
        abort(403, 'Acesso restrito aos administradores do sistema.');
    }], function () {

        // Clientes (Acesso total liberado para o Admin)
        Route::resource('clientes', ClienteController::class);

        // Vendas (Acesso total liberado para o Admin)
        Route::resource('vendas', VendaController::class);

        // Ações Críticas de Viaturas (Criar, Editar, Eliminar)
        Route::resource('viaturas', ViaturaController::class)->except(['index']);

        // Lógica de Aceitar/Recusar pedidos de Test Drive
        Route::patch('/admin/visitas/{visita}/confirmar', [VisitaController::class, 'confirmar'])->name('admin.visitas.confirmar');
        Route::patch('/admin/visitas/{visita}/cancelar', [VisitaController::class, 'cancelar'])->name('admin.visitas.cancelar');
    });

}); // Fecha o grupo auth e verified

require __DIR__.'/auth.php';
