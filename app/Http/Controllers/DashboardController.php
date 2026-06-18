<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importação essencial para o editor reconhecer o User

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && !$user->is_admin) {
            $meusFavoritos = $user->favorites()->latest()->get();
            return view('dashboard', compact('meusFavoritos'));
        }

    // Métricas Gerais
    $totalViaturas = \App\Models\Viatura::count();
    $totalDisponiveis = \App\Models\Viatura::where('estado', 'Disponível')->count();
    $totalClientes = \App\Models\Cliente::count();
    $totalVendas = \App\Models\Venda::count();
    $valorTotalVendas = \App\Models\Venda::sum('valor');
    $ultimasVisitas = \App\Models\Visita::with('viatura')->latest()->take(5)->get();

    // ==========================================
    // LÓGICA DO GRÁFICO DINÂMICO (Por Mês)
    // ==========================================
    $faturamentoMensal = [];
    $mesesLabels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    // Filtra e agrupa as vendas do ano atual (2026)
    for ($mes = 1; $mes <= 12; $mes++) {
        $totalMes = \App\Models\Venda::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $mes)
            ->sum('valor'); // Certifique-se de que a coluna se chama 'valor' ou 'preco'

        $faturamentoMensal[] = $totalMes;
    }

    return view('dashboard', compact(
        'totalViaturas', 'totalDisponiveis', 'totalClientes',
        'totalVendas', 'valorTotalVendas', 'ultimasVisitas',
        'faturamentoMensal', 'mesesLabels'
    ));
}
}
