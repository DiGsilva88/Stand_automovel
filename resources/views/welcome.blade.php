<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SS Automóveis — Performance & Elegância</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts (Tailwind do Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b0b0b] text-white antialiased selection:bg-indigo-500 selection:text-white overflow-x-hidden" style="font-family: 'Sora', sans-serif;">

    <!-- Navbar Superior -->
    <nav class="w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center bg-transparent relative z-10">
        <!-- Logótipo -->
        <a href="{{ route('home') }}" class="text-xl font-bold tracking-wider font-mono text-white hover:opacity-80 transition-opacity">
            SS AUTOMÓVEIS
        </a>

        <!-- Links de Navegação Centro -->
        <div class="hidden md:flex items-center gap-8 text-[11px] font-mono tracking-widest text-gray-400 uppercase">
            <a href="{{ route('viaturas.index') }}" class="hover:text-white transition-colors">SHOWROOM</a>
            <a href="#" class="hover:text-white transition-colors">Contactos</a>
            <a href="{{ route('visitas.create') }}" class="hover:text-white transition-colors text-indigo-400 font-bold">Agendar visita</a>
        </div>

        <!-- Links Direita (Autenticação) -->
        <div class="flex items-center gap-6 text-[11px] font-mono tracking-widest uppercase">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white border border-white/20 px-4 py-2 rounded hover:bg-white hover:text-black transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">
                        Entrar / Registar
                    </a>
                @endauth
            @endif
        </div>
    </nav>

   <!-- Secção Hero Principal -->
    <main class="relative min-h-[calc(100vh-88px)] flex flex-col justify-center items-start max-w-7xl mx-auto px-6 py-12">

       <!-- Vídeo de Fundo Premium - LINK DIRETO TESTADO -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
            <video autoplay loop muted playsinline
                   class="w-full h-full object-cover opacity-45 filter grayscale brightness-90 contrast-115">
                <source src="https://vincentschwenk.ch" type="video/mp4">
            </video>

            <!-- Máscaras de degradê para fusão perfeita com o fundo preto -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#0b0b0b] via-[#0b0b0b]/60 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b0b0b]/50 via-transparent to-[#0b0b0b]/40"></div>
        </div>

        <!-- Conteúdo de Texto à Esquerda -->
        <div class="relative z-10 max-w-xl space-y-6">
            <p class="text-[11px] font-mono tracking-[0.3em] uppercase text-indigo-400 font-medium">
                O Futuro da Performance
            </p>

            <h1 class="text-5xl md:text-7xl font-bold tracking-tight text-white leading-none font-sans uppercase">
                DISTINÇÃO <br> <span class="text-gray-400">ABSOLUTA.</span>
            </h1>

            <p class="text-sm md:text-base text-gray-400 leading-relaxed font-light tracking-wide">
                Onde o prestígio automóvel encontra a distinção absoluta.
            </p>

            <!-- Botões de Ação Funcionais -->
            <div class="flex flex-wrap gap-4 pt-4 font-mono text-[11px] tracking-widest uppercase relative z-20">
                <a href="{{ route('viaturas.index') }}" class="bg-indigo-200 text-black font-semibold px-8 py-4 rounded hover:bg-indigo-300 transition-all text-center min-w-[160px]">
                    Ver Viaturas
                </a>
                <a href="{{ route('visitas.create') }}" class="border border-white/20 text-white font-medium px-8 py-4 rounded hover:bg-white/10 transition-all text-center min-w-[160px]">
                    Agendar Test Drive
                </a>
            </div>
        </div>

        <!-- Indicador Inferior (Explore) -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[10px] font-mono tracking-widest text-gray-500 animate-pulse">
            <span>Explorar</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>

    </main>
</body>
</html>
