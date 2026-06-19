<!DOCTYPE html>
<html class="dark h-full bg-[#131313]" lang="pt">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'AETHER MOTORS | The Art of Precision')</title>

    {{-- Motor de Renderização do Tailwind via CDN com suporte a plugins --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Tipografias e Ícones Premium do Tema Aether --}}
    <link href="https://googleapis.com" rel="stylesheet">
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="https://jsdelivr.net">

    <!-- Configuração Nativa do Objeto Tailwind para a Paleta AETHER -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#bec6e0",
                        "surface-dim": "#131313",
                        "secondary-fixed-dim": "#c1c7cf",
                        "surface-tint": "#b8c3ff",
                        "secondary": "#c1c7cf",
                        "error": "#ffb4ab",
                        "on-tertiary": "#283044",
                        "on-surface-variant": "#c4c5d9",
                        "outline": "#8e90a2",
                        "inverse-surface": "#e5e2e1",
                        "surface-variant": "#353534",
                        "primary": "#b8c3ff",
                        "secondary-container": "#41474e",
                        "primary-fixed": "#dde1ff",
                        "tertiary": "#bec6e0",
                        "outline-variant": "#434656",
                        "on-primary-container": "#efefff",
                        "inverse-primary": "#124af0",
                        "secondary-fixed": "#dde3eb",
                        "on-secondary-fixed-variant": "#41474e",
                        "surface-bright": "#3a3939",
                        "on-background": "#e5e2e1",
                        "primary-fixed-dim": "#b8c3ff",
                        "surface-container-highest": "#353534",
                        "surface": "#131313",
                        "inverse-on-surface": "#313030",
                        "on-primary-fixed-variant": "#0035be",
                        "tertiary-fixed": "#dae2fd",
                        "background": "#131313",
                        "on-surface": "#e5e2e1",
                        "tertiary-container": "#656d84",
                        "error-container": "#93000a",
                        "on-secondary-fixed": "#161c22",
                        "surface-container": "#201f1f",
                        "on-error-container": "#ffdad6",
                        "on-primary-fixed": "#001356",
                        "primary-container": "#2e5bff",
                        "on-tertiary-fixed-variant": "#3f465c",
                        "surface-container-low": "#1c1b1b",
                        "on-primary": "#002388",
                        "on-tertiary-fixed": "#131b2e",
                        "on-error": "#690005",
                        "on-tertiary-container": "#eef0ff",
                        "on-secondary-container": "#afb6bd",
                        "surface-container-lowest": "#0e0e0e",
                        "on-secondary": "#2b3137",
                        "surface-container-high": "#2a2a2a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-sm": "8px",
                        "margin-desktop": "80px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "section-gap": "120px",
                        "gutter": "32px",
                        "margin-mobile": "24px",
                        "container-max": "1440px"
                    },
                    "fontFamily": {
                        "label-sm": ["JetBrains Mono"],
                        "display-lg": ["Sora"],
                        "body-md": ["Hanken Grotesk"],
                        "headline-xl": ["Sora"],
                        "headline-lg": ["Sora"],
                        "display-lg-mobile": ["Sora"],
                        "body-lg": ["Hanken Grotesk"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "500"}],
                        "display-lg": ["72px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-xl": ["48px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "display-lg-mobile": ["40px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>

    <style>
        body {
            background-color: #131313;
            color: #e5e2e1;
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
        }
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
</head>
<body class="font-body-md text-body-md overflow-x-hidden min-h-full flex flex-col">

<!-- Top Navigation Bar (Estilo AETHER Dinâmico) -->
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-6 md:px-margin-desktop h-20 bg-[#131313]/80 backdrop-blur-md border-b border-white/10 shadow-[0_40px_40px_-15px_rgba(46,91,255,0.05)]">
    <a href="{{ route('home') }}" class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tighter uppercase">
        AETHER MOTORS
    </a>

    <!-- Links Centrais Dinâmicos baseados no Perfil Autenticado -->
    <div class="hidden md:flex items-center gap-stack-lg font-label-sm text-label-sm uppercase tracking-[0.05em]">
        <a class="text-primary border-b-2 border-primary pb-1" href="{{ route('viaturas.index') }}">SHOWROOM</a>

        @auth
            @if(auth()->user()->is_admin)
                <a class="text-on-surface-variant hover:text-on-surface transition-colors" href="{{ route('dashboard') }}">Painel</a>
                <a class="text-on-surface-variant hover:text-on-surface transition-colors" href="{{ route('clientes.index') }}">Clientes</a>
                <a class="text-on-surface-variant hover:text-on-surface transition-colors" href="{{ route('vendas.index') }}">Vendas</a>
            @else
                <a class="text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-1" href="{{ route('dashboard') }}">
                    <i class="bi bi-heart-fill text-rose-500 text-[10px]"></i> Minha Garagem
                </a>
            @endif
        @endauth
    </div>

    <!-- Bloco de Autenticação e Pesquisa à Direita -->
    <div class="flex items-center gap-stack-md">
        @auth
            <span class="hidden sm:inline font-mono text-[11px] text-on-surface-variant normal-case">
                {{ auth()->user()->name }}
            </span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="font-label-sm text-label-sm uppercase tracking-[0.05em] text-on-surface hover:text-error transition-all duration-300">
                    SAIR
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="font-label-sm text-label-sm uppercase tracking-[0.05em] text-on-surface hover:text-primary transition-all duration-300">
                SELL/LOGIN
            </a>
        @endauth
        <span class="material-symbols-outlined text-primary cursor-pointer select-none">search</span>
    </div>
</nav>

<!-- Contentor Principal Adaptado ao Layout Global -->
<main class="w-full flex-grow">

    {{-- Sistema de Feedback de Notificações Flash em Estilo Aether --}}
    @if(session('success') || $errors->any())
        <div class="max-w-[1440px] mx-auto px-6 md:px-margin-desktop pt-24 mt-4">
            @if(session('success'))
                <div class="bg-emerald-950/40 border border-emerald-500/30 text-emerald-400 p-4 rounded-sm flex items-center gap-2 text-xs font-mono uppercase tracking-wider">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-950/40 border border-rose-500/30 text-rose-400 p-4 rounded-sm text-xs font-mono uppercase tracking-wider">
@foreach
($errors->all() as $erro){{ $erro }}
@endforeach
@endif@endif
{{-- Injeção das Vistas (welcome, dashboard, showroom, etc.) --}}@yield('content')@stack('scripts')
