@extends('layouts.app')

@section('title', 'Login — AETHER MOTORS')

@section('content')

<div class="min-h-[calc(100vh-200px)] flex flex-col items-center justify-center py-6">

    <!-- Caixa de Autenticação Centralizada -->
    <div class="w-full max-w-md glass-card p-8 rounded-2xl shadow-2xl relative overflow-hidden">

        <!-- Cabeçalho Interno do Login -->
        <div class="text-center mb-8">
            <span class="text-[10px] font-mono tracking-[0.25em] text-aether-blue uppercase block mb-1">SECURE ACCESS</span>
            <h2 class="font-sora text-2xl font-bold text-white uppercase tracking-tighter">SÉRIE // LOGIN</h2>
            <p class="text-xs text-aether-gray mt-1 font-mono">Insira as suas credenciais para aceder ao terminal.</p>
        </div>

        <!-- Estado de Sessão Geral do Laravel (Se aplicável) -->
        @if (session('status'))
            <div class="mb-4 font-mono text-xs text-green-400 bg-green-500/10 border border-green-500/20 p-3 rounded-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6 font-mono text-xs uppercase tracking-wider text-aether-gray">
            @csrf

            <!-- Endereço de E-mail -->
            <div class="flex flex-col gap-2">
                <label for="email" class="text-white/40 font-bold">USER EMAIL *</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full bg-white/[0.02] border @error('email') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal font-sans text-sm">
                @error('email')
                    <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Palavra-passe -->
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-white/40 font-bold">PASSWORD *</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[10px] text-aether-gray hover:text-white transition-colors normal-case font-sans tracking-normal underline">
                            Esqueceu-se da senha?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full bg-white/[0.02] border @error('password') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal text-sm">
                @error('password')
                    <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Lembrar-me (Remember Me) -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-aether-gray hover:text-white transition-colors normal-case font-sans">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded-sm border-white/20 bg-transparent text-aether-blue focus:ring-0 focus:ring-offset-0">
                    <span>Lembrar-me neste dispositivo</span>
                </label>
            </div>

            <!-- Botão de Ação Retangular Unificado -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 bg-aether-electric hover:bg-aether-blue hover:text-aether-dark-blue text-white text-center rounded-sm transition-colors font-bold tracking-widest uppercase">
                    Initialize Session
                </button>
            </div>

            <!-- Link de Registo Alternativo -->
            @if (Route::has('register'))
                <div class="text-center pt-2 normal-case font-sans tracking-normal text-xs text-aether-gray">
                    Não tem conta comercial?
                    <a href="{{ route('register') }}" class="text-aether-blue hover:underline font-semibold">
                        Registe-se aqui
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

@endsection
