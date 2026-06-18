@extends('layouts.app')

@section('title', 'Dashboard | SS Automóveis')

@section('content')

<style>
    .glass-card {
        background: rgba(28, 27, 27, 0.4);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s cubic-bezier(0.2, 0, 0, 1);
    }
    .glass-card:hover { transform: translateY(-4px); }
    .chart-gradient {
        background: linear-gradient(180deg, rgba(184, 195, 255, 0.1) 0%, rgba(184, 195, 255, 0) 100%);
    }
</style>

@if($user && $user->isCliente())
    <!-- ========================================================================== -->
    <!-- 1. VISTA EXCLUSIVA DO CLIENTE (GARAGEM / FAVORITOS)                        -->
    <!-- ========================================================================== -->
    <header class="mb-12">
        <span class="font-mono text-[11px] tracking-widest uppercase block mb-1" style="color:#b8c3ff;">CUSTOMER PORTAL</span>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-2" style="font-family: Sora, sans-serif;">A MINHA GARAGEM</h1>
        <p class="text-sm max-w-2xl" style="color:#c4c5d9;">Aceda às viaturas que guardou como favoritas no nosso showroom.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($meusFavoritos ?? [] as $favorito)
            @if($favorito->viatura)
            <div class="glass-card overflow-hidden group flex flex-col justify-between">
                <div class="aspect-[16/10] overflow-hidden relative" style="background:#1c1b1b;">
                    @if($favorito->viatura->foto)
                        <img src="/{{ $favorito->viatura->foto }}" alt="{{ $favorito->viatura->marca }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl" style="color:#8e90a2;">directions_car</span>
                        </div>
                    @endif
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div class="mb-4">
                        <span class="font-mono text-[10px] uppercase tracking-widest block mb-1" style="color:#8e90a2;">
                            {{ $favorito->viatura->marca }}
                        </span>
                        <h3 class="text-lg text-white font-bold uppercase truncate" style="font-family: Sora, sans-serif;">
                            {{ $favorito->viatura->modelo }}
                        </h3>
                    </div>
                    <div class="pt-4 border-t flex justify-between items-center font-mono text-xs" style="border-color: rgba(255,255,255,0.05);">
                        <span class="font-bold text-sm" style="color:#b8c3ff;">
                            {{ number_format($favorito->viatura->preco ?? 0, 0, ',', '.') }} €
                        </span>
                        <a href="{{ route('viaturas.index') }}" class="text-white hover:underline uppercase tracking-wider transition-colors">
                            Ver Ficha
                        </a>
                    </div>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-full border border-dashed p-16 text-center font-mono text-xs uppercase tracking-widest"
                 style="border-color: rgba(255,255,255,0.1); color:#8e90a2;">
                A sua garagem de favoritos está vazia.
            </div>
        @endforelse
    </div>

