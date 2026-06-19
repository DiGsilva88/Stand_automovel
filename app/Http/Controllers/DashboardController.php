<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Vista de Cliente
    if ($user && !$user->isAdmin()) {
        $meusFavoritos = $user->favorites()->latest()->get();
        return view('dashboard', compact('meusFavoritos'));
    }

    // ==========================================
    // VISTA DE ADMINISTRADOR
    // ==========================================

    $totalViaturas = Viatura::count();
    $totalDisponiveis = Viatura::where('estado', 'Disponível')->count();
    $totalClientes = Cliente::count();
    $totalVendas = Venda::count();
    $valorTotalVendas = Venda::sum('valor_venda');
    $ultimasVisitas = Visita::with('viatura')->latest()->take(5)->get();

    // ==========================================
    // LÓGICA DO GRÁFICO DINÂMICO (Por Mês)
    // ==========================================
    $faturamentoMensal = [];
    $mesesLabels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    for ($mes = 1; $mes <= 12; $mes++) {
        $totalMes = Venda::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $mes)
            ->sum('valor_venda');

        $faturamentoMensal[] = $totalMes;
    }

    return view('dashboard-admin', compact(
        'totalViaturas', 'totalDisponiveis', 'totalClientes',
        'totalVendas', 'valorTotalVendas', 'ultimasVisitas',
        'faturamentoMensal', 'mesesLabels'
    ));
}
}
