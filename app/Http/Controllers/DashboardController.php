<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDisponiveis = Viatura::where('estado', 'Disponível')->count();
        $totalVendidas = Viatura::where('estado', 'Vendido')->count();
        $totalViaturas = Viatura::count();
        $totalVendas = Venda::count();
        $totalClientes = Cliente::count();
        $valorTotalVendas = Venda::sum('valor_venda');

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
