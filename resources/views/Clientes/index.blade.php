@extends('layouts.app')

@section('title', 'Clientes - SS Automóveis')

@section('content')

<!-- Cabeçalho da Página -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <span class="font-mono text-xs font-semibold tracking-widest text-surface-tint uppercase block mb-1">Relações de Confiança</span>
        <h1 class="font-sora text-3xl font-bold text-white">Clientes Registados</h1>
    </div>
    <a href="{{ route('clientes.create') }}" class="inline-flex items-center gap-2 bg-surface-tint text-neutral-900 px-5 py-2.5 rounded-xl font-sora font-semibold text-sm hover:opacity-90 transition duration-300 shadow-lg shadow-surface-tint/10">
        <span class="material-symbols-outlined text-xl">person_add</span>
        Novo Cliente
    </a>
</div>

<!-- Card Principal com Tabela (Estilo Glassmorphism) -->
<div class="glass-card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-white/[0.02]">
                    <th class="p-4 font-sora text-xs font-semibold uppercase tracking-wider text-tertiary-fixed-dim">Nome</th>
                    <th class="p-4 font-sora text-xs font-semibold uppercase tracking-wider text-tertiary-fixed-dim">E-mail</th>
                    <th class="p-4 font-sora text-xs font-semibold uppercase tracking-wider text-tertiary-fixed-dim">Telefone</th>
                    <th class="p-4 font-sora text-xs font-semibold uppercase tracking-wider text-tertiary-fixed-dim">NIF</th>
                    <th class="p-4 font-sora text-xs font-semibold uppercase tracking-wider text-tertiary-fixed-dim text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($clientes as $cliente)
                    <tr class="hover:bg-white/[0.01] transition duration-150 group">
                        <td class="p-4">
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="font-semibold text-white group-hover:text-surface-tint transition duration-150">
                                {{ $cliente->nome }}
                            </a>
                        </td>
                        <td class="p-4 text-sm text-secondary-fixed-dim">{{ $cliente->email }}</td>
                        <td class="p-4 text-sm font-mono text-secondary-fixed-dim">{{ $cliente->telefone ?? '—' }}</td>
                        <td class="p-4 text-sm font-mono text-secondary-fixed-dim">{{ $cliente->nif ?? '—' }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="inline-flex items-center gap-1 border border-white/10 hover:border-surface-tint text-secondary-fixed-dim hover:text-neutral-900 hover:bg-surface-tint px-3 py-1.5 rounded-xl text-xs font-medium transition duration-300">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                Ficha
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-secondary-fixed-dim">
                            <span class="material-symbols-outlined text-4xl text-white/20 block mb-2">person_search</span>
                            <p class="text-sm">Nenhum cliente registado no sistema.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Paginação Adaptada ao Estilo Dark -->
<div class="mt-6 dark-pagination">
    {{ $clientes->links() }}
</div>

@endsection
