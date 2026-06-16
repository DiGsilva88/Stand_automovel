<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Visita;
use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. FLUXO DO CLIENTE: Procura as viaturas que o cliente guardou na garagem
        if ($user && (method_exists($user, 'isCliente') ? $user->isCliente() : (($user->perfil ?? null) === 'Cliente'))) {
            $meusFavoritos = Favorito::with('viatura')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

            return view('dashboard', compact('meusFavoritos'));
        }

        // 2. FLUXO DA ADMINISTRAÇÃO / VENDEDORES: Estatísticas Gerais do Stand
        $totalDisponiveis = Viatura::where('estado', 'Disponível')->count();
        $totalVendidas    = Viatura::where('estado', 'Vendido')->count();
        $totalViaturas    = Viatura::count();
        $totalVendas      = Venda::count();
        $totalClientes    = Cliente::count();

        // Soma da valorização total das viaturas ativas (para o card Gross Stock Valuation)
        $viaturas_total_value = Viatura::where('estado', 'Disponível')->sum('preco') ?? 0;

        // Contagem de marcas (modelos únicos) registadas para o inventário
        $brands_count = Viatura::distinct('marca')->count('marca') ?? 0;

        // Faturamento real do stand (utilizando a sua coluna 'valor_venda')
        $valorTotalVendas = Venda::sum('valor_venda') ?? 0;

        // Últimas 5 vendas (com cliente e viatura)
        $ultimasVendas = Venda::with(['cliente', 'viatura'])
            ->latest()
            ->take(5)
            ->get();

        // Últimos 3 Clientes registados (para o Hot Leads Tracker)
        $hot_leads = Cliente::latest()
                            ->take(3)
                            ->get();

        // Últimas 5 visitas agendadas no stand
        $ultimasVisitas = Visita::with('viatura')
            ->latest('data_hora')
            ->take(5)
            ->get();

        // Gráfico de Performance Semanal: Soma de vendas por semana no mês corrente
        $sales_weekly = Venda::select(
            DB::raw('WEEK(data_venda) as semana'),
            DB::raw('SUM(valor_venda) as total')
        )
        ->whereMonth('data_venda', now()->month)
        ->whereYear('data_venda', now()->year)
        ->groupBy('semana')
        ->orderBy('semana', 'asc')
        ->pluck('total')
        ->toArray();

        // Fallback para o gráfico de linhas não falhar caso o mês não tenha vendas registadas
        if (empty($sales_weekly)) {
            $sales_weekly = [];
        }

        // Retorna a vista administrativa com todas as métricas unificadas para o novo design
        return view('dashboard', compact(
            'totalViaturas',
            'totalDisponiveis',
            'totalVendidas',
            'totalClientes',
            'totalVendas',
            'valorTotalVendas',
            'ultimasVendas',
            'ultimasVisitas',
            'viaturas_total_value',
            'brands_count',
            'hot_leads',
            'sales_weekly'
        ));
    }
}
