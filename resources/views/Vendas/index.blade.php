@extends('layouts.app')
@section('title', 'Vendas — SS Motors')

@section('content')

<!-- Contentor Principal Uniformizado com a Página Inicial -->
<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho da Página Estilo Imersivo SS Motors -->
    <header class="mb-12 flex justify-between items-end flex-wrap gap-4 pb-6 border-b border-white/5">
        <div>
            <span class="text-xs font-mono tracking-widest text-[#b8c3ff] uppercase block mb-1">Painel Comercial</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">Vendas</h1>
            <p class="text-xs font-mono text-[#8e90a2] uppercase tracking-wider mt-1">Histórico de transações e contratos digitais do stand.</p>
        </div>

        <a href="{{ route('vendas.create') }}"
           class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-6 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm group">
            <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">add</span> Nova Venda
        </a>
    </header>

    <!-- Tabela Minimalista Premium Dark -->
    <div class="w-full bg-[#141313] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="border-b border-white/5 bg-[#1a1a1a]">
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2] font-mono w-16 text-center">#</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2]" style="font-family: 'Sora', sans-serif;">Viatura</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2] hidden md:table-cell" style="font-family: 'Sora', sans-serif;">Cliente</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2] font-mono hidden lg:table-cell">Data</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2] text-right" style="font-family: 'Sora', sans-serif;">Valor Comercial</th>
                        <th class="p-5 w-44"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($vendas as $venda)
                    <tr class="hover:bg-white/[0.02] transition duration-150 group">

                        <!-- ID Comercial -->
                        <td class="p-5 font-mono text-xs text-[#8e90a2] text-center">
                            {{ str_pad($venda->id, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <!-- Nome da Viatura -->
                        <td class="p-5 text-sm font-bold text-white uppercase tracking-tight" style="font-family: 'Sora', sans-serif;">
                            {{ $venda->viatura->marca ?? 'N/D' }}
                            <span class="text-[#8e90a2] font-normal ml-1">{{ $venda->viatura->modelo ?? '' }}</span>
                        </td>

                        <!-- Nome do Cliente -->
                        <td class="p-5 text-sm text-white/90 hidden md:table-cell">
                            {{ $venda->cliente->nome ?? 'N/D' }}
                        </td>

                        <!-- Data Formatada -->
                        <td class="p-5 text-xs font-mono text-[#8e90a2] hidden lg:table-cell">
                            {{ \Carbon\Carbon::parse($venda->data_venda)->format('d.m.Y') }}
                        </td>

                        <!-- Valor Total em Azul Pastel Premium -->
                        <td class="p-5 text-right font-mono font-bold text-[#b8c3ff] text-sm tracking-wider">
                            {{ number_format($venda->valor_total, 0, ',', '.') }} €
                        </td>

                        <!-- Ações Laterais -->
                        <td class="p-5">
                            <div class="flex justify-end gap-5 font-mono text-xs uppercase tracking-wider">
                                <a href="{{ route('vendas.show', $venda->id) }}"
                                   class="text-[#8e90a2] hover:text-white transition flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">visibility</span> Ver
                                </a>
                                <a href="{{ route('vendas.edit', $venda->id) }}"
                                   class="text-[#8e90a2] hover:text-[#b8c3ff] transition flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">edit</span> Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- Fallback Sem Registos -->
                    <tr>
                        <td colspan="6" class="p-20 text-center text-[#8e90a2]">
                            <span class="material-symbols-outlined text-4xl block mb-3 text-white/10">receipt_long</span>
                            <p class="text-xs font-bold uppercase tracking-widest font-mono">Nenhuma transação comercial registada.</p>
                        </td>
                    </tr>
@endforelse

                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection
