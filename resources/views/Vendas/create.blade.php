@extends('layouts.app')

@section('title', 'Registar Venda — AETHER MOTORS')

@section('content')

<!-- Link de Retorno Superior -->
<div class="mb-8">
    <a href="{{ route('vendas.index') }}" class="font-mono text-xs uppercase tracking-widest text-aether-gray hover:text-aether-blue transition-colors inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-sm" style="font-size: 16px;">arrow_back</span> Back to Ledger
    </a>
</div>

<!-- Cabeçalho do Formulário -->
<header class="mb-12 pb-6 border-b border-white/5">
    <span class="text-xs font-mono tracking-widest text-aether-blue uppercase block mb-1">TRANSACTION LOGGING</span>
    <h1 class="font-sora text-4xl font-bold text-white uppercase tracking-tighter">New Sale Record</h1>
    <p class="text-sm text-aether-gray mt-1">Registe a liquidação comercial, associando a viatura ao cliente adquirente.</p>
</header>

<!-- Contentor do Formulário Estilo Glass Card -->
<div class="glass-card p-8 rounded-2xl max-w-3xl mx-auto">
    <form action="{{ route('vendas.store') }}" method="POST" class="space-y-6 font-mono text-xs uppercase tracking-wider text-aether-gray">
        @csrf

        <!-- Seleção de Viatura -->
        <div class="flex flex-col gap-2">
            <label class="text-white/40 font-bold" for="viatura_id">VEHICLE ASSET *</label>
            <select name="viatura_id" id="viatura_id"
                    class="w-full bg-[#131313] border @error('viatura_id') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-wider font-sans text-sm">
                <option value="" class="bg-[#131313]">SELECIONE A VIATURA TRANSACIONADA...</option>
                @foreach($viaturas as $viatura)
                    <option value="{{ $viatura->id }}" {{ (old('viatura_id') == $viatura->id || request('viatura_id') == $viatura->id) ? 'selected' : '' }} class="bg-[#131313]">
                        {{ strtoupper($viatura->marca) }} {{ strtoupper($viatura->modelo) }} — {{ number_format($viatura->preco ?? 0, 0, ',', '.') }} € ({{ $viatura->ano }})
                    </option>
                @endforeach
            </select>
            @error('viatura_id')
                <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                </span>
            @enderror
        </div>

        <!-- Seleção de Cliente -->
        <div class="flex flex-col gap-2">
            <label class="text-white/40 font-bold" for="cliente_id">CLIENT ACQUIRER *</label>
            <select name="cliente_id" id="cliente_id"
                    class="w-full bg-[#131313] border @error('cliente_id') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-wider font-sans text-sm">
                <option value="" class="bg-[#131313]">SELECIONE O CLIENTE DE DESTINO...</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }} class="bg-[#131313]">
                        {{ strtoupper($cliente->nome) }} (NIF: {{ $cliente->nif ?? 'N/D' }})
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                </span>
            @enderror
        </div>

        <!-- Valor Real da Venda -->
        <div class="flex flex-col gap-2">
            <label class="text-white/40 font-bold" for="valor_venda">FINAL TRANSACTION VALUE (€) *</label>
            <input type="number" name="valor_venda" id="valor_venda" step="0.01" value="{{ old('valor_venda') }}" placeholder="EX: 85000"
                   class="w-full bg-white/[0.02] border @error('valor_venda') border-red-500 text-red-400 @else border-white/10 text-white focus:border-aether-blue @enderror p-3 outline-none transition-colors rounded-sm tracking-normal font-sans text-sm placeholder-white/5">
            @error('valor_venda')
                <span class="text-red-400 font-mono text-[10px] mt-1 lowercase tracking-normal flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs" style="font-size: 12px;">error</span> {{ $message }}
                </span>
            @enderror
        </div>

        <!-- Matriz de Submissão Corporativa Retangular -->
        <div class="pt-6 border-t border-white/5 flex flex-col sm:flex-row gap-4 font-mono text-xs uppercase tracking-widest font-bold">
            <button type="submit" class="flex-1 py-3.5 bg-aether-electric hover:bg-aether-blue hover:text-aether-dark-blue text-white text-center rounded-sm transition-colors block">
                Commit & Log Transaction
            </button>
            <a href="{{ route('vendas.index') }}" class="flex-1 py-3.5 border border-white/10 hover:border-white text-white text-center rounded-sm transition-colors block">
                Abort Operation
            </a>
        </div>
    </form>
</div>

@endsection
