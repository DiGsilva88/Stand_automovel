<!DOCTYPE html>
<html lang="pt" class="h-full bg-[#131313]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SS Automóveis')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=JetBrains+Mono:wght@400;500&family=Hanken+Grotesk:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="min-h-full flex flex-col font-sans antialiased text-[#e5e2e1] bg-[#131313]">

<nav class="bg-[#0e0e0e] border-b border-white/5 relative z-50">
    <div class="max-w-[1440px] mx-auto px-6 md:px-20 h-20 flex items-center justify-between">

       <a class="text-xl md:text-2xl font-bold text-white hover:text-[#b8c3ff] transition-colors uppercase tracking-tight"
   style="font-family: 'Sora', sans-serif;"
   href="{{ route('home') }}">
    SS AUTOMÓVEIS
</a>

        <button id="menu-toggle" type="button" class="md:hidden text-white focus:outline-none p-2">
            <i class="bi bi-list text-2xl"></i>
        </button>

        <div id="menu-links" class="hidden absolute top-20 left-0 w-full bg-[#0e0e0e] border-b border-white/5 flex-col p-6 space-y-4 md:space-y-0 md:p-0 md:relative md:top-0 md:w-auto md:bg-transparent md:border-none md:flex md:flex-row md:items-center md:gap-8 font-mono text-[11px] uppercase tracking-widest font-bold">

            @auth
                @if(auth()->user()->isAdmin())
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('dashboard') }}">Painel</a>
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('clientes.index') }}">Clientes</a>
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('viaturas.index') }}">Viaturas</a>
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('vendas.index') }}">Vendas</a>
                @else
                    <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('viaturas.index') }}">Showroom</a>
                    <a class="text-[#b8c3ff] hover:text-white transition-colors flex items-center gap-1" href="{{ route('dashboard') }}">
                        <i class="bi bi-heart-fill text-rose-500"></i> A Minha Garagem
                    </a>
                @endif
            @else
                <a class="text-[#8e90a2] hover:text-white transition-colors" href="{{ route('viaturas.index') }}">Showroom</a>
            @endauth

            <div class="h-px bg-white/10 my-2 md:hidden"></div>

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

<main class="flex-grow w-full">

    @if(session('success') || $errors->any())
        <div class="max-w-[1440px] mx-auto px-6 md:px-20 mt-4">
            @if(session('success'))
                <div class="bg-emerald-950/40 border border-emerald-500/30 text-emerald-400 p-4 rounded-sm mb-4 flex items-center gap-2 text-sm font-mono">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-950/40 border border-rose-500/30 text-rose-400 p-4 rounded-sm mb-4 text-sm font-mono">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    @yield('content')

</main>

<footer class="bg-[#0e0e0e] border-t border-white/5 mt-auto">
    <div class="max-w-[1440px] mx-auto px-6 md:px-20 py-16">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            <!-- Marca -->
            <div class="space-y-4">
                <span class="text-xl font-bold text-white uppercase tracking-tight" style="font-family: 'Sora', sans-serif;">
                    SS AUTOMÓVEIS
                </span>
                <p class="text-[#8e90a2] text-sm leading-relaxed">
                    Stand automóvel especializado em viaturas premium e seminovas, com garantia e acompanhamento personalizado em todo o processo de compra.
                </p>
                <div class="flex items-center gap-4 pt-2">
                    <a href="#" target="_blank" rel="noopener" aria-label="Instagram"
                       class="w-9 h-9 flex items-center justify-center border border-white/10 rounded-sm text-[#8e90a2] hover:text-[#b8c3ff] hover:border-[#b8c3ff]/30 transition-all duration-300">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener" aria-label="Facebook"
                       class="w-9 h-9 flex items-center justify-center border border-white/10 rounded-sm text-[#8e90a2] hover:text-[#b8c3ff] hover:border-[#b8c3ff]/30 transition-all duration-300">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener" aria-label="LinkedIn"
                       class="w-9 h-9 flex items-center justify-center border border-white/10 rounded-sm text-[#8e90a2] hover:text-[#b8c3ff] hover:border-[#b8c3ff]/30 transition-all duration-300">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener" aria-label="WhatsApp"
                       class="w-9 h-9 flex items-center justify-center border border-white/10 rounded-sm text-[#8e90a2] hover:text-[#b8c3ff] hover:border-[#b8c3ff]/30 transition-all duration-300">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Contactos -->
            <div class="space-y-4">
                <h3 class="font-mono text-[11px] uppercase tracking-widest text-white font-bold">Contactos</h3>
                <ul class="space-y-3 text-sm text-[#8e90a2]">
                    <li class="flex items-start gap-3">
                        <i class="bi bi-geo-alt text-[#b8c3ff] mt-0.5"></i>
                        <span>Rua das Indústrias, n.º 245<br>4450-123 Matosinhos, Portugal</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="bi bi-telephone text-[#b8c3ff]"></i>
                        <a href="tel:+351912345678" class="hover:text-white transition-colors">+351 912 345 678</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="bi bi-envelope text-[#b8c3ff]"></i>
                        <a href="mailto:geral@ssautomoveis.pt" class="hover:text-white transition-colors">geral@ssautomoveis.pt</a>
                    </li>
                </ul>
            </div>

            <!-- Horário -->
            <div class="space-y-4">
                <h3 class="font-mono text-[11px] uppercase tracking-widest text-white font-bold">Horário</h3>
                <ul class="space-y-2 text-sm text-[#8e90a2]">
                    <li class="flex justify-between gap-4">
                        <span>Seg — Sex</span>
                        <span class="text-white">09:00 – 19:00</span>
                    </li>
                    <li class="flex justify-between gap-4">
                        <span>Sábado</span>
                        <span class="text-white">10:00 – 13:00</span>
                    </li>
                    <li class="flex justify-between gap-4">
                        <span>Domingo</span>
                        <span class="text-white">Fechado</span>
                    </li>
                </ul>
            </div>

            <!-- Informação Legal -->
            <div class="space-y-4">
                <h3 class="font-mono text-[11px] uppercase tracking-widest text-white font-bold">Informação Legal</h3>
                <ul class="space-y-2 text-sm text-[#8e90a2]">
                    <li><a href="#" class="hover:text-white transition-colors">Termos e Condições</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Política de Privacidade</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Política de Cookies</a></li>
                    <li>
                        <a href="https://www.livroreclamacoes.pt/Inicio/" target="_blank" rel="noopener"
                           class="hover:text-white transition-colors flex items-center gap-1">
                            Livro de Reclamações <i class="bi bi-box-arrow-up-right text-[10px]"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Linha legal inferior -->
        <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 text-xs text-[#8e90a2] font-mono">
            <p>&copy; {{ date('Y') }} SS Automóveis, Lda. Todos os direitos reservados.</p>
            <p class="text-[#5e5f6c]">NIPC 500 123 456 &middot; Capital Social 5.000€ &middot; Registado na Conservatória do Registo Comercial de Matosinhos</p>
        </div>

        <div class="mt-3 text-[11px] text-[#5e5f6c] leading-relaxed font-mono">
            Em caso de litígio de consumo, o consumidor pode recorrer a uma Entidade de Resolução Alternativa de Litígios:
            <a href="https://www.consumidor.gov.pt" target="_blank" rel="noopener" class="text-[#8e90a2] hover:text-white underline">www.consumidor.gov.pt</a>
        </div>
    </div>
</footer>

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
