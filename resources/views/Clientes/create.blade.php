@extends('layouts.app')

@section('title', 'Novo Cliente — AETHER MOTORS')

@section('content')

<!-- Link de Retorno Superior -->
<div class="mb-8">
    <a href="{{ route('clientes.index') }}" class="font-mono text-xs uppercase tracking-widest text-aether-gray hover:text-aether-blue transition-colors inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-sm" style="font-size: 16px;">arrow_back</span> Back to Relations
    </a>
</div>

<!-- Cabeçalho do Formulário -->
<header class="mb-12 pb-6 border-b border-white/5">
    <span class="text-xs font-mono tracking-widest text-aether-blue uppercase block mb-1">CRM RELATIONSHIP HUB</span>
    <h1 class="font-sora text-4xl font-bold text-white uppercase tracking-tighter">Add New Member</h1>
    <p class="text-sm text-aether-gray mt-1">Registe a ficha de relações de confiança e dados fiscais do novo cliente no sistema.</p>
</header>

<!-- Contentor do Formulário Estilo Glass Card -->
<div class="glass-card p-8 rounded-2xl max-w-4xl mx-auto">
    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6 font-mono text-xs uppercase tracking-wider text-aether-gray">
        @csrf

        <!-- Grelha de Campos Principais -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Nome Completo -->
            <div class="flex flex-col gap-2 md:col-span-2">
                <label class="text-white/40 font-bold">FULL NAME *</label>
                <input type="text" name="nome" value="{{ old('nome') }}"
                       class="w-full bg-white/[0.02] border @error('nome') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal font-sans">
                @error('nome')
                    <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- E-mail -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">EMAIL ADDRESS *</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="username@domain.com"
                       class="w-full bg-white/[0.02] border @error('email') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal placeholder-white/5 font-sans">
                @error('email')
                    <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Telefone -->
            <div class="flex flex-col gap-2">
                <label class="text-white/40 font-bold">CONTACT NUMBER</label>
                <input type="text" name="telefone" value="{{ old('telefone') }}" placeholder="9xx xxx xxx"
                       class="w-full bg-white/[0.02] border @error('telefone') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal font-sans">
                @error('telefone')
                    <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- NIF -->
            <div class="flex flex-col gap-2 md:col-span-2 border-t border-white/5 pt-4 mt-2">
                <label class="text-white/40 font-bold">TAX IDENTIFICATION NUMBER (NIF)</label>
                <input type="text" name="nif" value="{{ old('nif') }}" placeholder="2xxxxxxx" max="9"
                       class="w-full bg-white/[0.02] border @error('nif') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal max-w-md font-sans">
                @error('nif')
                    <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                    </span>
                @enderror
            </div>

        </div>

        <!-- Matriz de Submissão Corporativa -->
        <div class="pt-6 border-t border-white/5 flex flex-col sm:flex-row gap-4 font-mono text-xs uppercase tracking-widest font-bold">
            <button type="submit" class="flex-1 py-3.5 bg-aether-electric hover:bg-aether-blue hover:text-aether-dark-blue text-white text-center rounded-sm transition-colors block">
                Save Member Record
            </button>
            <a href="{{ route('clientes.index') }}" class="flex-1 py-3.5 border border-white/10 hover:border-white text-white text-center rounded-sm transition-colors block">
                Cancel Operation
            </a>
        </div>
    </form>
</div>

@endsection
