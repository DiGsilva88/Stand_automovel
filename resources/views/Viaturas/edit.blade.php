@extends('layouts.app')

@section('title', 'Editar Viatura #' . $viatura->id . ' — SS Automóveis')

@section('content')

<!-- Contentor Principal Uniformizado -->
<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho de Edição -->
    <header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-white/5">
        <div>
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block mb-1">Gestão de Stock</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">
                Editar Viatura #{{ $viatura->id }}
            </h1>
            <p class="text-xs font-mono text-[#8e90a2] uppercase tracking-wider mt-1">Atualize a ficha técnica, preço e estado do veículo em stock.</p>
        </div>

        <!-- Botão Cancelar -->
        <a href="{{ route('viaturas.index') }}"
           class="font-mono text-xs text-[#8e90a2] hover:text-white border border-white/10 px-5 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Cancelar e Voltar
        </a>
    </header>

    <!-- Formulário Estilo Glass Card -->
    <div class="max-w-3xl bg-[#141313] border border-white/5 rounded-sm p-6 md:p-10 shadow-2xl">

        <form action="{{ route('viaturas.update', $viatura->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Grid de Duas Colunas: Marca e Modelo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Marca -->
                <div class="flex flex-col space-y-2">
                    <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Marca *</label>
                    <input type="text" name="marca" required value="{{ old('marca', $viatura->marca) }}"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora transition-colors">
                    @error('marca') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Modelo -->
                <div class="flex flex-col space-y-2">
                    <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Modelo *</label>
                    <input type="text" name="modelo" required value="{{ old('modelo', $viatura->modelo) }}"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora transition-colors">
                    @error('modelo') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Grid de Duas Colunas: Ano e Quilómetros -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ano -->
                <div class="flex flex-col space-y-2">
                    <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Ano *</label>
                    <input type="number" name="ano" required value="{{ old('ano', $viatura->ano) }}"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono text-white focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                    @error('ano') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Quilómetros -->
                <div class="flex flex-col space-y-2">
                    <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Quilómetros *</label>
                    <input type="number" name="quilometros" required value="{{ old('quilometros', $viatura->quilometros) }}"
                           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono text-white focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                    @error('quilometros') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Grid de Duas Colunas: Preço e Estado -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Preço -->
                <div class="flex flex-col space-y-2">
                    <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Preço (€) *</label>
                    <div class="relative flex items-center">
                        <input type="number" name="preco" step="0.01" required value="{{ old('preco', str_replace(',', '.', $viatura->preco)) }}"
                               class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono font-bold text-[#b8c3ff] tracking-wide focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
                        <span class="absolute right-4 font-mono text-xs text-[#8e90a2] uppercase">EUR</span>
                    </div>
                    @error('preco') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Estado -->
                <div class="flex flex-col space-y-2">
                    <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Estado *</label>
                    <select name="estado" class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora transition-colors">
                        <option value="Disponível" {{ old('estado', $viatura->estado) == 'Disponível' ? 'selected' : '' }} class="bg-[#141313]">Disponível</option>
                        <option value="Vendido" {{ old('estado', $viatura->estado) == 'Vendido' ? 'selected' : '' }} class="bg-[#141313]">Vendido</option>
                    </select>
                    @error('estado') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Upload da Fotografia -->
            <div class="flex flex-col space-y-3 pt-2">
                <label class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Fotografia do Veículo</label>

                @if(!empty($viatura->foto))
                    <div class="flex items-center gap-4 p-4 bg-[#1a1a1a] border border-white/5 rounded-sm max-w-md">
                        <img src="{{ asset($viatura->foto) }}" alt="Foto atual" class="h-14 w-20 object-cover border border-white/10 rounded-sm">
                        <span class="font-mono text-[11px] text-[#8e90a2] uppercase tracking-wider">Fotografia atual em stock</span>
                    </div>
                @endif

                <input type="file" name="foto" accept="image/*"
                       class="w-full text-sm text-[#8e90a2] file:mr-4 file:py-2.5 file:px-4 file:rounded-sm file:border-0 file:text-xs file:font-mono file:uppercase file:tracking-wider file:bg-[#b8c3ff]/10 file:text-white hover:file:bg-[#b8c3ff]/20 file:cursor-pointer transition-all">
                @error('foto') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
                <span class="font-mono text-[10px] text-[#8e90a2]/60 uppercase tracking-wider block">Deixe em branco para manter a foto atual.</span>
            </div>

            <!-- Botão de Guardar -->
            <div class="flex justify-end items-center pt-4 border-t border-white/5">
                <button type="submit"
                        class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-6 py-3.5 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm cursor-pointer w-full md:w-auto justify-center">
                    <span class="material-symbols-outlined text-sm">save</span> Guardar Alterações
                </button>
            </div>

        </form>
    </div>
</main>

@endsection
