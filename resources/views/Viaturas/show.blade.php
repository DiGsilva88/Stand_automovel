@extends('layouts.app')

@section('title', $viatura->marca . ' ' . $viatura->modelo . ' — SS Automóveis')

@section('content')

<!-- Estilos e Efeitos Isolados do Showroom -->
<style>
    .glass-panel {
        background: rgba(32, 31, 31, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .spec-border {
        border-color: rgba(255, 255, 255, 0.05);
    }
</style>

<!-- Contentor Principal Uniformizado com o Portfólio Geral -->
<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho de Navegação e Ações Rápidas -->
    <header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-white/5">
        <div>
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block mb-1">Showroom Exclusivo</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">
                {{ $viatura->marca }} <span class="text-[#8e90a2] font-light">{{ $viatura->modelo }}</span>
            </h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('viaturas.index') }}"
               class="font-mono text-xs text-[#8e90a2] hover:text-white border border-white/10 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar ao Stock
            </a>

            @auth
                <a href="{{ route('viaturas.edit', $viatura->id) }}"
                   class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
                    <span class="material-symbols-outlined text-sm">edit</span> Editar Ficha
                </a>
            @endauth
        </div>
    </header>

    <!-- Layout de Duas Colunas Imersivo (Imagem Grande vs Detalhes Técnicos) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Painel da Imagem Principal (7 Colunas no Desktop) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="relative rounded-sm overflow-hidden border border-white/5 bg-[#141313] aspect-[16/10] shadow-2xl">
                @if(!empty($viatura->foto))
                    <img src="{{ asset($viatura->foto) }}" alt="{{ $viatura->marca }} {{ $viatura->modelo }}"
                         class="w-full h-full object-cover car-image-real">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center space-y-2">
                        <span class="material-symbols-outlined text-5xl text-white/10">directions_car</span>
                        <p class="font-mono text-[10px] uppercase text-[#8e90a2] tracking-wider">Sem registo fotográfico</p>
                    </div>
                @endif

                <!-- Crachá Dinâmico de Estado Comercial -->
                <div class="absolute top-4 right-4 bg-[#0e0e0e]/90 backdrop-blur-md px-3 py-1.5 border border-white/10 rounded-sm">
                    <span class="font-mono text-[10px] uppercase tracking-widest font-medium
                        {{ $viatura->estado === 'Disponível' ? 'text-[#b8c3ff]' : 'text-[#8e90a2]' }}">
                        {{ $viatura->estado }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Painel Técnico e Comercial (5 Colunas no Desktop) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Caixa Comercial Base -->
            <div class="bg-[#141313] border border-white/5 rounded-sm p-6 space-y-6 shadow-2xl">
                <div>
                    <span class="font-mono text-[9px] text-[#8e90a2] uppercase tracking-widest block">Preço de Comercialização</span>
                    <p class="text-3xl md:text-4xl font-mono font-bold text-[#b8c3ff] tracking-tight mt-1">
                        {{ number_format($viatura->preco, 0, ',', '.') }} €
                    </p>
                </div>

                <!-- Grelha de Especificações em Lista Corrida -->
                <div class="divide-y spec-border font-mono text-xs">
                    <div class="py-3.5 flex justify-between items-center">
                        <span class="text-[#8e90a2] uppercase tracking-wider">Ano de Registo</span>
                        <span class="text-white font-bold">{{ $viatura->ano }}</span>
                    </div>
                    <div class="py-3.5 flex justify-between items-center">
                        <span class="text-[#8e90a2] uppercase tracking-wider">Quilometragem</span>
                        <span class="text-white font-bold">{{ number_format($viatura->quilometros, 0, ',', '.') }} km</span>
                    </div>
                    <div class="py-3.5 flex justify-between items-center">
                        <span class="text-[#8e90a2] uppercase tracking-wider">Identificador Técnico</span>
                        <span class="text-[#8e90a2] font-mono">#{{ str_pad($viatura->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                <!-- Ações do Cliente Final -->
                @if($viatura->estado === 'Disponível')
                    <div class="pt-4 space-y-3">
                        <!-- Formulário ou Rota Simbólica para Adicionar/Remover dos Favoritos -->
                        <button type="button" class="w-full font-mono text-xs text-white bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 py-3.5 flex items-center justify-center gap-2 uppercase tracking-widest transition-all rounded-sm cursor-pointer">
                            <span class="material-symbols-outlined text-sm">favorite</span> Guardar na Minha Garagem
                        </button>

                        <a href="mailto:geral@ssautomoveis.pt?subject=Interesse: {{ $viatura->marca }} {{ $viatura->modelo }} (%23{{ $viatura->id }})"
                           class="w-full font-mono text-xs text-black bg-[#b8c3ff] hover:bg-white py-3.5 flex items-center justify-center gap-2 uppercase tracking-widest transition-all rounded-sm font-bold text-center">
                            <span class="material-symbols-outlined text-sm">mail</span> Solicitar Proposta Comercial
                        </a>
                    </div>
                @else
                    <div class="pt-4">
                        <div class="p-4 bg-white/[0.02] border border-white/5 rounded-sm text-center font-mono text-[10px] uppercase tracking-widest text-[#8e90a2]">
                            Este modelo já se encontra reservado ou entregue ao novo proprietário.
                        </div>
                    </div>
                @endif
            </div>

            <!-- Caixa Adicional: Certificação e Garantia do Stand -->
            <div class="glass-panel rounded-sm p-5 flex items-start gap-4">
                <span class="material-symbols-outlined text-[#b8c3ff] text-xl mt-0.5">verified_user</span>
                <div class="space-y-1">
                    <h4 class="font-mono text-xs uppercase tracking-widest text-white font-bold">Padrão SS Motors</h4>
                    <p class="text-xs text-[#8e90a2] leading-relaxed">
                        Todas as nossas viaturas passam por um rigoroso processo de inspeção mecânica multi-pontos, oferecendo garantia contratual completa e acompanhamento documental personalizado.
                    </p>
                </div>
            </div>

        </div>

    </div>
</main>

@endsection
