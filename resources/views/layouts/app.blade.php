<!DOCTYPE html>
<html lang="pt" class="h-full bg-[#131313]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SS Automóveis')</title>

    {{-- Compilação de Assets do Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tipografia e ícones usados pelo estilo SS Automóveis --}}
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=JetBrains+Mono:wght@400;500&family=Hanken+Grotesk:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    {{-- CORREÇÃO: Link completo e funcional para os ícones do Bootstrap --}}
    <link rel="stylesheet" href="https://jsdelivr.net">

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="min-h-full flex flex-col font-sans antialiased text-[#e5e2e1] bg-[#131313]">

{{-- Barra de Navegação Adaptada ao Novo Modelo Escuro (Tailwind) --}}
<nav class="bg-[#0e0e0e] border-b border-white/5 relative z-50">
    <div class="max-w-[1440px] mx-auto px-6 md:px-20 h-20 flex items-center justify-between">

        <a class="flex items-center gap-2 font-mono text-xs uppercase tracking-widest font-bold text-white hover:text-[#b8c3ff] transition-colors" href="{{ route('dashboard') }}">
            <i class="bi bi-car-front text-base text-[#b8c3ff]"></i> SS AUTOMÓVEIS
        </a>

        <!-- Botão Hambúrguer para Mobile -->
        <button id="menu-toggle" type="button" class="md:hidden text-white focus:outline-none p-2">
            <i class="bi bi-list text-2xl"></i>
        </button>

        <!-- Links de Navegação Dinâmicos e Filtrados por Permissão -->
        <div id="menu-links" class="hidden absolute top-20 left-0 w-full bg-[#0e0e0e] border-b border-white/5 flex-col p-6 space-y-4 md:space-y-0 md:p-0 md:relative md:top-0 md:w-auto md:bg-transparent md:border-none md:flex md:flex-row md:items-center md:gap-8 font-mono text-[11px] uppercase tracking-widest font-bold">

            @auth
                @if(auth()->user()->is_admin)
                    {{-- Links visíveis APENAS para o Administrador --}}
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('dashboard') }}">Painel</a>
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('clientes.index') }}">Clientes</a>
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('viaturas.index') }}">Viaturas</a>
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('vendas.index') }}">Vendas</a>
                @else
                    {{-- Links visíveis APENAS para o Cliente Autenticado --}}
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('viaturas.index') }}">Showroom</a>
                    <a class="text-[#b8c3ff] hover:text-white transition-colors flex items-center gap-1" href="{{ route('dashboard') }}">
                        <i class="bi bi-heart-fill text-rose-500"></i> A Minha Garagem
                    </a>
                @endif
            @else
                {{-- Links visíveis para Visitantes não logados --}}
                <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('viaturas.index') }}">Showroom</a>
            @endauth

            <div class="h-px bg-white/10 my-2 md:hidden"></div>

            {{-- Bloco de Login / Perfil --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:gap-6 md:ml-auto">
                @auth
                    <span class="text-white flex items-center gap-2 font-normal normal-case text-xs">
                        <i class="bi bi-person-circle text-[#b8c3ff]"></i> {{ auth()->user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-white/10 px-4 py-2 hover:bg-white/5 text-white transition-all duration-300 text-left text-[10px]">Sair</button>
                    </form>
                @else
                    <a class="text-[#8e90a2] hover:text-white transition-colors flex items-center h-full" href="{{ route('login') }}">Entrar</a>
                    <a class="border border-white/10 px-4 py-2 hover:bg-white/5 text-white transition-all duration-300 text-center block" href="{{ route('register') }}">Registar</a>
                @endauth
            </div>
        </div>

    </div>
</nav>

{{-- Contentor Principal --}}
<main class="flex-grow w-full">

    {{-- Sistema de Notificações Flash --}}
    @if(session('success') || $errors->any())
        <div class="max-w-[1440px] mx-auto px-6 md:px-20 mt-4">
            @if(session('success'))
                <div class="bg-emerald-950/40 border border-emerald-500/30 text-emerald-400 p-4 rounded mb-4 flex items-center gap-2 text-sm font-mono">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-950/40 border border-rose-500/30 text-rose-400 p-4 rounded mb-4 text-sm font-mono">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    {{-- Injeção do conteúdo dinâmico --}}
    @yield('content')

</main>

{{-- Scripts Core JavaScript --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('menu-toggle');
        const menuLinks = document.getElementById('menu-links');

        if (toggleBtn && menuLinks) {
            toggleBtn.addEventListener('click', function () {
                menuLinks.classList.toggle('hidden');
                menuLinks.classList.toggle('flex');
            });
        }
    });
</script>

@stack('scripts')

</body>
</html>
