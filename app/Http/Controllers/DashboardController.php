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

        // 1. VISTA DE CLIENTE
        if ($user && !$user->isAdmin()) {
            // Obtém os carros favoritos ordenados pelos mais recentes
            $meusFavoritos = $user->favorites()->latest()->get();

            // Obtém os agendamentos/visitas deste utilizador
            $minhasVisitas = $user->visitas()->latest()->get();

            return view('dashboard', compact('meusFavoritos', 'minhasVisitas'));
        }

        // 2. VISTA DE ADMINISTRADOR (Unificada dentro do método index)
        $totalViaturas = Viatura::count();
        $totalDisponiveis = Viatura::where('estado', 'Disponível')->count();
        $totalClientes = Cliente::count();
        $totalVendas = Venda::count();
        // Linha 37:
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
                ->sum('valor_venda'); // Linha 49: Ajustado aqui também

            $faturamentoMensal[] = $totalMes;
        }

        
        return view('dashboard-admin', compact(
            'totalViaturas', 'totalDisponiveis', 'totalClientes',
            'totalVendas', 'valorTotalVendas', 'ultimasVisitas',
            'faturamentoMensal', 'mesesLabels'
        ));
    }
}
