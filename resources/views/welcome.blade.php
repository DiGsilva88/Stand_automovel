@extends('layouts.app')

@section('title', 'SS Automóveis — Distinção Absoluta')

@section('content')

{{-- Remove os paddings extra do contentor principal nesta página para o hero ocupar o ecrã total --}}
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
        border-color: rgba(184, 195, 255, 0.3);
        background: rgba(46, 91, 255, 0.05);
        transform: translateY(-8px);
    }
    .hero-vignette {
        background: radial-gradient(circle, rgba(0,0,0,0) 0%, rgba(19,19,19,1) 85%);
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- ============ HERO SECTION ============ -->
<section class="relative min-h-[calc(100vh-80px)] w-full flex items-center overflow-hidden">

    <!-- Imagem de fundo (foto real do stand, escurecida e em tom dramático) -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('fotos/fachada-stand.jpg') }}" alt="SS Automóveis"
             class="w-full h-full object-cover grayscale contrast-125 brightness-50"/>
        <div class="absolute inset-0 hero-vignette"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0e0e0e] via-[#0e0e0e]/60 to-transparent"></div>
    </div>

    <!-- Conteúdo de texto -->
    <div class="relative z-10 px-6 md:px-20 w-full max-w-[1440px] mx-auto">
        <div class="max-w-2xl space-y-6">

            <!-- Eyebrow -->
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full inline-block animate-pulse" style="background:#b8c3ff;"></span>
                <span class="font-mono text-[11px] font-bold tracking-[0.25em] uppercase" style="color:#b8c3ff;">
                    O FUTURO DA PERFORMANCE
                </span>
            </div>

            <!-- Título -->
            <h1 class="text-5xl md:text-7xl font-bold tracking-tighter leading-[1.05] uppercase text-white"
                style="font-family: Sora, sans-serif;">
                DISTINÇÃO <br>
                <span class="font-normal" style="color:#8e90a2;">ABSOLUTA.</span>
            </h1>

            <!-- Subtítulo -->
            <p class="text-sm md:text-base leading-relaxed max-w-md" style="color:#c4c5d9;">
                Onde o prestígio automóvel encontra a precisão absoluta. Cada viatura no nosso stand é
                selecionada para quem exige excelência em cada detalhe.
            </p>

            <!-- Botões de ação -->
            <div class="flex flex-wrap gap-4 pt-4 font-mono text-xs uppercase tracking-widest font-bold">
                <a href="{{ route('viaturas.index') }}"
                   class="px-8 py-4 text-center min-w-[170px] transition-all duration-300"
                   style="background:#2e5bff; color:#efefff;">
                    VER VIATURAS
                </a>
                <a href="{{ route('login') }}"
                   class="border px-8 py-4 text-center min-w-[170px] transition-all duration-300 text-white hover:bg-white/5"
                   style="border-color: rgba(255,255,255,0.15);">
                    AGENDAR TEST DRIVE
                </a>
            </div>
        </div>
    </div>

    <!-- Indicador de scroll -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[9px] font-mono tracking-widest text-white/30 animate-bounce">
        <span>EXPLORE</span>
        <svg class="w-4 h-4" style="color:#b8c3ff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>
</section>

<!-- ============ FEATURED ARRIVALS ============ -->
<section class="px-6 md:px-20 py-24 max-w-[1440px] mx-auto">

    <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
        <div class="space-y-2">
            <h2 class="text-3xl md:text-4xl font-bold text-white" style="font-family: Sora, sans-serif;">
                VIATURAS EM DESTAQUE
            </h2>
            <div class="h-1 w-24" style="background:#b8c3ff;"></div>
        </div>
        <a href="{{ route('viaturas.index') }}"
           class="font-mono text-[11px] uppercase tracking-widest flex items-center gap-2 transition-colors group"
           style="color:#8e90a2;">
            VER CATÁLOGO COMPLETO
            <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
        </a>
    </div>

    <!-- Carrossel horizontal de viaturas -->
    <div class="flex overflow-x-auto snap-x snap-mandatory gap-8 pb-6 no-scrollbar scroll-smooth">

        <!-- Carro 1 -->
        <div class="glass-card flex flex-col overflow-hidden group min-w-[85vw] md:min-w-[45vw] lg:min-w-[30vw] snap-start">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('fotos/carro2.jpg') }}" alt="Viatura em destaque"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
                <div class="absolute top-4 right-4 backdrop-blur-md px-3 py-1 border border-white/10 font-mono text-[10px] uppercase"
                     style="background: rgba(19,19,19,0.8); color:#e5e2e1;">
                    Disponível
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <h3 class="text-xl font-bold text-white" style="font-family: Sora, sans-serif;">BMW SÉRIE 3</h3>
                    <p class="font-mono text-[12px] tracking-widest" style="color:#b8c3ff;">42.500 €</p>
                </div>
                <div class="grid grid-cols-3 border-t pt-4 gap-2" style="border-color: rgba(255,255,255,0.08);">
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Ano</span>
                        <span class="text-sm font-bold text-white">2023</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Km</span>
                        <span class="text-sm font-bold text-white">18.000</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Combustível</span>
                        <span class="text-sm font-bold text-white">DIESEL</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carro 2 -->
        <div class="glass-card flex flex-col overflow-hidden group min-w-[85vw] md:min-w-[45vw] lg:min-w-[30vw] snap-start">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('fotos/bmw.jpg') }}" alt="Viatura em destaque"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
                <div class="absolute top-4 right-4 backdrop-blur-md px-3 py-1 border border-white/10 font-mono text-[10px] uppercase"
                     style="background: rgba(19,19,19,0.8); color:#e5e2e1;">
                    Novidade
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <h3 class="text-xl font-bold text-white" style="font-family: Sora, sans-serif;">BMW M4 COMPETITION</h3>
                    <p class="font-mono text-[12px] tracking-widest" style="color:#b8c3ff;">89.900 €</p>
                </div>
                <div class="grid grid-cols-3 border-t pt-4 gap-2" style="border-color: rgba(255,255,255,0.08);">
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Ano</span>
                        <span class="text-sm font-bold text-white">2024</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Km</span>
                        <span class="text-sm font-bold text-white">2.300</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Combustível</span>
                        <span class="text-sm font-bold text-white">GASOLINA</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carro 3 -->
        <div class="glass-card flex flex-col overflow-hidden group min-w-[85vw] md:min-w-[45vw] lg:min-w-[30vw] snap-start">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('fotos/Opel.jpg') }}" alt="Viatura em destaque"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <h3 class="text-xl font-bold text-white" style="font-family: Sora, sans-serif;">OPEL ASTRA</h3>
                    <p class="font-mono text-[12px] tracking-widest" style="color:#b8c3ff;">18.450 €</p>
                </div>
                <div class="grid grid-cols-3 border-t pt-4 gap-2" style="border-color: rgba(255,255,255,0.08);">
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Ano</span>
                        <span class="text-sm font-bold text-white">2021</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Km</span>
                        <span class="text-sm font-bold text-white">45.200</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[10px] uppercase" style="color:#8e90a2;">Combustível</span>
                        <span class="text-sm font-bold text-white">DIESEL</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ============ QUOTE SECTION ============ -->
