@extends('layouts.app')
@section('title', 'Nova Venda — SS Motors')

@section('content')

<!-- Contentor Principal Uniformizado -->
<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho do Formulário -->
    <header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-white/5">
        <div>
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block mb-1">Painel Comercial</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">Nova Venda</h1>
            <p class="text-xs font-mono text-[#8e90a2] uppercase tracking-wider mt-1">Registe um novo contrato de transação no sistema.</p>
        </div>

        <!-- Botão Voltar -->
        <a href="{{ route('vendas.index') }}"
           class="font-mono text-xs text-[#8e90a2] hover:text-white border border-white/10 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar à listagem
        </a>
    </header>

    <!-- Formulário Estilo Glass Card -->
    <div class="max-w-3xl bg-[#141313] border border-white/5 rounded-sm p-6 md:p-10 shadow-2xl">

        <form action="{{ route('vendas.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Seleção de Viatura -->
            <div class="flex flex-col space-y-2">
                <label for="viatura_id" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Viatura em Destaque</label>
                <div class="relative">
                    <select name="viatura_id" id="viatura_id" required
                            class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora appearance-none transition-colors">
                        <option value="" disabled selected class="text-gray-500">Selecione o veículo comercializado...</option>
                        @foreach($viaturas as $viatura)
                            <option value="{{ $viatura->id }}" class="bg-[#141313]">
                                {{ $viatura->marca }} {{ $viatura->modelo }} — ({{ number_format($viatura->preco ?? 0, 0, ',', '.') }} €)
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('viatura_id') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Grid de Duas Colunas: Cliente e Data -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Seleção de Cliente -->
                <div class="flex flex-col space-y-2">
                    <label for="cliente_id" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Cliente Comprador</label>
                    <select name="cliente_id" id="cliente_id" required
                            class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora transition-colors">
                        <option value="" disabled selected class="text-gray-500">Selecione o cliente...</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" class="bg-[#141313]">
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Data de Venda -->
                <div class="flex flex-col space-y-2">
                    <label for="data_venda" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Data do Contrato</label>
                    <input type="date" name="data_venda" id="data_venda" required
                           value="{{ old('data_venda', date('Y-m-d')) }}"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-mono transition-colors scheme-dark">
                    @error('data_venda') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

            </div>

            <!-- Valor Comercial Real da Transação -->
            <div class="flex flex-col space-y-2">
                <label for="valor_total" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Valor Total da Venda (€)</label>
                <div class="relative flex items-center">
                    <input type="number" name="valor_total" id="valor_total" required step="0.01" placeholder="0"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono font-bold text-[#b8c3ff] tracking-wide focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                    <span class="absolute right-4 font-mono text-xs text-[#8e90a2] uppercase">EUR</span>
                </div>
                @error('valor_total') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Botões de Ação do Formulário -->
            <div class="flex justify-end items-center gap-4 pt-4 border-t border-white/5">
                <button type="submit"
                        class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-6 py-3.5 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm cursor-pointer">
                    <span class="material-symbols-outlined text-sm">assignment_turned_in</span> Concluir Venda
                </button>
            </div>

        </form>
    </div>
</main>

@endsection
