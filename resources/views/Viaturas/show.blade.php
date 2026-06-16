@extends('layouts.app')

@section('title', $viatura->marca . ' ' . $viatura->modelo . ' — AETHER MOTORS')

@section('content')

<!-- Link de Retorno Superior -->
<div class="mb-8">
    <a href="{{ route('viaturas.index') }}" class="font-mono text-xs uppercase tracking-widest text-aether-gray hover:text-aether-blue transition-colors inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Back to Showroom
    </a>
</div>

<!-- Grelha Principal Assimétrica (Imagem 1.2x vs Dados 0.8x) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Lado Esquerdo: Bloco de Visualização de Alta Performance (7 Colunas) -->
    <div class="lg:col-span-7 glass-card rounded-2xl overflow-hidden aspect-[16/10] bg-neutral-900/40 flex items-center justify-center relative group">
        @if(!empty($viatura->foto))
            <img src="{{ asset($viatura->foto) }}" alt="{{ $viatura->marca }} {{ $viatura->modelo }}"
                 class="w-full h-full object-cover opacity-95 group-hover:scale-102 transition-transform duration-700"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

            <div class="hidden absolute inset-0 flex-col items-center justify-center text-aether-gray font-mono text-xs uppercase tracking-widest bg-black/50">
                <span class="material-symbols-outlined text-3xl mb-2 text-white/20">broken_image</span>
                Media Assets Missing
            </div>
        @else
            <div class="flex flex-col items-center justify-center text-aether-gray font-mono text-xs uppercase tracking-widest">
                <span class="material-symbols-outlined text-4xl mb-2 text-white/10">directions_car</span>
                No Media Available
            </div>
        @endif

        <!-- Emblema de Estado Absoluto -->
        <div class="absolute bottom-6 left-6 bg-black/80 backdrop-blur-md border border-white/10 px-4 py-1.5 font-mono text-[10px] tracking-widest text-white uppercase rounded-sm">
            STATUS // <span class="{{ $viatura->estado === 'Disponível' ? 'text-green-400' : 'text-aether-blue' }} font-bold">{{ $viatura->estado }}</span>
        </div>
    </div>

    <!-- Lado Direito: Especificações Técnicas e Painel de Ações (5 Colunas) -->
    <div class="lg:col-span-5 glass-card p-8 rounded-2xl space-y-6">

        <!-- Sobretítulo e Nome do Modelo -->
        <div>
            <span class="font-mono text-xs tracking-widest text-aether-blue uppercase block mb-1">
                {{ $viatura->ano }} MODEL &bull; {{ number_format($viatura->quilometros, 0, ',', '.') }} KM
            </span>
            <h1 class="font-sora text-3xl font-bold text-white uppercase tracking-tight leading-tight">
                {{ $viatura->marca }} <span class="text-aether-gray font-normal">{{ $viatura->modelo }}</span>
            </h1>
        </div>

        <!-- Preço Comercial em Destaque Brilhante -->
        <div class="font-sora text-3xl font-extrabold text-white tracking-tight pb-6 border-b border-white/5 flex items-baseline gap-1">
            {{ number_format($viatura->preco ?? 0, 0, ',', '.') }} <span class="text-aether-blue font-normal text-xl">€</span>
        </div>

        <!-- Tabela Técnica Detalhada (Estilo Corporativo Mono) -->
        <div class="space-y-3 font-mono text-xs uppercase tracking-wider text-aether-gray">
            <div class="flex justify-between items-center py-2 border-b border-white/5">
                <span class="text-white/40">Registration</span>
                <span class="font-bold text-white tracking-normal">{{ $viatura->matricula }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-white/5">
                <span class="text-white/40">Kilometers</span>
                <span class="font-bold text-white">{{ number_format($viatura->quilometros, 0, ',', '.') }} km</span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-white/40">Stock Allocation</span>
                <span class="font-bold {{ $viatura->estado === 'Disponível' ? 'text-green-400' : 'text-slate-400' }}">
                    {{ $viatura->estado }}
                </span>
            </div>
        </div>

        <!-- Matriz de Ações de Gestão de Vendas/Stock -->
        <div class="pt-4 border-t border-white/5 space-y-3 font-mono text-xs uppercase tracking-widest font-bold">

            <a href="{{ route('viaturas.edit', $viatura->id) }}"
               class="w-full py-3.5 bg-aether-electric hover:bg-aether-blue hover:text-aether-dark-blue text-white text-center rounded-sm transition-colors block tracking-widest">
                Edit Specifications
            </a>

            <a href="{{ route('vendas.create', ['viatura_id' => $viatura->id]) }}"
               class="w-full py-3.5 border border-white/10 hover:border-white text-white text-center rounded-sm transition-colors block tracking-widest">
                Register Showroom Sale
            </a>

            <!-- Operação Destrutiva Refinada -->
            <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST"
                  onsubmit="return confirm('WARNING: Are you sure you want to permanently remove this vehicle from inventory?');"
                  class="pt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-3 bg-red-950/30 hover:bg-red-600 border border-red-900/30 text-red-400 hover:text-white text-center rounded-sm transition-colors tracking-widest">
                    Purge Asset from Inventory
                </button>
            </form>
        </div>
    </div>

</div>

@endsection
