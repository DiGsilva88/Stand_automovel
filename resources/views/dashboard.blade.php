@extends('layouts.app')

@section('title', 'Dashboard | AETHER MOTORS')

@section('content')

@if(Auth::user() && ((Auth::user()->perfil ?? null) === 'Cliente'))
    <!-- ========================================================================== -->
    <!-- 1. VISTA EXCLUSIVA DO CLIENTE (GARAGEM / FAVORITOS)                        -->
    <!-- ========================================================================== -->
    <header class="mb-12">
        <span class="text-xs font-mono tracking-widest text-aether-blue uppercase block mb-1">CUSTOMER PORTAL</span>
        <h1 class="font-sora text-4xl md:text-5xl font-bold text-aether-light mb-2">A MINHA GARAGEM</h1>
        <p class="text-sm text-aether-gray max-w-2xl">Aceda às viaturas que guardou como favoritas no nosso showroom.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($meusFavoritos ?? [] as $favorito)
            @if($favorito->viatura)
            <div class="glass-card overflow-hidden group flex flex-col justify-between">
                <div class="aspect-[16/10] overflow-hidden relative bg-neutral-900">
                    <img src="{{ $favorito->viatura->image_url ?? 'https://unsplash.com' }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Carro">
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div class="mb-4">
                        <span class="font-mono text-[10px] uppercase tracking-widest text-aether-gray block mb-1">{{ $favorito->viatura->marca }}</span>
                        <h3 class="font-sora text-lg text-white font-bold uppercase truncate">{{ $favorito->viatura->modelo }}</h3>
                    </div>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center font-mono text-xs">
                        <span class="text-aether-blue font-bold text-sm">{{ number_format($favorito->viatura->preco ?? 0, 0, ',', '.') }} €</span>
                        <a href="{{ route('viaturas.index') }}" class="text-white hover:text-aether-blue transition-colors uppercase tracking-wider">Ver Ficha</a>
                    </div>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-full border border-dashed border-white/10 p-16 text-center text-aether-gray font-mono text-xs uppercase tracking-widest">
                A sua garagem de favoritos está vazia.
            </div>
        @endforelse
    </div>

