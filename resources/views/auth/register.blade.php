@extends('layouts.app')
@section('title', 'Criar Conta — SS Automóveis')

@section('content')
<main class="min-h-[90vh] flex flex-col justify-center items-center px-6 md:px-20 py-12 bg-[#131313]">

    <!-- Card de Registo Estilo Glassmorphism -->
    <div class="w-full max-w-md bg-[#141313] border border-white/5 rounded-sm p-6 md:p-10 shadow-2xl space-y-8">

        <!-- Cabeçalho Interno -->
        <div class="text-center space-y-2">
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block">Customer Portal</span>
            <h1 class="text-3xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">Registar</h1>
            <p class="text-xs font-mono text-[#8e90a2] uppercase tracking-wider">Abra a sua conta digital no ecossistema SS Motors.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Nome Completo -->
            <div class="flex flex-col space-y-2">
                <label for="name" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Nome Completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ex: Diana Silva"
                       class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-sora transition-colors">
                @error('name') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Endereço de E-mail -->
            <div class="flex flex-col space-y-2">
                <label for="email" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">E-mail Pessoal</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nome@exemplo.com"
                       class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-mono transition-colors">
                @error('email') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Campo Telefone Adicionado -->
<div class="flex flex-col space-y-2">
    <label for="telefone" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Contacto Telefónico</label>
    <input id="telefone" type="text" name="telefone" value="{{ old('telefone') }}" required placeholder="Ex: 9xx xxx xxx"
           class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm font-mono text-white focus:outline-none focus:border-[#b8c3ff]/50 transition-colors">
    @error('telefone') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
</div>


            <!-- Palavra-passe -->
            <div class="flex flex-col space-y-2">
                <label for="password" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Definir Palavra-passe</label>
                <input id="password" type="password" name="password" required placeholder="Mínimo 8 caracteres"
                       class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-mono transition-colors">
                @error('password') <span class="text-xs text-red-400 font-mono mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmar Palavra-passe -->
            <div class="flex flex-col space-y-2">
                <label for="password_confirmation" class="font-mono text-[10px] text-[#8e90a2] uppercase tracking-widest font-medium">Confirmar Palavra-passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repita a palavra-passe"
                       class="w-full bg-[#1a1a1a] border border-white/10 rounded-sm px-4 py-3 text-sm text-white focus:outline-none focus:border-[#b8c3ff]/50 font-mono transition-colors">
            </div>

            <!-- Botão de Ação e Link de Regresso -->
            <div class="space-y-4 pt-3">
                <button type="submit"
                        class="w-full font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 py-3.5 flex items-center justify-center gap-2 uppercase tracking-widest transition-all rounded-sm cursor-pointer font-bold">
                    <span class="material-symbols-outlined text-sm">app_registration</span> Concluir Registo
                </button>

                <p class="text-center font-mono text-[10px] text-[#8e90a2] uppercase tracking-wider">
                    Já possui um perfil?
                    <a href="{{ route('login') }}" class="text-[#b8c3ff] hover:text-white transition-colors ml-1 font-bold">Iniciar Sessão</a>
                </p>
            </div>
        </form>

    </div>
</main>
@endsection
