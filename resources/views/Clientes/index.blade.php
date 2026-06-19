@extends('layouts.app')

@section('title', 'Clientes - SS Automóveis')

@section('content')

<!-- Contentor Principal Uniformizado com as Vendas e Página Inicial -->
<main class="px-6 md:px-20 pt-28 md:pt-36 pb-24 max-w-[1440px] mx-auto bg-[#131313]">

    <!-- Cabeçalho da Página -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-12 border-b border-white/5 pb-6">
        <div>
            <span class="font-mono text-xs tracking-widest text-[#b8c3ff] uppercase block mb-1">Relações de Confiança</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter" style="font-family: 'Sora', sans-serif;">Clientes Registados</h1>
        </div>

        <a href="{{ route('clientes.create') }}"
           class="font-mono text-xs text-white bg-[#b8c3ff]/10 hover:bg-[#b8c3ff]/20 border border-[#b8c3ff]/30 px-6 py-3 flex items-center gap-2 uppercase tracking-widest transition-all rounded-sm group">
            <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">person_add</span>
            Novo Cliente
        </a>
    </div>

    <!-- Card Principal com Tabela (Estilo Glassmorphism Premium) -->
    <div class="w-full bg-[#141313] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="border-b border-white/5 bg-[#1a1a1a]">
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2]" style="font-family: 'Sora', sans-serif;">Nome</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2]" style="font-family: 'Sora', sans-serif;">E-mail</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2] font-mono">Telefone</th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-[#8e90a2] font-mono">NIF</th>
                        <th class="p-5 w-32 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($clientes as $cliente)
                        <tr class="hover:bg-white/[0.02] transition duration-150 group">
                            <!-- Nome com Link Estilizado -->
                            <td class="p-5">
                                <a href="{{ route('clientes.show', $cliente->id) }}"
                                   class="text-sm font-bold text-white uppercase tracking-tight group-hover:text-[#b8c3ff] transition duration-150"
                                   style="font-family: 'Sora', sans-serif;">
                                    {{ $cliente->nome }}
                                </a>
                            </td>

                            <!-- E-mail -->
                            <td class="p-5 text-xs font-mono text-[#8e90a2] group-hover:text-white/90 transition-colors">
                                {{ $cliente->email }}
                            </td>

                            <!-- Telefone -->
                            <td class="p-5 text-xs font-mono text-white/90">
                                {{ $cliente->telefone ?? '—' }}
                            </td>

                            <!-- NIF -->
                            <td class="p-5 text-xs font-mono text-white/90">
                                {{ $cliente->nif ?? '—' }}
                            </td>

                            <!-- Ação Ficha -->
                            <td class="p-5 text-right">
                                <div class="flex justify-end font-mono text-xs uppercase tracking-wider">
                                    <a href="{{ route('clientes.show', $cliente->id) }}"
                                       class="text-[#8e90a2] hover:text-white transition flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        Ficha
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center text-[#8e90a2]">
                                <span class="material-symbols-outlined text-4xl text-white/10 block mb-3">person_search</span>
                                <p class="text-xs font-bold uppercase tracking-widest font-mono">Nenhum cliente registado no sistema.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginação Adaptada ao Estilo Dark -->
    <div class="mt-8 dark-pagination">
        {{ $clientes->links() }}
    </div>

</main>

@endsection