@else
    <!-- ========================================================================== -->
    <!-- 2. VISTA ADMINISTRATIVA / VENDEDORES                                      -->
    <!-- ========================================================================== -->
    <header class="mb-12">
        <span class="text-xs font-mono tracking-widest text-aether-blue uppercase block mb-1">INTERNAL METRICS</span>
        <h1 class="font-sora text-4xl md:text-5xl font-bold text-aether-light mb-2">SYSTEM OVERVIEW</h1>
        <p class="text-sm md:text-base text-aether-gray max-w-2xl">Acompanhamento analítico de faturação, stock ativo e performance comercial em tempo real.</p>
    </header>

    <!-- Indicadores em Cartões de Vidro Reais (KPIs) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <!-- Faturação Dinâmica -->
        <div class="glass-card p-6 flex flex-col justify-between h-36">
            <span class="font-mono text-[10px] uppercase tracking-widest text-aether-gray">FATURAÇÃO TOTAL</span>
            <div class="font-sora text-2xl font-bold text-white mt-2">{{ number_format($valorTotalVendas, 0, ',', '.') }} €</div>
            <span class="font-mono text-[10px] text-green-400 mt-2 flex items-center gap-1">★ GLOBAL LIVE STATUS</span>
        </div>

        <!-- Stock Dinâmico -->
        <div class="glass-card p-6 flex flex-col justify-between h-36">
            <span class="font-mono text-[10px] uppercase tracking-widest text-aether-gray">STOCK DISPONÍVEL</span>
            <div class="font-sora text-2xl font-bold text-white mt-2">{{ $totalDisponiveis }} / {{ $totalViaturas }}</div>
            <span class="font-mono text-[10px] text-aether-blue mt-2 uppercase tracking-wider">{{ $totalVendidas }} VIATURAS VENDIDAS</span>
        </div>

        <!-- Clientes Dinâmicos -->
        <div class="glass-card p-6 flex flex-col justify-between h-36">
            <span class="font-mono text-[10px] uppercase tracking-widest text-aether-gray">CLIENTES REGISTADOS</span>
            <div class="font-sora text-2xl font-bold text-white mt-2">{{ $totalClientes }} FICHAS</div>
            <span class="font-mono text-[10px] text-aether-blue mt-2 uppercase tracking-wider">RELAÇÕES ATIVAS</span>
        </div>

        <!-- Visitas Dinâmicas -->
        <div class="glass-card p-6 flex flex-col justify-between h-36">
            <span class="font-mono text-[10px] uppercase tracking-widest text-aether-gray">VENDAS CONCLUÍDAS</span>
            <div class="font-sora text-2xl font-bold text-white mt-2">{{ $totalVendas }} CONTRATOS</div>
            <span class="font-mono text-[10px] text-amber-400 mt-2 uppercase tracking-wider">TRANSAÇÕES LIQUIDADAS</span>
        </div>
    </div>

    <!-- Secção Analítica de Gráficos e Histórico -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Gráfico Semanal Real (Ocupa 2 Colunas) -->
        <div class="lg:col-span-2 glass-card p-6">
            <div class="mb-6 flex justify-between items-start">
                <div>
                    <h3 class="font-sora text-base font-bold text-white uppercase tracking-tight">PERFORMANCE DE VENDAS</h3>
                    <p class="text-xs text-aether-gray">Volume de faturação comercial líquida acumulada por semana do mês atual.</p>
                </div>
                <span class="material-symbols-outlined text-aether-blue">monitoring</span>
            </div>
            <div class="h-64">
                <canvas id="aetherSalesChart"></canvas>
            </div>
        </div>

        <!-- Lista de Histórico Real das últimas 5 vendas (1 Coluna) -->
        <div class="glass-card p-6 flex flex-col justify-between">
            <div>
                <h3 class="font-sora text-base font-bold text-white uppercase tracking-tight mb-6">ÚLTIMAS TRANSAÇÕES</h3>
                <div class="space-y-4 max-h-64 overflow-y-auto pr-2">
                    @forelse($ultimasVendas as $venda)
                    <div class="flex items-center gap-3 pb-3 border-b border-white/5 last:border-none">
                        <span class="material-symbols-outlined text-aether-blue bg-white/5 p-2 rounded-sm text-sm">payments</span>
                        <div class="text-xs truncate flex-1">
                            <p class="font-bold text-white uppercase font-sora truncate">
                                {{ $venda->viatura->marca ?? 'N/D' }} <span class="font-normal text-aether-gray">{{ $venda->viatura->modelo ?? '' }}</span>
                            </p>
                            <p class="text-aether-gray font-mono text-[10px] mt-0.5 truncate">Cliente: {{ $venda->cliente->nome ?? 'N/D' }}</p>
                        </div>
                        <span class="font-mono text-xs text-aether-blue font-bold whitespace-nowrap">
                            {{ number_format($venda->valor_venda, 0, ',', '.') }}€
                        </span>
                    </div>
                    @empty
                    <p class="text-center py-8 font-mono text-xs text-aether-gray uppercase">Nenhuma transação recente.</p>
                    @endforelse
                </div>
            </div>
            <a href="{{ route('vendas.index') }}" class="font-mono text-center block text-[11px] uppercase tracking-widest border border-white/10 text-white py-3 hover:bg-white hover:text-black transition-colors mt-4">
                VER HISTÓRICO TOTAL
            </a>
        </div>

    </div>
@endif

@endsection

@push('scripts')
<!-- Biblioteca de Gráficos Chart.js (Link Corrigido) -->
<script src="https://jsdelivr.net"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('aetherSalesChart');
        if (ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4', 'Semana 5'],
                    datasets: [{
                        label: 'Faturação Semanal (€)',
                        data: @json($sales_weekly),
                        borderColor: '#b8c3ff',
                        backgroundColor: 'rgba(184, 195, 255, 0.02)',
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
                            ticks: { color: '#c4c5d9', font: { family: 'JetBrains Mono', size: 10 } }
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
@endpush
