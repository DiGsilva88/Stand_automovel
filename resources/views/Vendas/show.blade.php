@extends('layouts.app')
@section('title', 'Detalhes da Venda #' . str_pad($venda->id, 4, '0', STR_PAD_LEFT) . ' — SS Motors')

@section('content')

<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho de Detalhes -->
    <header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-white/5">
        <div>
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block mb-1">Painel Comercial</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">
                Contrato #{{ str_pad($venda->id, 4, '0', STR_PAD_LEFT) }}
            </h1>
            <p class="text-xs font-mono text-[#8e90a2] uppercase tracking-wider mt-1">
                Fatura digital e registo de posse emitido em {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}.
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('vendas.index') }}"
               class="font-mono text-xs text-[#8e90a2] hover:text-white border border-white/10 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar
            </a>
            <a href="{{ route('vendas.edit', $venda->id) }}"
               class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
                <span class="material-symbols-outlined text-sm">edit</span> Editar Registo
            </a>
        </div>
    </header>

    <!-- Grelha de Informação em Glass Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Bloco 1: Viatura Comercializada -->
        <div class="bg-[#141313] border border-white/5 rounded-sm p-6 space-y-4 shadow-2xl">
            <span class="font-mono text-[10px] text-[#b8c3ff] uppercase tracking-widest block border-b border-white/5 pb-2">Especificação Técnica</span>
            <div>
                <p class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest">Marca e Modelo</p>
                <h3 class="text-xl font-bold text-white uppercase mt-1" style="font-family: 'Sora', sans-serif;">
                    {{ $venda->viatura->marca ?? 'N/D' }}
                </h3>
                <p class="text-md text-[#8e90a2] uppercase">{{ $venda->viatura->modelo ?? '' }}</p>
            </div>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div>
                    <span class="font-mono text-[9px] text-[#8e90a2] uppercase tracking-widest">Ano</span>
                    <p class="text-white font-bold mt-0.5">{{ $venda->viatura->ano ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-mono text-[9px] text-[#8e90a2] uppercase tracking-widest">Quilómetros</span>
                    <p class="text-white font-bold mt-0.5">{{ $venda->viatura->km ?? '—' }} km</p>
                </div>
            </div>
        </div>

        <!-- Bloco 2: Titular / Cliente -->
        <div class="bg-[#141313] border border-white/5 rounded-sm p-6 space-y-4 shadow-2xl">
            <span class="font-mono text-[10px] text-[#b8c3ff] uppercase tracking-widest block border-b border-white/5 pb-2">Titular do Contrato</span>
            <div>
                <p class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest">Nome do Adquirente</p>
                <h3 class="text-xl font-bold text-white uppercase mt-1" style="font-family: 'Sora', sans-serif;">
                    {{ $venda->cliente->nome ?? 'N/D' }}
                </h3>
            </div>
            @if(isset($venda->cliente->email) || isset($venda->cliente->telefone))
            <div class="space-y-1 pt-2 font-mono text-xs text-[#8e90a2]">
                <p class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">mail</span> {{ $venda->cliente->email ?? '' }}</p>
                <p class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">call</span> {{ $venda->cliente->telefone ?? '' }}</p>
            </div>
            @endif
        </div>

        <!-- Bloco 3: Resumo Financeiro -->
        <div class="bg-[#141313] border border-white/5 rounded-sm p-6 flex flex-col justify-between shadow-2xl relative overflow-hidden">
            <div class="space-y-4">
                <span class="font-mono text-[10px] text-amber-400 uppercase tracking-widest block border-b border-white/5 pb-2">Fecho de Transação</span>
                <div>
                    <p class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest">Estado da Venda</p>
                    <span class="inline-block bg-[#b8c3ff]/10 text-[#b8c3ff] border border-[#b8c3ff]/20 font-mono text-[9px] uppercase tracking-widest px-2 py-0.5 mt-1 rounded-sm">
                        Processada e Confirmada
                    </span>
                </div>
            </div>

            <div class="pt-6 border-t border-white/5 mt-6">
                <p class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest">Valor Liquidado</p>
                <p class="text-3xl font-mono font-bold text-[#b8c3ff] tracking-tight mt-1">
                    {{ number_format($venda->valor_total, 0, ',', '.') }} €
                </p>
            </div>
        </div>

    </div>
</main>

@endsection
