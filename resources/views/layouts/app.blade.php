<!doctype html>
<html class="dark" lang="pt">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'AETHER MOTORS')</title>

    <!-- Google Fonts & Material Icons (Ligações Corrigidas e Consolidadas) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=JetBrains+Mono:wght@400;500&family=Hanken+Grotesk:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://googleapis.com" rel="stylesheet">

    <!-- Script Oficial do Tailwind CSS CDN Play -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração do Tailwind para bater certo com o Showroom -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "aether-blue": "#b8c3ff",
                        "aether-dark-blue": "#002388",
                        "aether-electric": "#2e5bff",
                        "aether-gray": "#c4c5d9",
                        "aether-light": "#e5e2e1"
                    }
                }
            }
        }
    </script>

    <!-- Estilos Customizados (Glassmorphism e Scrollbar) -->
    <style>
        body { background-color: #0e0e0e; color: #e5e2e1; -webkit-font-smoothing: antialiased; font-family: 'Hanken Grotesk', sans-serif; }
        .font-sora { font-family: 'Sora', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', 'Courier New', monospace; }

        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-nav {
            background: rgba(19, 19, 19, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .material-symbols-outlined { display: inline-block; vertical-align: middle; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0e0e0e; }
        ::-webkit-scrollbar-thumb { background: #2c2b30; border-radius: 10px; }
    </style>

    @stack('styles')
</head>
<body class="overflow-x-hidden">

    <!-- Navbar Estilo Glassmorphism Corrigida e Unificada -->
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-6 md:px-20 h-20 glass-nav">

        <!-- Esquerda: Brand / Logo -->
        <a href="{{ route('dashboard') }}" class="font-sora text-2xl font-bold text-aether-light tracking-tighter shrink-0">
            AETHER <span class="text-aether-blue block md:inline">MOTORS</span>
        </a>

        <!-- Centro: Links de Gestão Interna -->
        <div class="hidden md:flex items-center gap-8 font-mono text-xs uppercase tracking-widest">
            <a class="pb-1 transition-colors {{ request()->routeIs('dashboard') ? 'text-aether-blue border-b-2 border-aether-blue' : 'text-aether-gray hover:text-white' }}" href="{{ route('dashboard') }}">PAINEL</a>
            <a class="pb-1 transition-colors {{ request()->routeIs('clientes.*') ? 'text-aether-blue border-b-2 border-aether-blue' : 'text-aether-gray hover:text-white' }}" href="{{ route('clientes.index') }}">CLIENTES</a>
            <a class="pb-1 transition-colors {{ request()->routeIs('viaturas.*') ? 'text-aether-blue border-b-2 border-aether-blue' : 'text-aether-gray hover:text-white' }}" href="{{ route('viaturas.index') }}">VIATURAS</a>
            <a class="pb-1 transition-colors {{ request()->routeIs('vendas.*') ? 'text-aether-blue border-b-2 border-aether-blue' : 'text-aether-gray hover:text-white' }}" href="{{ route('vendas.index') }}">VENDAS</a>
        </div>

        <!-- Direita: Autenticação / Perfil Alinhado Seguro com SVG -->
        <div class="flex items-center gap-6 shrink-0">
            @auth
                <div class="hidden sm:flex items-center gap-2 font-mono text-xs text-aether-gray uppercase tracking-wider">
                    <!-- Ícone SVG de Alta Fidelidade que elimina erros de renderização -->
                    <svg class="w-5 h-5 text-aether-blue" fill="currentColor" viewBox="0 0 20 20" xmlns="http://w3.org">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a3 3 0 11-6 0 3 3 0 016 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="max-w-[150px] truncate font-medium text-white">{{ auth()->user()->name }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" class="font-mono text-xs uppercase tracking-widest px-5 py-2.5 bg-red-500/10 text-red-400 hover:bg-red-600 hover:text-white transition-colors border border-red-500/20 rounded-sm font-bold">
                        SAIR
                    </button>
                </form>
            @else
                <a href="/login" class="font-mono text-xs uppercase tracking-widest px-5 py-2.5 bg-aether-blue text-aether-dark-blue font-bold transition-opacity hover:opacity-90 rounded-sm">
                    SELL/LOGIN
                </a>
            @endauth
        </div>
    </nav>

    <!-- Contentor com Padding Superior devido à Navbar Fixa -->
    <main class="pt-32 pb-24 px-6 md:px-20 min-h-screen">

        <!-- Mensagens Flash Unificadas -->
        @if(session('success'))
            <div class="glass-card border-green-500/30 bg-green-500/10 text-green-400 p-4 rounded-sm mb-8 flex items-center justify-between gap-3 text-xs font-mono tracking-wider">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    <span>SYSTEM_SUCCESS // {{ strtoupper(session('success')) }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="hover:text-green-200 transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="glass-card border-red-500/30 bg-red-500/10 text-red-400 p-5 rounded-sm mb-8 font-mono text-xs tracking-wider">
                <div class="flex items-center gap-2 mb-3 font-bold text-red-300">
                    <span class="material-symbols-outlined text-sm">error</span>
                    <span>VALIDATION_ERROR // REJECTED SPECIFICATIONS:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-red-300/80 pl-2 tracking-normal normal-case">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
