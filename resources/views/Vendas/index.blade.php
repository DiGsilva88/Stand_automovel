@extends('layouts.app')
@section('title', 'Vendas — SS Motors')

@section('content')

<!-- Cabeçalho da Página Estilo Aether -->
<header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-gray-100">
    <div>
        <span class="text-xs font-bold tracking-widest text-blue-600 uppercase block mb-1">Painel Comercial</span>
        <h1 class="text-4xl font-extrabold text-black uppercase tracking-tighter font-sora">Vendas</h1>
        <p class="text-sm text-gray-500 mt-1">Histórico de transações e contratos digitais do stand.</p>
    </div>
    <a href="{{ route('vendas.create') }}"
       class="px-6 py-3 bg-brand-blue text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:opacity-90 transition inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">add</span> Nova Venda
    </a>
</header>

<!-- Tabela Minimalista Premium de Alto Contraste -->
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                    <th class="p-5 text-xs font-bold uppercase tracking-wider text-gray-400 font-mono w-16">#</th>
                    <th class="p-5 text-xs font-bold uppercase tracking-wider text-gray-400 font-sora">Viatura</th>
                    <th class="p-5 text-xs font-bold uppercase tracking-wider text-gray-400 font-sora hidden md:table-cell">Cliente</th>
                    <th class="p-5 text-xs font-bold uppercase tracking-wider text-gray-400 font-mono hidden lg:table-cell">Data</th>
                    <th class="p-5 text-xs font-bold uppercase tracking-wider text-gray-400 font-sora text-right">Valor Comercial</th>
                    <th class="p-5 w-40"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($vendas as $venda)
                <tr class="hover:bg-gray-50/50 transition duration-150 group">
                    <!-- ID Comercial -->
                    <td class="p-5 font-mono text-xs text-gray-400">
                        {{ str_pad($venda->id, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <!-- Nome da Viatura -->
                    <td class="p-5 font-sora text-sm font-bold text-gray-900 uppercase tracking-tight">
                        {{ $venda->viatura->marca ?? 'N/D' }}
                        <span class="text-gray-400 font-normal">{{ $venda->viatura->modelo ?? '' }}</span>
                    </td>

                    <!-- Nome do Cliente -->
                    <td class="p-5 text-sm text-gray-600 hidden md:table-cell">
                        {{ $venda->cliente->nome ?? 'N/D' }}
                    </td>

                    <!-- Data Formatada -->
                    <td class="p-5 text-xs font-mono text-gray-500 hidden lg:table-cell">
                        {{ \Carbon\Carbon::parse($venda->data_venda)->format('d.m.Y') }}
                    </td>

                    <!-- Valor Total em Azul Elétrico -->
                    <td class="p-5 text-right font-sora font-extrabold text-blue-600 text-sm tracking-tight">
                        {{ number_format($venda->valor_total, 0, ',', '.') }} €
                    </td>

                    <!-- Ações Laterais Limpas -->
                    <td class="p-5">
                        <div class="flex justify-end gap-4 text-xs font-bold uppercase tracking-wider">
                            <a href="{{ route('vendas.show', $venda->id) }}"
                               class="text-gray-400 hover:text-black transition flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">visibility</span> Ver
                            </a>
                            <a href="{{ route('vendas.edit', $venda->id) }}"
                               class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">edit</span> Editar
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <!-- Fallback Sem Registos -->
                <tr>
                    <td colspan="6" class="p-20 text-center text-gray-400">
                        <span class="material-symbols-outlined text-4xl block mb-3 text-gray-200">receipt_long</span>
                        <p class="text-xs font-bold uppercase tracking-widest font-mono">Nenhuma transação comercial registada.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
