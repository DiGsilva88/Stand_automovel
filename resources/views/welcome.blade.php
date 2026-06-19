@extends('layouts.app')

@section('title', 'SS MOTORS — Distinção Absoluta')

@section('content')

<style>
    /* Força o conteúdo a ocupar a largura total do ecrã para o efeito imersivo */
    main { max-width: 100% !important; padding: 0 !important; margin: 0 !important; }

    /* Definição das novas cores do tema configuradas no cabeçalho */
    :root {
        --color-primary: #b8c3ff;
        --color-surface-dim: #131313;
        --color-outline: #8e90a2;
        --color-on-surface-variant: #c4c5d9;
    }

    /* Cartões com opacidade escura para isolar e dar destaque ao tom real da imagem */
    .glass-card {
        background: rgba(20, 19, 19, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .glass-card:hover {
        border-color: rgba(184, 195, 255, 0.3);
        background: rgba(46, 91, 255, 0.02);
        transform: translateY(-8px);
    }
    .hero-vignette {
        background: linear-gradient(to top, #131313 5%, rgba(19,19,19,0.2) 60%, rgba(19,19,19,0.8) 100%);
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Garante fidelidade de cor sem pós-processamento do browser */
    .car-image-real {
        mix-blend-mode: normal;
        object-fit: cover;
    }
</style>

<!-- ================================================== -->
<!-- HERO SECTION (Card com imagem de fundo)             -->
<!-- ================================================== -->
<section class="px-6 md:px-20 pt-28 md:pt-36 pb-12 max-w-[1440px] mx-auto">

    <div class="relative rounded-sm overflow-hidden border border-white/5 min-h-[560px] md:min-h-[680px] flex items-center">

        <!-- Imagem de fundo do card -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('fotos/astonmartinwallpaperjpg.jpg') }}"
                 alt="Aston Martin"
                 class="w-full h-full object-cover car-image-real">
            <div class="absolute inset-0 bg-gradient-to-r from-[#131313]/95 via-[#131313]/50 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#131313]/70 via-transparent to-transparent"></div>
        </div>

        <!-- Texto sobreposto -->
        <div class="relative z-10 p-8 md:p-16 max-w-2xl space-y-8">
            <div class="space-y-4">
                <span class="font-mono text-xs text-[#b8c3ff] uppercase tracking-[0.3em] block flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-[#b8c3ff] rounded-full inline-block animate-pulse"></span>
                    Engineered Luxury
                </span>
                <h1 class="text-5xl md:text-7xl font-bold text-white leading-none tracking-tighter uppercase" style="font-family: 'Sora', sans-serif;">
                    THE ART OF<br><span class="text-[#8e90a2] font-light">PRECISION.</span>
                </h1>
            </div>
            <p class="text-[#c4c5d9] text-sm md:text-base max-w-lg leading-relaxed font-light">
                Onde o prestígio automóvel encontra a engenharia de alta performance. Uma coleção rigorosamente selecionada para condutores exigentes.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                <a href="{{ route('viaturas.index') }}"
                   class="bg-[#b8c3ff] hover:bg-white text-[#002388] px-8 py-4 font-mono text-xs uppercase tracking-widest font-bold transition-all duration-300 rounded-sm">
                    Ver Viaturas
                </a>
                <a href="{{ route('visitas.create') }}"
                   class="border border-white/20 hover:border-white/50 text-white px-8 py-4 font-mono text-xs uppercase tracking-widest font-bold transition-all duration-300 rounded-sm hover:bg-white/5">
                    Agendar Test Drive
                </a>
            </div>
        </div>

        <!-- Indicador de scroll -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce opacity-30 z-10">
            <span class="font-mono text-[9px] tracking-widest uppercase text-white">Explore</span>
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>

    </div>
</section>
<!-- ================================================== -->
<!-- MARCAS PARCEIRAS  -->
<!-- ================================================== -->
<section class="py-16 px-6 md:px-20 border-t border-b border-white/5 bg-[#131313] relative z-20">
    <div class="max-w-[1440px] mx-auto space-y-12">

        <h2 class="text-center font-mono text-[10px] uppercase tracking-[0.3em] text-[#8e90a2]">
            Marcas em Showroom
        </h2>

        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24">
            @php
    $marcas = [
        ['nome' => 'BMW',         'logo' => 'bmw.svg'],
        ['nome' => 'Mercedes',    'logo' => 'mercedes.jpg'],
        ['nome' => 'Porsche',     'logo' => 'porsche.svg'],
        ['nome' => 'Lamborghini', 'logo' => 'lamborghini.svg'],
        ['nome' => 'Ferrari',     'logo' => 'ferrari.svg'],
        ['nome' => 'Tesla',     'logo' => 'tesla.svg'],
        ['nome' => 'Audi',     'logo' => 'audi.svg'],



    ];
@endphp

@foreach($marcas as $marca)
<a href="{{ route('viaturas.index', ['marca' => $marca['nome']]) }}"
   class="h-10 flex items-center justify-center opacity-50 hover:opacity-100 transition-all duration-300 group">

    <img src="{{ asset('fotos/logo/' . $marca['logo']) }}"
         alt="{{ $marca['nome'] }}"
          class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-110 brightness-0 invert">
</a>
@endforeach
        </div>

    </div>
</section>
<!-- ================================================== -->
<!-- DUO DE VIATURAS (2 imagens em destaque)             -->
<!-- ================================================== -->
<section class="px-6 md:px-20 pb-20 max-w-[1440px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <a href="{{ route('viaturas.index') }}" class="relative h-[300px] md:h-[420px] rounded-sm overflow-hidden border border-white/5 group block">
            <img src="{{ asset('fotos\ferrarisetas.jpg') }}"
                 alt="Aston Martin"
                 class="w-full h-full object-cover car-image-real transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-[#131313]/70 via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6 z-10">
                <p class="font-mono text-[10px] text-[#b8c3ff] uppercase tracking-widest font-medium">Ferrari</p>
                <h3 class="text-2xl font-bold text-white uppercase tracking-tight" style="font-family: 'Sora', sans-serif;">DB12</h3>
            </div>
        </a>

        <a href="{{ route('viaturas.index') }}" class="relative h-[300px] md:h-[420px] rounded-sm overflow-hidden border border-white/5 group block">
            <img src="{{ asset('fotos\ferrari.jpg') }}"
                 alt="Substituir pelo nome do segundo carro"
                 class="w-full h-full object-cover car-image-real transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-[#131313]/70 via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6 z-10">
                <p class="font-mono text-[10px] text-[#b8c3ff] uppercase tracking-widest font-medium">Ferrari</p>
                <h3 class="text-2xl font-bold text-white uppercase tracking-tight" style="font-family: 'Sora', sans-serif;">D123</h3>
            </div>
        </a>

    </div>
</section>


<!-- ================================================== -->
<!-- VIATURAS EM DESTAQUE (Carrossel Compacto)          -->
<!-- ================================================== -->
<section class="px-6 md:px-20 py-24 max-w-[1440px] mx-auto bg-[#131313]">

    <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-white/5 pb-6 gap-4">
        <div class="space-y-1">
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase">Coleção Exclusiva</span>
            <h2 class="text-3xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">Viaturas em Destaque</h2>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('viaturas.index') }}"
               class="font-mono text-xs text-[#8e90a2] hover:text-[#b8c3ff] flex items-center gap-2 uppercase tracking-widest transition-colors group">
                Ver todo o catálogo
                <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>

            <!-- Setas de navegação -->
            <div class="hidden md:flex items-center gap-2">
                <button type="button" id="destaques-prev"
                    class="w-9 h-9 flex items-center justify-center border border-white/10 hover:border-[#b8c3ff]/50 hover:bg-[#b8c3ff]/5 text-white transition-all duration-300 rounded-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button type="button" id="destaques-next"
                    class="w-9 h-9 flex items-center justify-center border border-white/10 hover:border-[#b8c3ff]/50 hover:bg-[#b8c3ff]/5 text-white transition-all duration-300 rounded-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="destaques-carousel" class="flex overflow-x-auto snap-x snap-mandatory gap-5 pb-6 no-scrollbar scroll-smooth">

        @php
            $destaques = [
                ['marca' => 'Porsche',    'modelo' => '911 Carrera S',    'preco' => '164.900', 'ano' => '2022', 'km' => '15.000', 'estado' => 'Disponível', 'foto' => 'Porsche-911.jpg'],
                ['marca' => 'BMW',        'modelo' => 'M4 Competition',   'preco' => '118.500', 'ano' => '2023', 'km' => '12.000', 'estado' => 'Disponível', 'foto' => 'BMW-M4.jpg'],
                ['marca' => 'Mercedes',   'modelo' => 'Benz A 250 AMG',   'preco' => '38.900',  'ano' => '2021', 'km' => '42.000', 'estado' => 'Disponível', 'foto' => 'mercedes.jpg'],
                ['marca' => 'Audi',       'modelo' => 'RS6 Avant Perf.',  'preco' => '189.900', 'ano' => '2024', 'km' => '8.000',  'estado' => 'Reservado',  'foto' => 'Audi-RS6.jpg'],
                ['marca' => 'Tesla',      'modelo' => 'Model Roadster','preco' => '46.500',  'ano' => '2023', 'km' => '28.500', 'estado' => 'Disponível', 'foto' => '2020-tesla-roadster.jpg'],
            ];
        @endphp

        @foreach($destaques as $viatura)
        <a href="{{ route('viaturas.index') }}"
           class="glass-card flex flex-col overflow-hidden group min-w-[260px] sm:min-w-[300px] lg:min-w-[320px] snap-start rounded-sm flex-shrink-0">

            <div class="relative h-40 overflow-hidden bg-[#1a1c23]">
                <img src="{{ asset('fotos/' . $viatura['foto']) }}"
                     alt="{{ $viatura['marca'] }} {{ $viatura['modelo'] }}"
                     class="w-full h-full transition-transform duration-700 group-hover:scale-105 car-image-real">

                <div class="absolute top-3 right-3 bg-[#0e0e0e]/90 backdrop-blur-md px-2 py-1 border border-white/10 rounded-sm">
                    <span class="font-mono text-[9px] uppercase tracking-widest font-medium
                        {{ $viatura['estado'] === 'Disponível' ? 'text-[#b8c3ff]' : 'text-[#8e90a2]' }}">
                        {{ $viatura['estado'] }}
                    </span>
                </div>
            </div>

            <div class="p-4 space-y-3">
                <div>
                    <p class="font-mono text-[9px] text-[#b8c3ff] uppercase tracking-widest font-medium">{{ $viatura['marca'] }}</p>
                    <h3 class="text-lg font-bold text-white uppercase tracking-tight mt-1" style="font-family: 'Sora', sans-serif;">
                        {{ $viatura['modelo'] }}
                    </h3>
                    <p class="font-mono text-sm text-[#b8c3ff] font-bold tracking-wider mt-1">
                        {{ $viatura['preco'] }} €
                    </p>
                </div>

                <div class="grid grid-cols-3 border-t border-white/5 pt-3 gap-2">
                    <div class="flex flex-col">
                        <span class="font-mono text-[9px] text-[#8e90a2] uppercase tracking-widest">Ano</span>
                        <span class="text-sm font-bold text-white mt-1" style="font-family: 'Sora', sans-serif;">{{ $viatura['ano'] }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-mono text-[9px] text-[#8e90a2] uppercase tracking-widest">Km</span>
                        <span class="text-sm font-bold text-white mt-1" style="font-family: 'Sora', sans-serif;">{{ $viatura['km'] }}</span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="font-mono text-[9px] text-[#8e90a2] uppercase tracking-widest">Motor</span>
                        <span class="text-sm font-bold text-[#b8c3ff] mt-1"><span class="material-symbols-outlined text-xs">speed</span></span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

@endsection

@push('scripts')
<script>

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-8');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.glass-card').forEach(card => {
        card.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700');
        observer.observe(card);
    });

    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mousedown', () => card.style.transform = 'scale(0.98) translateY(-4px)');
        card.addEventListener('mouseup',   () => card.style.transform = 'scale(1) translateY(-8px)');
    });


        // Controlo das setas do Carrossel de Destaques
    const carousel = document.getElementById('destaques-carousel');
    const prevBtn = document.getElementById('destaques-prev');
    const nextBtn = document.getElementById('destaques-next');

    if (carousel && prevBtn && nextBtn) {
        // Função para obter a largura dinâmica de um cartão + espaçamento (gap)
        const getScrollAmount = () => {
            const firstCard = carousel.querySelector('.glass-card');
            if (!firstCard) return 340; // Valor padrão caso não encontre cartões

            // Largura do cartão + 20px do gap do Tailwind (gap-5 = 1.25rem = 20px)
            return firstCard.offsetWidth + 20;
        };

        // Evento para a seta esquerda (Anterior)
        prevBtn.addEventListener('click', () => {
            carousel.scrollBy({
                left: -getScrollAmount(),
                behavior: 'smooth'
            });
        });

        // Evento para a seta direita (Seguinte)
        nextBtn.addEventListener('click', () => {
            carousel.scrollBy({
                left: getScrollAmount(),
                behavior: 'smooth'
            });
        });
    }

</script>
@endpush
