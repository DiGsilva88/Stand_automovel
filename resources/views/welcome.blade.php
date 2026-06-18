@extends('layouts.app')

@section('title', 'SS Automóveis — Distinção Absoluta')

@section('content')

{{-- Ajustes estruturais locais para o tema escuro premium --}}
<style>
    main { max-width: 100% !important; padding: 0 !important; margin-top: -1rem !important; }
    body { background-color: #131313; color: #e5e2e1; }
    .glass-card {
        background: rgba(32, 31, 31, 0.4);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .glass-card:hover {
        border-color: rgba(184, 195, 255, 0.3) !important;
        background: rgba(46, 91, 255, 0.05) !important;
        transform: translateY(-8px);
    }
    .hero-vignette {
        background: radial-gradient(circle, rgba(0,0,0,0) 0%, rgba(19,19,19,1) 85%);
    }
    /* Força a ocultação das barras de scroll mas mantém o deslize ativo */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- ============ PRIMEIRO CONTENTOR: HERO SECTION COM VÍDEO DE FUNDO ============ -->
<section class="relative min-h-[calc(100vh-80px)] w-full flex items-center overflow-hidden">

    <!-- Vídeo de Fundo Automático e em Loop (Cinemático) -->
    <div class="absolute inset-0 z-0">
        <video autoplay loop muted playsinline class="w-full h-full object-cover grayscale contrast-125 brightness-50">
            <source src="{{ asset('videos/hero-background.mp4') }}" type="video/mp4">
            <!-- Fallback caso o navegador bloqueie o vídeo -->
            <img src="{{ asset('fotos/fachada-stand.jpg') }}" class="w-full h-full object-cover grayscale brightness-50"/>
        </video>
        <div class="absolute inset-0 hero-vignette"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0e0e0e] via-[#0e0e0e]/60 to-transparent"></div>
    </div>

    <!-- Conteúdo de Texto Superior -->
    <div class="relative z-10 px-6 md:px-20 w-full max-w-[1440px] mx-auto">
        <div class="max-w-2xl space-y-6">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full inline-block animate-pulse bg-[#b8c3ff]"></span>
                <span class="font-mono text-[11px] font-bold tracking-[0.25em] uppercase text-[#b8c3ff]">
                    O FUTURO DA PERFORMANCE
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-bold tracking-tighter leading-[1.05] uppercase text-white" style="font-family: Sora, sans-serif;">
                DISTINÇÃO <br>
                <span class="font-normal text-[#8e90a2]">ABSOLUTA.</span>
            </h1>

            <p class="text-sm md:text-base leading-relaxed max-w-md text-[#c4c5d9]">
                Onde o prestígio automóvel encontra a precisão absoluta. Cada viatura no nosso stand é selecionada para quem exige excelência em cada detalhe.
            </p>

            <div class="flex flex-wrap gap-4 pt-4 font-mono text-xs uppercase tracking-widest font-bold">
                <a href="{{ route('viaturas.index') }}" class="px-8 py-4 text-center min-w-[170px] transition-all duration-300 bg-[#2e5bff] text-[#efefff]">
                    VER VIATURAS
                </a>
                <a href="{{ route('visitas.create') }}" class="border px-8 py-4 text-center min-w-[170px] transition-all duration-300 text-white hover:bg-white/5 border-white/15">
                    AGENDAR TEST DRIVE
                </a>
            </div>
        </div>
    </div>

    <!-- Indicador de Scroll Minimalista -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[9px] font-mono tracking-widest text-white/30 animate-bounce">
        <span>EXPLORE</span>
        <span class="material-symbols-outlined text-sm text-[#b8c3ff]">keyboard_arrow_down</span>
    </div>
</section>


<!-- ============ SEGUNDO CONTENTOR: VÍDEO DA VIATURA DE DESTAQUE EM ECRÃ TOTAL ============ -->
<section class="relative w-full h-[60vh] md:h-[80vh] flex items-center overflow-hidden border-y border-white/5">

    <!-- Vídeo do Porsche em loop e ajustado ao contentor -->
    <div class="absolute inset-0 z-0">
        <video autoplay loop muted playsinline class="w-full h-full object-cover contrast-115 brightness-40 grayscale hover:grayscale-0 transition-all duration-1000">
            <source src="{{ asset('videos/porsche-video-path.mp4') }}" type="video/mp4">
            <img src="{{ asset('fotos/porsche-911.jpg') }}" class="w-full h-full object-cover brightness-40"/>
        </video>
        <div class="absolute inset-0 bg-gradient-to-t from-[#131313] via-transparent to-[#131313]/80"></div>
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <!-- Banner Informativo Sobreposto -->
    <div class="relative z-10 px-6 md:px-20 w-full max-w-[1440px] mx-auto flex justify-end">
        <div class="glass-card p-8 md:p-10 max-w-md space-y-4 rounded-sm border-white/10 bg-black/60 backdrop-blur-md">
            <span class="font-mono text-[9px] uppercase tracking-[0.2em] text-[#b8c3ff] font-bold block">DESTAQUE DA SEMANA</span>
            <h2 class="text-2xl md:text-3xl font-bold text-white uppercase tracking-tight" style="font-family: Sora, sans-serif;">
                PORSCHE 911 CARRERA S
            </h2>
            <p class="text-xs text-[#c4c5d9] leading-relaxed">
                A lenda dos circuitos adaptada para a estrada. Sinta a engenharia alemã pura com motor boxer de 450 cv e aceleração dos 0 aos 100 km/h em apenas 3,7 segundos.
            </p>
            <div class="pt-2 flex items-center justify-between">
                <span class="font-mono text-sm font-bold text-white">164.900 €</span>
                <a href="{{ route('visitas.create') }}" class="font-mono text-[10px] uppercase tracking-wider bg-white text-black px-4 py-2.5 font-bold hover:bg-[#b8c3ff] transition-colors">
                    SOLICITAR PROPOSTA
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ============ TERCEIRO CONTENTOR: CARROSSEL HORIZONTAL DESLIZANTE ============ -->
<section class="px-6 md:px-20 py-24 max-w-[1440px] mx-auto space-y-10">

    <div class="flex flex-col md:flex-row justify-between items-end gap-4">
        <div class="space-y-2">
            <h2 class="text-2xl md:text-4xl font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">
                ÚLTIMAS ENTRADAS EM STOCK
            </h2>
            <div class="h-0.5 w-20 bg-[#b8c3ff]"></div>
        </div>
        <a href="{{ route('viaturas.index') }}" class="font-mono text-[11px] uppercase tracking-widest flex items-center gap-2 text-[#8e90a2] hover:text-white transition-colors group">
            VER CATÁLOGO COMPLETO
            <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
        </a>
    </div>

    <!-- Carrossel Deslizante de Viaturas -->
    <div class="flex overflow-x-auto snap-x snap-mandatory gap-8 pb-6 no-scrollbar scroll-smooth">

        @forelse($viaturasExibicao ?? [] as $v)
            <div class="glass-card flex flex-col overflow-hidden group min-w-[85vw] md:min-w-[45vw] lg:min-w-[28vw] snap-start rounded-sm">

                <div class="relative h-60 overflow-hidden bg-[#0e0e0e]">
                    <img src="{{ $v->foto ? asset('fotos/' . $v->foto) : asset('fotos/fachada-stand.jpg') }}" alt="{{ $v->marca }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0 contrast-110"/>
                    <div class="absolute top-4 right-4 backdrop-blur-md px-3 py-1 border border-white/10 font-mono text-[9px] uppercase tracking-wider bg-black/60 text-[#e5e2e1]">
                        {{ $v->estado ?? 'Disponível' }}
                    </div>
                </div>

                <div class="p-6 space-y-4 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-white uppercase tracking-tight" style="font-family: Sora, sans-serif;">
                            {{ $v->marca }} <span class="font-light text-[#8e90a2]">{{ $v->modelo }}</span>
                        </h3>
                        <p class="font-mono text-sm font-bold tracking-widest mt-1 text-[#b8c3ff]">
                            {{ number_format($v->preco ?? 0, 0, ',', '.') }} €
                        </p>
                    </div>

                    <div class="grid grid-cols-3 border-t border-white/5 pt-4 gap-2">
                        <div class="flex flex-col">
                            <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Ano</span>
                            <span class="text-xs font-bold text-white">{{ $v->ano }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Kms</span>
                            <span class="text-xs font-bold text-white truncate">
                                {{ number_format($v->quilometros ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Energia</span>
                            <span class="text-xs font-bold text-white uppercase truncate text-[11px]">{{ $v->combustivel }}</span>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            @foreach([
                ['M4 Competition Coupe', 'BMW', '118.500', '2023', 'bmw-m4.jpg'],
                ['911 Carrera S', 'Porsche', '164.900', '2022', 'porsche-911.jpg'],

                ['RS6 Avant Performance', 'Audi', '189.900', '2024', 'audi-rs6.jpg']
            ] as $carroDummy)
                <div class="glass-card flex flex-col overflow-hidden group min-w-[85vw] md:min-w-[45vw] lg:min-w-[28vw] snap-start rounded-sm">

                    {{-- Foto do Veículo --}}
                    <div class="relative h-60 overflow-hidden bg-[#0e0e0e]">
                        <img src="{{ asset('fotos/' . $carroDummy[4]) }}" alt="Carro de Exposição"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0 contrast-110"/>
                        <div class="absolute top-4 right-4 backdrop-blur-md px-3 py-1 border border-white/10 font-mono text-[9px] uppercase tracking-wider bg-black/60 text-[#e5e2e1]">
                            Exposição
                        </div>
                    </div>

                    {{-- Detalhes Técnicos --}}
                    <div class="p-6 space-y-4 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-white uppercase tracking-tight" style="font-family: Sora, sans-serif;">
                                {{ $carroDummy[1] }} <span class="font-normal text-[#8e90a2]">{{ $carroDummy[0] }}</span>
                            </h3>
                            <p class="font-mono text-sm font-bold tracking-widest mt-1 text-[#b8c3ff]">
                                {{ $carroDummy[2] }} €
                            </p>
                        </div>

                        {{-- Grelha de Especificações --}}
                        <div class="grid grid-cols-3 border-t border-white/5 pt-4 gap-2 text-left">
                            <div class="flex flex-col">
                                <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Ano</span>
                                <span class="text-xs font-bold text-white">{{ $carroDummy[3] }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Kms</span>
                                <span class="text-xs font-bold text-white">15.000</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-mono text-[9px] uppercase text-[#8e90a2]">Energia</span>
                                <span class="text-xs font-bold text-white uppercase truncate text-[11px]">Gasolina</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @endforelse

    </div>
</section>

@endsection