@else
    <!-- ========================================================================== -->
    <!-- 2. VISTA ADMINISTRATIVA / VENDEDORES                                      -->
    <!-- ========================================================================== -->

    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between md:items-end mb-10 gap-4">
        <div>
            <span class="font-mono text-[11px] tracking-widest uppercase block mb-1" style="color:#b8c3ff;">INTERNAL METRICS</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-2" style="font-family: Sora, sans-serif;">SYSTEM OVERVIEW</h1>
            <p class="text-sm md:text-base max-w-2xl" style="color:#c4c5d9;">
                Acompanhamento analítico de faturação, stock ativo e performance comercial em tempo real.
            </p>
        </div>
        <div class="glass-card px-4 py-2 flex items-center gap-3 rounded-lg">
            <span class="material-symbols-outlined" style="color:#b8c3ff;">calendar_today</span>
            <span class="font-mono text-[11px] uppercase">{{ now()->format('M Y') }}</span>
        </div>
    </header>

    <!-- KPIs Bento Grid -->
    <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <!-- Faturação Total -->
        <div class="glass-card p-6 rounded-xl flex flex-col justify-between h-40">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(184,195,255,0.1); color:#b8c3ff;">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <span class="font-mono text-[10px] flex items-center gap-1" style="color:#34d399;">
                    <span class="material-symbols-outlined text-sm">trending_up</span> LIVE
                </span>
            </div>
            <div>
                <p class="font-mono text-[10px] uppercase tracking-widest" style="color:#8e90a2;">FATURAÇÃO TOTAL</p>
                <h3 class="text-3xl font-bold text-white mt-1" style="font-family: Sora, sans-serif;">
                    {{ number_format($valorTotalVendas, 0, ',', '.') }} €
                </h3>
            </div>
        </div>

        <!-- Stock -->
        <div class="glass-card p-6 rounded-xl flex flex-col justify-between h-40">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(184,195,255,0.1); color:#b8c3ff;">
                    <span class="material-symbols-outlined">directions_car</span>
                </div>
                <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">{{ $totalDisponiveis }} ATIVAS</span>
            </div>
            <div>
                <p class="font-mono text-[10px] uppercase tracking-widest" style="color:#8e90a2;">STOCK DISPONÍVEL</p>
                <h3 class="text-3xl font-bold text-white mt-1" style="font-family: Sora, sans-serif;">
                    {{ $totalDisponiveis }} / {{ $totalViaturas }}
                </h3>
            </div>
        </div>

        <!-- Clientes -->
        <div class="glass-card p-6 rounded-xl flex flex-col justify-between h-40">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(184,195,255,0.1); color:#b8c3ff;">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">ATIVOS</span>
            </div>
            <div>
                <p class="font-mono text-[10px] uppercase tracking-widest" style="color:#8e90a2;">CLIENTES REGISTADOS</p>
                <h3 class="text-3xl font-bold text-white mt-1" style="font-family: Sora, sans-serif;">{{ $totalClientes }}</h3>
            </div>
        </div>

        <!-- Vendas -->
        <div class="glass-card p-6 rounded-xl flex flex-col justify-between h-40">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(184,195,255,0.1); color:#b8c3ff;">
                    <span class="material-symbols-outlined">request_quote</span>
                </div>
                <span class="font-mono text-[10px] px-2 py-1 rounded" style="background: rgba(184,195,255,0.1); color:#b8c3ff;">TOTAL</span>
            </div>
            <div>
                <p class="font-mono text-[10px] uppercase tracking-widest" style="color:#8e90a2;">VENDAS CONCLUÍDAS</p>
                <h3 class="text-3xl font-bold text-white mt-1" style="font-family: Sora, sans-serif;">{{ $totalVendas }}</h3>
            </div>
        </div>
    </section>

    <!-- Analytics: Gráfico real + Últimas transações -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">

        <!-- Gráfico de Performance de Vendas (Chart.js real) -->
        <div class="lg:col-span-2 glass-card rounded-xl p-6 flex flex-col">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h4 class="text-lg font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">
                        PERFORMANCE DE VENDAS
                    </h4>
                    <p class="text-xs" style="color:#8e90a2;">Faturação líquida acumulada por semana (últimas 5 semanas).</p>
                </div>
                <span class="material-symbols-outlined" style="color:#b8c3ff;">monitoring</span>
            </div>
            <div class="flex-1 min-h-[280px] relative">
                <div class="absolute inset-0 chart-gradient rounded-lg opacity-30 pointer-events-none"></div>
                <canvas id="ssSalesChart"></canvas>
            </div>
        </div>

        <!-- Últimas Transações Reais -->
        <div class="glass-card rounded-xl p-6 flex flex-col justify-between">
            <div>
                <h4 class="text-lg font-bold text-white tracking-tight mb-6" style="font-family: Sora, sans-serif;">
                    ÚLTIMAS TRANSAÇÕES
                </h4>
                <div class="space-y-4 max-h-72 overflow-y-auto pr-2">
                    @forelse($ultimasVendas as $venda)
                    <div class="flex items-center gap-3 pb-3 border-b last:border-none" style="border-color: rgba(255,255,255,0.05);">
                        <span class="material-symbols-outlined p-2 rounded-sm text-sm" style="background: rgba(255,255,255,0.05); color:#b8c3ff;">
                            payments
                        </span>
                        <div class="text-xs truncate flex-1">
                            <p class="font-bold text-white uppercase truncate" style="font-family: Sora, sans-serif;">
                                {{ $venda->viatura->marca ?? 'N/D' }}
                                <span class="font-normal" style="color:#8e90a2;">{{ $venda->viatura->modelo ?? '' }}</span>
                            </p>
                            <p class="font-mono text-[10px] mt-0.5 truncate" style="color:#8e90a2;">
                                Cliente: {{ $venda->cliente->nome ?? 'N/D' }}
                            </p>
                        </div>
                        <span class="font-mono text-xs font-bold whitespace-nowrap" style="color:#b8c3ff;">
                            {{ number_format($venda->valor_venda, 0, ',', '.') }}€
                        </span>
                    </div>
                    @empty
                    <p class="text-center py-8 font-mono text-xs uppercase" style="color:#8e90a2;">Nenhuma transação recente.</p>
                    @endforelse
                </div>
            </div>
            <a href="{{ route('vendas.index') }}"
               class="font-mono text-center block text-[11px] uppercase tracking-widest border py-3 mt-4 transition-colors hover:bg-white hover:text-black"
               style="border-color: rgba(255,255,255,0.1); color:#e5e2e1;">
                VER HISTÓRICO TOTAL
            </a>
        </div>
    </section>

    <!-- Inventory Status Table -->
    <section class="glass-card rounded-xl overflow-hidden mb-10">
        <div class="p-6 border-b flex justify-between items-center" style="border-color: rgba(255,255,255,0.05);">
            <h4 class="text-lg font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">
                INVENTÁRIO RECENTE
            </h4>
            <a href="{{ route('viaturas.index') }}"
               class="font-mono text-[11px] uppercase tracking-widest hover:text-white transition-colors"
               style="color:#8e90a2;">
                VER TODO O STOCK
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="font-mono text-[11px] uppercase tracking-widest border-b" style="color:#8e90a2; border-color: rgba(255,255,255,0.05);">
                        <th class="px-6 py-4 font-medium">Modelo</th>
                        <th class="px-6 py-4 font-medium">Estado</th>
                        <th class="px-6 py-4 font-medium">Ano</th>
                        <th class="px-6 py-4 font-medium">Preço</th>
                        <th class="px-6 py-4 font-medium text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-white divide-y" style="--tw-divide-opacity: 1; border-color: rgba(255,255,255,0.05);">
                    @forelse(\App\Models\Viatura::latest()->take(5)->get() as $viatura)
                    <tr class="hover:bg-white/5 transition-colors" style="border-color: rgba(255,255,255,0.05);">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-10 rounded border overflow-hidden flex-shrink-0" style="background:#2a2a2a; border-color: rgba(255,255,255,0.1);">
                                    @if($viatura->foto)
                                        <img src="/{{ $viatura->foto }}" alt="{{ $viatura->marca }}" class="w-full h-full object-cover"/>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-sm" style="color:#8e90a2;">directions_car</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold">{{ $viatura->marca }} {{ $viatura->modelo }}</p>
                                    <p class="text-[12px]" style="color:#8e90a2;">{{ $viatura->matricula ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-2 py-1 rounded-sm font-mono text-[10px]"
                                  style="{{ $viatura->estado === 'Disponível'
                                        ? 'background: rgba(184,195,255,0.1); color:#b8c3ff;'
                                        : ($viatura->estado === 'Reservado'
                                            ? 'background: rgba(101,109,132,0.2); color:#bec6e0;'
                                            : 'background: rgba(255,180,171,0.1); color:#ffb4ab;') }}">
                                {{ strtoupper($viatura->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-5 font-mono text-sm">{{ $viatura->ano }}</td>
                        <td class="px-6 py-5 font-mono text-sm">{{ number_format($viatura->preco, 0, ',', '.') }} €</td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('viaturas.edit', $viatura->id) }}"
                                   class="w-8 h-8 flex items-center justify-center hover:text-white transition-colors" style="color:#b8c3ff;">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST"
                                      onsubmit="return confirm('Eliminar esta viatura?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center hover:text-white transition-colors" style="color:#ffb4ab;">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center font-mono text-xs uppercase" style="color:#8e90a2;">
                            Nenhuma viatura registada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endif

@endsection

@push('scripts')
@if(!($user && $user->isCliente()))
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('ssSalesChart');
        if (ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Semana -4', 'Semana -3', 'Semana -2', 'Semana -1', 'Esta Semana'],
                    datasets: [{
                        label: 'Faturação Semanal (€)',
                        data: @json($sales_weekly),
                        borderColor: '#b8c3ff',
                        backgroundColor: 'rgba(184, 195, 255, 0.08)',
                        borderWidth: 2,
                        tension: 0.35,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#2e5bff',
                        pointBorderColor: '#b8c3ff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: {
                                color: '#c4c5d9',
                                font: { family: 'JetBrains Mono', size: 10 },
                                callback: (value) => value.toLocaleString('pt-PT') + ' €'
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#c4c5d9', font: { family: 'JetBrains Mono', size: 11 } }
                        }
                    }
                }
            });
        }
    });
</script>
@endif
@endpush
