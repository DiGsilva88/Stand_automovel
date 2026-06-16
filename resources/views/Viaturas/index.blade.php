@extends('layouts.app')

@section('title', 'The Showroom — SS Motors')

@section('content')

<!-- Cabeçalho Principal Estilo Aether Dark -->
<div class="mb-12">
    <span class="text-[10px] font-mono tracking-widest text-aether-blue uppercase block mb-1">AETHER CURATED FLEET</span>
    <h1 class="font-sora text-4xl lg:text-5xl font-bold text-aether-light uppercase tracking-tighter">The Showroom</h1>
    <p class="text-sm text-aether-gray mt-2 max-w-xl leading-relaxed">
        Curated precision. Explore our collection of performance-engineered masterpieces, each passing a certified mechanical assessment.
    </p>
</div>

<!-- Layout de Duas Colunas (Filtros + Grelha de Carros) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Barra Lateral de Filtros (Estilo Glass Card) -->
    <aside class="lg:col-span-3 glass-card p-6 space-y-6 sticky top-32">
        <div class="flex items-center justify-between pb-4 border-b border-white/5">
            <h3 class="font-mono text-xs uppercase tracking-widest text-aether-blue flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">tune</span> FILTERS
            </h3>
            <a href="{{ route('viaturas.index') }}" class="text-[10px] text-aether-gray hover:text-white underline uppercase font-mono">Reset</a>
        </div>

        <form action="{{ route('viaturas.index') }}" method="GET" class="space-y-6">
            <!-- Categorias -->
            <div>
                <label class="block font-mono text-xs uppercase text-aether-gray mb-3">CATEGORY</label>
                <div class="space-y-3">
                    @foreach(['SUV', 'Sedan', 'Coupe'] as $cat)
                    <label class="flex items-center gap-3 cursor-pointer text-sm text-aether-gray hover:text-white transition-colors">
                        <input type="checkbox" name="categories[]" value="{{ $cat }}"
                            {{ in_array($cat, request('categories', [])) ? 'checked' : '' }}
                            class="w-4 h-4 rounded-sm border-white/20 bg-transparent text-aether-blue focus:ring-0 focus:ring-offset-0">
                        <span>{{ $cat }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Seleção de Marcas -->
            <div>
                <label class="block font-mono text-xs uppercase text-aether-gray mb-3">BRAND</label>
                <select name="brand" class="w-full bg-[#201f1f] border border-white/10 text-white p-2.5 text-xs font-mono outline-none tracking-wider focus:border-aether-blue transition-colors rounded-sm">
                    <option value="">ALL MANUFACTURERS</option>
                    @foreach($brands ?? ['Aether Performance', 'Zenith', 'Lumina', 'Velox'] as $b)
                    <option value="{{ $b }}" {{ request('brand') == $b ? 'selected' : '' }}>{{ strtoupper($b) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Slider de Preço Customizado -->
            <div>
                <div class="flex justify-between items-center mb-2 font-mono text-xs text-aether-gray">
                    <span>PRICE RANGE</span>
                    <span class="text-aether-blue font-bold">{{ number_format(request('max_price', 250000), 0, ',', '.') }} €</span>
                </div>
                <input type="range" name="max_price" min="40000" max="250000" step="5000"
                       value="{{ request('max_price', 250000) }}"
                       class="w-full h-1 bg-white/10 rounded-lg appearance-none cursor-pointer accent-aether-blue">
                <div class="flex justify-between text-[10px] font-mono text-aether-gray mt-1">
                    <span>40k€</span>
                    <span>250k€+</span>
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-aether-electric text-white font-bold uppercase tracking-widest text-xs hover:bg-aether-blue hover:text-aether-dark-blue transition-colors font-mono">
                Apply Filters
            </button>
        </form>
    </aside>

    <!-- Listagem de Veículos (9 Colunas) -->
    <section class="lg:col-span-9 space-y-6">

        <!-- Barra de Status Superior Comercial -->
        <div class="glass-card p-4 flex justify-between items-center text-xs font-mono tracking-widest text-aether-gray uppercase">
            <p>
                <span class="text-aether-blue font-bold">{{ $viaturas->count() }}</span> VEHICLES AVAILABLE
            </p>
            <div class="flex gap-2">
                <span class="material-symbols-outlined text-sm text-aether-blue bg-white/5 p-1 rounded-sm">grid_view</span>
            </div>
        </div>

        <!-- Grelha de Produtos em Formato Glass -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($viaturas as $viatura)
            <div class="glass-card group overflow-hidden flex flex-col justify-between">

                <!-- Contentor da Imagem Corrigido com Fallback Seguro para os dados fictícios -->
                <!-- Procure o contentor da imagem em viaturas/index.blade.php e substitua por este: -->
<div class="aspect-[16/10] overflow-hidden relative bg-neutral-900/50 flex items-center justify-center">
    @php
        // 1. Tenta usar a foto da BD se ela existir no disco
        if (!empty($viatura->foto) && file_exists(public_path($viatura->foto))) {
            $imagemFinal = asset($viatura->foto);
        }
        // 2. Se for um registo do seeder e a marca for BMW, usa a sua foto 'bmw.jpg'
        elseif (str_contains(strtolower($viatura->marca), 'bmw')) {
            $imagemFinal = asset('fotos/bmw.jpg');
        }
        // 3. Caso contrário, distribui as suas fotos 'carro2.jpg' a 'carro7.jpg' rotativamente pelos carros
        else {
            $numeroFoto = ($viatura->id % 6) + 2; // Gera um número entre 2 e 7 com base no ID
            $imagemFinal = asset("fotos/carro{$numeroFoto}.jpg");
        }
    @endphp

    <img src="{{ $imagemFinal }}"
         alt="{{ $viatura->modelo }}"
         class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700">

    <!-- Badge de Disponibilidade Superior -->
    <div class="absolute top-4 right-4 bg-black/85 border border-white/10 px-3 py-1 font-mono text-[9px] tracking-widest text-aether-blue uppercase rounded-sm">
        {{ $viatura->estado ?? 'AVAILABLE' }}
    </div>
</div>


                <!-- Detalhes do Automóvel -->
                <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex justify-between items-start mb-2 gap-2">
                            <span class="font-mono text-[10px] uppercase tracking-wider text-aether-gray truncate">{{ $viatura->marca }}</span>
                            <span class="font-mono text-sm text-aether-blue font-bold whitespace-nowrap">{{ number_format($viatura->preco, 0, ',', '.') }} €</span>
                        </div>
                        <h3 class="font-sora text-base font-bold text-white uppercase tracking-tight truncate leading-tight">
                            {{ $viatura->modelo }}
                        </h3>
                    </div>

                    <!-- Ficha Técnica Rápida Unificada (Ícones isolados em tags independentes) -->
                    <div class="flex flex-wrap gap-4 border-t border-b border-white/5 py-3 text-xs font-mono text-aether-gray uppercase tracking-wider">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-white/30" style="font-size: 16px;">speed</span>
                            {{ number_format($viatura->quilometros, 0, ',', '.') }} KM
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-white/30" style="font-size: 16px;">Tipo de combustivel</span>
                            {{ $viatura->combustivel ?? 'Gasolina' }}
                        </span>
                    </div>

                    <!-- Rodapé do Cartão com Ícone Corrigido -->
                    <div class="flex justify-between items-center pt-1 font-mono text-[11px] tracking-wider">
                        <span class="text-white/40">{{ $viatura->ano ?? '2026' }} MODEL</span>
                        <a href="{{ route('viaturas.show', $viatura->id) }}" class="block text-center w-auto text-xs uppercase tracking-widest text-white hover:text-aether-blue transition-colors flex items-center gap-1">
                            VIEW DETAILS <span class="material-symbols-outlined text-xs text-white group-hover:text-aether-blue" style="font-size: 14px;">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full border border-dashed border-white/10 p-16 text-center text-aether-gray font-mono text-xs uppercase tracking-widest rounded-lg">
                <span class="material-symbols-outlined text-4xl text-white/10 block mb-3">directions_car</span>
                No vehicles matching your current selection.
            </div>
            @endforelse
        </div>
    </section>
</div>

@endsection
