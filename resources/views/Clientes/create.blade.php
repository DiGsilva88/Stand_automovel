@extends('layouts.app')
@section('title', 'Novo Cliente — SS Automóveis')

@section('content')

<!-- Contentor Principal Uniformizado -->
<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho do Formulário -->
    <header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-white/5">
        <div>
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block mb-1">Base de Dados</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">Novo Cliente</h1>
            <p class="text-xs font-mono text-[#8e90a2] uppercase tracking-wider mt-1">Abra uma nova ficha de cliente particular ou institucional.</p>
        </div>

        <!-- Botão Voltar -->
        <a href="{{ route('clientes.index') }}"
           class="font-mono text-xs text-[#8e90a2] hover:text-white border border-white/10 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar
        </a>
    </header>

    <!-- Formulário Estilo Glass Card -->
    <div class="max-w-3xl bg-[#141313] border border-white/5 rounded-sm p-6 md:p-10 shadow-2xl">

        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nome Completo -->
            <div class="flex flex-col space-y-2">
                <label for="nome" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Nome Completo</label>
                <input type="text" name="nome" id="nome" required value="{{ old('nome') }}" placeholder="Ex: Rodrigo Silva Mota"
                       class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora transition-colors">
                @error('nome') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Grid de Contacto e E-mail -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Telefone -->
                <div class="flex flex-col space-y-2">
                    <label for="telefone" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Contacto Telefónico</label>
                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}" placeholder="+351 9xx xxx xxx"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono text-white focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                    @error('telefone') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- E-mail -->
                <div class="flex flex-col space-y-2">
                    <label for="email" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Endereço de E-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="cliente@dominio.pt"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono text-white focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                    @error('email') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

            </div>

            <!-- NIF -->
            <div class="flex flex-col space-y-2">
                <label for="nif" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">NIF / Identificação Fiscal</label>
                <input type="text" name="nif" id="nif" value="{{ old('nif') }}" placeholder="9 dígitos obrigatórios para contratos" maxlength="9"
                       class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono text-white focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                @error('nif') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Botões de Submissão -->
            <div class="flex justify-end items-center pt-4 border-t border-white/5">
                <button type="submit"
                        class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-6 py-3.5 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm cursor-pointer">
                    <span class="material-symbols-outlined text-sm">person +</span> Registar Ficha
                </button>
            </div>

        </form>
    </div>
</main>

@endsection