<section class="py-24 overflow-hidden" style="background:#0e0e0e;">
    <div class="px-6 md:px-20 max-w-[1440px] mx-auto relative">
        <div class="absolute -top-16 -left-4 text-[160px] font-bold text-white/5 pointer-events-none select-none"
             style="font-family: Sora, sans-serif;">"</div>
        <div class="relative z-10 space-y-6">
            <p class="text-2xl md:text-4xl leading-snug italic max-w-4xl text-white font-bold"
               style="font-family: Sora, sans-serif;">
                "NÃO VENDEMOS APENAS VIATURAS; CURAMOS O ENCONTRO ENTRE MOVIMENTO E PRECISÃO."
            </p>
            <div class="flex items-center gap-4">
                <div class="w-12 h-[1px]" style="background:#b8c3ff;"></div>
                <span class="font-mono text-[11px] uppercase tracking-widest" style="color:#c4c5d9;">
                    FILOSOFIA SS AUTOMÓVEIS
                </span>
            </div>
        </div>
    </div>
</section>

<!-- ============ PARTNER BRANDS ============ -->
<section class="py-24 px-6 md:px-20 border-t" style="background:#131313; border-color: rgba(255,255,255,0.05);">
    <div class="max-w-[1440px] mx-auto space-y-10">
        <h2 class="text-center font-mono text-[11px] uppercase tracking-widest" style="color:#8e90a2;">
            MARCAS QUE TRABALHAMOS
        </h2>
        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20">

            <div class="h-10 flex items-center opacity-50 hover:opacity-100 transition-all duration-300">
                <span class="text-2xl font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">BMW</span>
            </div>
            <div class="h-10 flex items-center opacity-50 hover:opacity-100 transition-all duration-300">
                <span class="text-2xl font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">OPEL</span>
            </div>
            <div class="h-10 flex items-center opacity-50 hover:opacity-100 transition-all duration-300">
                <span class="text-2xl font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">AUDI</span>
            </div>
            <div class="h-10 flex items-center opacity-50 hover:opacity-100 transition-all duration-300">
                <span class="text-2xl font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">MERCEDES-BENZ</span>
            </div>
            <div class="h-10 flex items-center opacity-50 hover:opacity-100 transition-all duration-300">
                <span class="text-2xl font-bold text-white tracking-tight" style="font-family: Sora, sans-serif;">VOLKSWAGEN</span>
            </div>

        </div>
    </div>
</section>

@endsection
