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

        // Se for um cliente comum, redireciona para a sua garagem personalizada
        if ($user && !$user->is_admin) {
            // Nota: Ajustei para 'is_admin' para bater certo com o seu AdminMiddleware que vimos atrás!
            return redirect()->route('garage.index');
        }

        // 1. Contagens para a frota de viaturas
        $totalViaturas = Viatura::count();
        // Nota: Garanta que a sua tabela usa 'Disponível' e 'Vendido' com ou sem acento
        $totalDisponiveis = Viatura::where('estado', 'Disponível')->count();
        $totalVendidas = Viatura::where('estado', 'Vendido')->count();

        // 2. Total de clientes registados
        $totalClientes = Cliente::count();

        // 3. Contratos e faturamento global das vendas
        $totalVendas = Venda::count();

        // CORREÇÃO LINHA 30: Substitua 'valor' pelo nome real da coluna de preço na sua tabela de vendas (ex: 'preco' ou 'total')
        $valorTotalVendas = Venda::sum('valor');

        // 4. Últimas solicitações de visita / Test Drive
        $ultimasVisitas = Visita::with('viatura')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalViaturas',
            'totalDisponiveis',
            'totalVendidas',
            'totalClientes',
            'totalVendas',
            'valorTotalVendas',
            'ultimasVisitas'
        ));
    }
}
