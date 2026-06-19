@extends('layouts.app')

@section('title', 'A Minha Garagem | SS Automóveis')

@section('content')

<style>
    .glass-panel {
        background: rgba(32, 31, 31, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .glass-card {
        background: rgba(28, 27, 27, 0.4);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: transform 0.3s cubic-bezier(0.2, 0, 0, 1);
    }
    .glass-card:hover {
        transform: translateY(-4px);
        border-color: rgba(184, 195, 255, 0.2);
    }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
</style>

<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Header Principal -->
    <header class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-white/5">
        <div class="space-y-2">
            <span class="font-mono text-xs uppercase tracking-widest text-[#b8c3ff] block">CUSTOMER PORTAL</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tighter text-white uppercase font-sora" style="font-family: 'Sora', sans-serif;">
              <br>

                Olá, {{ Auth::user()->name ?? 'Diana Silva' }}
            </h1>
            <p class="text-sm max-w-2xl text-[#c4c5d9]">Central de controlo do cliente: gerir favoritos, propostas e agendamentos.</p>
        </div>

        <!-- Indicadores de Contagem -->
        <div class="flex gap-4">
            <div class="glass-panel p-4 rounded-sm min-w-[150px]">
                <div class="text-[#b8c3ff] text-2xl md:text-3xl font-bold font-mono">
                    {{ str_pad(count($meusFavoritos ?? []), 2, '0', STR_PAD_LEFT) }}
                </div>
                <div class="font-mono text-[9px] uppercase text-[#8e90a2] tracking-wider mt-1">Carros Guardados</div>
            </div>
            <div class="glass-panel p-4 rounded-sm min-w-[150px]">
                <div class="text-[#b8c3ff] text-2xl md:text-3xl font-bold font-mono">01</div>
                <div class="font-mono text-[9px] uppercase text-[#8e90a2] tracking-wider mt-1">Pedidos Ativos</div>
            </div>
        </div>
    </header>

    <!-- SECÇÃO 1: CARROS FAVORITOS -->
    <section class="mb-20">
        <div class="flex items-center gap-2 mb-6">
            <span class="material-symbols-outlined text-[#b8c3ff] text-lg">favorite</span>
            <h2 class="text-lg font-bold uppercase tracking-widest text-white font-mono">Modelos de Eleição</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($meusFavoritos ?? [] as $favorito)
                @if($favorito->viatura)
                <div class="glass-card rounded-sm overflow-hidden group flex flex-col justify-between">
                    <div class="aspect-[16/10] overflow-hidden relative bg-[#1c1b1b]">
                        @if($favorito->viatura->foto)
                            <img src="{{ asset($favorito->viatura->foto) }}" alt="{{ $favorito->viatura->marca }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-[#8e90a2]">directions_car</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
                        <div>
                            <span class="font-mono text-[10px] uppercase tracking-widest block mb-1 text-[#8e90a2]">
                                {{ $favorito->viatura->marca }}
                            </span>
                            <h3 class="text-lg text-white font-bold uppercase truncate font-sora" style="font-family: 'Sora', sans-serif;">
                                {{ $favorito->viatura->modelo }}
                            </h3>
                        </div>

                        <div class="pt-4 border-t flex justify-between items-center font-mono text-xs border-white/5">
                            <span class="font-bold text-sm text-[#b8c3ff]">
                                {{ number_format($favorito->viatura->preco ?? 0, 0, ',', '.') }} €
                            </span>
                            <a href="{{ route('viaturas.show', $favorito->viatura->id) }}"
                               class="text-white hover:text-[#b8c3ff] uppercase tracking-wider transition-colors inline-flex items-center gap-1">
                                Ver Ficha
                                <span class="material-symbols-outlined text-xs">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div class="col-span-full border border-dashed p-16 text-center font-mono text-xs uppercase tracking-widest rounded-sm border-white/10 text-[#8e90a2]">
                    Nenhum veículo guardado nos favoritos.
                </div>
            @endforelse
        </div>
    </section>

    <!-- SECÇÃO 2: GRID COMPACTA DE COMPROMISSOS COMERCIAIS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Bloco A: Pedidos de Contacto / Propostas Ativas -->
        <div class="bg-[#141313] border border-white/5 rounded-sm p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-white/5 pb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#b8c3ff] text-sm">chat_bubble</span>
                    <h3 class="font-mono text-xs uppercase tracking-widest text-white font-bold">Negociações &amp; Propostas</h3>
                </div>
                <span class="bg-[#b8c3ff]/10 text-[#b8c3ff] text-[10px] font-mono px-2 py-0.5 rounded-sm uppercase tracking-wider">1 Ativo</span>
            </div>

            <div class="space-y-3">
                <!-- Exemplo de Negociação Real ou Simulada -->
                <div class="bg-[#1a1a1a] p-4 border border-white/5 rounded-sm flex justify-between items-center">
                    <div>
                        <p class="font-mono text-[10px] text-[#8e90a2] uppercase">Porsche 911 Carrera S</p>
                        <p class="text-xs text-white/90 mt-1">Pedido de avaliação de retoma enviado.</p>
                    </div>
                    <span class="font-mono text-[9px] uppercase tracking-wider text-amber-400 bg-amber-400/10 px-2 py-1 rounded-sm">
                        Em Análise
                    </span>
                </div>
            </div>
        </div>

        <!-- Bloco B: Test Drives / Visitas Marcadas -->
        <div class="bg-[#141313] border border-white/5 rounded-sm p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-white/5 pb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#b8c3ff] text-sm">calendar_month</span>
                    <h3 class="font-mono text-xs uppercase tracking-widest text-white font-bold">Visitas ao Stand</h3>
                </div>
            </div>

            <!-- Fallback limpo caso não existam visitas -->
            <div class="p-8 text-center bg-[#1a1a1a] border border-dashed border-white/5 rounded-sm font-mono text-[11px] text-[#8e90a2] uppercase tracking-wide">
                <span class="material-symbols-outlined text-xl block mb-1 text-white/5">event_busy</span>
                Nenhum test drive agendado de momento.
            </div>
        </div>

    </div>

</main>

@endsection
