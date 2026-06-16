@extends('layouts.app')

@section('title', 'SS MOTORS — Distinção Absoluta')

@section('content')

<!-- Removemos os paddings extras do contentor principal nesta página para o vídeo ocupar o ecrã total -->
<style>
    main { max-width: 100% !important; padding: 0 !important; }
</style>

<div class="relative min-h-[calc(100vh-80px)] -mt-12 flex flex-col justify-center items-start px-6 md:px-20 overflow-hidden">

    <!-- Vídeo de Fundo Premium Estabilizado (Ficheiro MP4 Direto e Leve) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
        <video autoplay loop muted playsinline
               class="w-full h-full object-cover opacity-35 filter grayscale brightness-75 contrast-125">
            <source src="https://mixkit.co" type="video/mp4">
        </video>

        <!-- Máscaras de degradê para fusão cirúrgica com o fundo preto #0e0e0e -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#0e0e0e] via-[#0e0e0e]/70 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0e0e0e] via-transparent to-[#0e0e0e]"></div>
    </div>

    <!-- Conteúdo de Texto Alinhado à Identidade Aether (Z-Index Protegido) -->
    <div class="relative z-10 max-w-xl space-y-6">

        <!-- Eyebrow Corporativo -->
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 bg-aether-blue rounded-full inline-block animate-pulse"></span>
            <span class="font-mono text-[10px] font-bold tracking-[0.3em] text-aether-blue uppercase">
                O Futuro da Performance
            </span>
        </div>

        <!-- Título Principal em Letras Garrafais Sora -->
        <h1 class="text-5xl md:text-7xl font-bold tracking-tighter text-white leading-[1.05] font-sora uppercase">
            DISTINÇÃO <br> <span class="text-aether-gray font-normal">ABSOLUTA.</span>
        </h1>

        <!-- Subtítulo de Suporte -->
        <p class="text-sm md:text-base text-aether-gray leading-relaxed font-sans normal-case max-w-md">
            Onde o prestígio automóvel encontra a distinção absoluta. Desenvolvido para entusiastas de dinâmica de condução pura.
        </p>

        <!-- Botões de Ação Funcionais Retangulares (Sem cantos redondos de estilo bootstrap) -->
        <div class="flex flex-wrap gap-4 pt-4 font-mono text-xs uppercase tracking-widest font-bold relative z-20">
            <a href="{{ route('viaturas.index') }}"
               class="bg-aether-electric hover:bg-aether-blue text-white hover:text-aether-dark-blue font-semibold px-8 py-4 rounded-sm transition-all duration-300 text-center min-w-[170px] shadow-lg shadow-aether-electric/10">
                Ver Viaturas
            </a>
            <a href="{{ route('visitas.create') }}"
               class="border border-white/10 text-white font-medium px-8 py-4 rounded-sm hover:border-white hover:bg-white/5 transition-all duration-300 text-center min-w-[170px]">
                Agendar Test Drive
            </a>
        </div>
    </div>

    <!-- Indicador Inferior Minimalista (Explore Scroll) -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[9px] font-mono tracking-widest text-white/20 animate-pulse">
        <span>EXPLORE</span>
        <svg class="w-4 h-4 text-aether-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>

</div>

@endsection
