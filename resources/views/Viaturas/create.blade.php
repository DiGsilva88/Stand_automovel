@extends('layouts.app')

@section('title', 'Nova Viatura — AETHER MOTORS')

@section('content')

<!-- Link de Retorno Superior -->
<div class="mb-8">
    <a href="{{ route('viaturas.index') }}" class="font-mono text-xs uppercase tracking-widest text-aether-gray hover:text-aether-blue transition-colors inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Back to Showroom
    </a>
</div>

<!-- Cabeçalho do Formulário -->
<header class="mb-12 pb-6 border-b border-white/5">
    <span class="text-xs font-mono tracking-widest text-aether-blue uppercase block mb-1">INVENTORY CONTROL</span>
    <h1 class="font-sora text-4xl font-bold text-white uppercase tracking-tighter">Add New Asset</h1>
    <p class="text-sm text-aether-gray mt-1">Insira as especificações técnicas e comerciais da viatura no catálogo.</p>
</header>

<!-- Contentor do Formulário Estilo Glass Card -->
<div class="glass-card p-8 rounded-2xl max-w-4xl mx-auto">
    <form action="{{ route('viaturas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-mono text-xs uppercase tracking-wider text-aether-gray">
        @csrf

        <!-- Grelha de Campos Principais -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Marca -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">MANUFACTURER *</label>
                <input type="text" name="marca" value="{{ old('marca') }}"
                       class="w-full bg-white/[0.02] border @error('marca') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal">
                @error('marca') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Modelo -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">MODEL SPECIFICATION *</label>
                <input type="text" name="modelo" value="{{ old('modelo') }}"
                       class="w-full bg-white/[0.02] border @error('modelo') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal">
                @error('modelo') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Matrícula -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">LICENSE PLATE *</label>
                <input type="text" name="matricula" value="{{ old('matricula') }}" placeholder="AA-00-AA"
                       class="w-full bg-white/[0.02] border @error('matricula') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal placeholder-white/10">
                @error('matricula') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Ano -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">PRODUCTION YEAR *</label>
                <input type="number" name="ano" value="{{ old('ano') }}" min="1900" max="{{ date('Y') }}"
                       class="w-full bg-white/[0.02] border @error('ano') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal">
                @error('ano') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Quilómetros -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">MILEAGE / KM *</label>
                <input type="number" name="quilometros" value="{{ old('quilometros') }}" min="0"
                       class="w-full bg-white/[0.02] border @error('quilometros') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal">
                @error('quilometros') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Preço -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">MARKET VALUE (€) *</label>
                <input type="number" step="0.01" name="preco" value="{{ old('preco') }}" min="0"
                       class="w-full bg-white/[0.02] border @error('preco') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal">
                @error('preco') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Estado -->
            <div class="flex flex-col gap-2 md:col-span-2">
                <label class="text-white/40 font-bold">STOCK ALLOCATION STATUS *</label>
                <select name="estado" class="w-full bg-[#131313] border @error('estado') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-wider">
                    <option value="Disponível" {{ old('estado') == 'Disponível' ? 'selected' : '' }}>DISPONÍVEL // SHOWROOM READY</option>
                    <option value="Vendido" {{ old('estado') == 'Vendido' ? 'selected' : '' }}>VENDIDO // ARCHIVED TRANSACTION</option>
                </select>
                @error('estado') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

            <!-- Fotografia -->
            <div class="flex flex-col gap-2 md:col-span-2 border-t border-white/5 pt-4 mt-2">
                <label class="text-white/40 font-bold">MEDIA ASSETS / PHOTOGRAPHY</label>
                <div class="relative w-full bg-white/[0.01] border border-dashed border-white/10 p-6 text-center rounded-sm hover:border-aether-blue transition-colors cursor-pointer group">
                    <input type="file" name="foto" accept="image/*"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="flex flex-col items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-2xl text-white/20 group-hover:text-aether-blue transition-colors">upload_file</span>
                        <p class="text-xs text-white tracking-widest uppercase">Click or Drag to Upload Image</p>
                        <p class="text-[10px] text-aether-gray tracking-normal normal-case font-sans">Formatos aceites: JPEG, PNG, JPG, GIF, SVG (Máx. 2MB).</p>
                    </div>
                </div>
                @error('foto') <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</span> @enderror
            </div>

        </div>

        <!-- Matriz de Submissão Corporativa -->
        <div class="pt-6 border-t border-white/5 flex flex-col sm:flex-row gap-4 font-mono text-xs uppercase tracking-widest font-bold">
            <button type="submit" class="flex-1 py-3.5 bg-aether-electric hover:bg-aether-blue hover:text-aether-dark-blue text-white text-center rounded-sm transition-colors block">
                Save Asset Specifications
            </button>
            <a href="{{ route('viaturas.index') }}" class="flex-1 py-3.5 border border-white/10 hover:border-white text-white text-center rounded-sm transition-colors block">
                Cancel Operations
            </a>
        </div>
    </form>
</div>

@endsection
