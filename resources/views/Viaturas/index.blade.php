@extends('layouts.app')

@section('title', 'Showroom | SS AUTOMÓVEIS')

@section('content')
{{-- Configuração Local da Palete AETHER para injetar no Tailwind compilado --}}
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "surface-dim": "#131313",
                    "on-surface-variant": "#c4c5d9",
                    "outline": "#8e90a2",
                    "primary": "#b8c3ff",
                    "on-primary": "#002388",
                    "surface-container": "#201f1f",
                    "surface-container-lowest": "#0e0e0e",
                    "on-surface": "#e5e2e1",
                }
            }
        }
    }
</script>

<style>
    input[type="range"]::-webkit-slider-thumb {
        appearance: none;
        width: 16px;
        height: 16px;
        background: #b8c3ff;
        cursor: pointer;
        border-radius: 50%;
    }
    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
</style>

<div class="pt-10 pb-24 max-w-[1440px] mx-auto px-6 md:px-20 min-h-screen">

    <!-- Cabeçalho Principal (Estilo Headline-AETHER) -->
    <header class="mb-12">
        <h1 class="text-4xl md:text-7xl font-bold tracking-tighter uppercase text-white mb-2" style="font-family: Sora, sans-serif;">
            THE <span class="font-normal text-[#8e90a2]">SHOWROOM.</span>
        </h1>
        <p class="text-sm md:text-base max-w-xl text-[#c4c5d9] font-light">
            Explore a nossa coleção exclusiva de veículos de alta performance. Engenharia de precisão selecionada para condutores exigentes.
        </p>
    </header>

    <!-- Layout Dividido: Filtros à Esquerda, Lista à Direita -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 items-start">

        <!-- PAINEL DE FILTROS (Formulário GET) -->
        <aside class="glass-card p-6 rounded-sm space-y-6">
            <div class="flex items-center justify-between border-b border-white/5 pb-4">
                <h2 class="font-mono text-xs font-bold uppercase tracking-widest text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">tune</span> FILTRAR FROTA
                </h2>
                <a href="{{ route('viaturas.index') }}" class="font-mono text-[10px] uppercase tracking-wider text-[#8e90a2] hover:text-white transition-colors">Limpar</a>
            </div>

            <form action="{{ route('viaturas.index') }}" method="GET" class="space-y-6">
                {{-- Filtro de Marca --}}
                <div class="flex flex-col gap-2">
                    <label class="font-mono text-[10px] uppercase tracking-wider text-[#8e90a2]">Marca</label>
                    <input type="text" name="marca" value="{{ request('marca') }}" placeholder="Ex: BMW, Porsche..."
                           class="w-full bg-[#0e0e0e] border border-white/10 p-3 text-xs text-white focus:border-[#b8c3ff] focus:outline-none">
                </div>

                {{-- Filtro de Combustível --}}
                <div class="flex flex-col gap-2">
                    <label class="font-mono text-[10px] uppercase tracking-wider text-[#8e90a2]">Combustível</label>
                    <select name="combustivel" class="w-full bg-[#0e0e0e] border border-white/10 p-3 text-xs text-white focus:border-[#b8c3ff] focus:outline-none">
                        <option value="">Todos os tipos</option>
                        <option value="Diesel" {{ request('combustivel') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Gasolina" {{ request('combustivel') == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                        <option value="Híbrido" {{ request('combustivel') == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                        <option value="Elétrico" {{ request('combustivel') == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                    </select>
                </div>

                {{-- Filtro de Preço Máximo Slider --}}
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between font-mono text-[10px] uppercase text-[#8e90a2]">
                        <span>Preço Máximo</span>
                        <span class="text-white" id="price-display">{{ number_format(request('preco_max', 150000), 0, ',', '.') }} €</span>
                    </div>
                    <input type="range" name="preco_max" min="5000" max="250000" step="5000"
                           value="{{ request('preco_max', 150000) }}" id="price-slider"
                           class="w-full accent-[#b8c3ff] bg-white/10 h-1 rounded-lg appearance-none cursor-pointer">
                </div>

                <button type="submit" class="w-full py-3 bg-white text-black font-mono font-bold text-[10px] tracking-widest uppercase hover:bg-[#b8c3ff] transition-colors duration-300">
                    APLICAR FILTROS
                </button>
            </form>
        </aside>

        <!-- GRID DE PRODUTOS/VIATURAS -->
        <div class="lg:col-span-3 space-y-6">
            <div class="flex items-center justify-between text-xs font-mono text-[#8e90a2] border-b border-white/5 pb-4">
                <span>A MOSTRAR {{ $viaturas->count() }} VIATURAS DISPONÍVEIS</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($viaturas as $viatura)
                    <div class="glass-card flex flex-col overflow-hidden group relative rounded-sm transition-all duration-500 hover:-translate-y-2 hover:border-[#b8c3ff]/30">

                        {{-- Foto do Veículo --}}
                        <div class="relative h-56 overflow-hidden bg-[#0e0e0e]">
                            <img src="{{ $viatura->foto ? asset('fotos/' . $viatura->foto) : asset('fotos/fachada-stand.jpg') }}"
                                 alt="{{ $viatura->marca }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0 contrast-115 brightness-95"/>

                            {{-- Botão de Coração Funcional da Garagem --}}
                            @auth
                                <form action="{{ route('favoritos.toggle', $viatura->id) }}" method="POST" class="absolute top-4 right-4 z-10">
                                    @csrf
                                    <button type="submit" class="p-2.5 rounded-full bg-[#0e0e0e]/70 text-white hover:text-rose-500 transition-colors duration-300">
                                        <i class="bi {{ auth()->user()->favorites->contains($viatura->id) ? 'bi-heart-fill text-rose-500' : 'bi-heart' }} text-sm"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>

                        {{-- Info Detalhes --}}
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-lg font-bold text-white uppercase tracking-tight" style="font-family: Sora, sans-serif;">
                                    {{ $viatura->marca }} <span class="font-normal text-[#8e90a2]">{{ $viatura->modelo }}</span>
                                </h3>
                                <p class="font-mono text-sm font-bold tracking-wider mt-1 text-[#b8c3ff]">
                                    {{ number_format($viatura->preco ?? $viatura->preco_venda ?? 0, 0, ',', '.') }} €
                                </p>
                            </div>

                            {{-- Especificações Técnicas em Grid Estilo Aether --}}
                            <div class="grid grid-cols-3 border-t border-white/5 pt-4 gap-2 text-left">
                                <div class="flex flex-col">
                                    <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Ano</span>
                                    <span class="text-xs font-bold text-white">{{ $viatura->ano }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Kms</span>
                                    <span class="text-xs font-bold text-white truncate">
                                        {{ number_format($viatura->kms ?? $viatura->quilometragem ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Energia</span>
                                    <span class="text-xs font-bold text-white truncate uppercase text-[11px]">{{ $viatura->combustivel }}</span>
                                </div>
                            </div>

                            {{-- Link de Ação para Marcação Direta --}}
                            <a href="{{ route('visitas.create', ['viatura_id' => $viatura->id]) }}"
                               class="w-full text-center py-3 block text-[10px] font-mono font-bold uppercase tracking-widest text-black bg-white hover:bg-[#b8c3ff] transition-colors duration-300">
                                SOLICITAR TEST DRIVE
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full border border-dashed border-white/10 py-16 px-4 text-center rounded-sm bg-[#0e0e0e]/40">
                @endforelse
            </div>
        </div>

    </div>
</div>

{{-- Script em tempo real para o slider --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const slider = document.getElementById('price-slider');
        const display = document.getElementById('price-display');

        if(slider && display) {
            slider.addEventListener('input', function() {
                const val = parseInt(this.value).toLocaleString('pt-PT');
                display.textContent = val + ' €';
            });
        }
    });
</script>
@endsection {{-- <- GARANTA QUE ESTA LINHA ESTÁ AQUI NO FIM DO FICHEIRO --}}
