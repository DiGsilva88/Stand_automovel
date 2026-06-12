<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de viaturas disponíveis
        $totalDisponiveis = Viatura::where('estado', 'Disponível')->count();

        // Total de viaturas vendidas
        $totalVendidas = Viatura::where('estado', 'Vendido')->count();

        // Total geral de viaturas
        $totalViaturas = Viatura::count();

        // Total de vendas registadas
        $totalVendas = Venda::count();

        // Total de clientes
        $totalClientes = Cliente::count();

        // Soma do valor total de vendas
        $valorTotalVendas = Venda::sum('valor_venda');

        // Últimas 5 vendas (com cliente e viatura)
        $ultimasVendas = Venda::with(['cliente', 'viatura'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalDisponiveis',
            'totalVendidas',
            'totalViaturas',
            'totalVendas',
            'totalClientes',
            'valorTotalVendas',
            'ultimasVendas'
        ));
    }
}
