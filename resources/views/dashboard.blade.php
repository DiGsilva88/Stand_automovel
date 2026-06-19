@extends('layouts.app')

@section('title', 'A Minha Garagem | SS Automóveis')

@section('content')

<style>
    .glass-card {
        background: rgba(28, 27, 27, 0.4);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s cubic-bezier(0.2, 0, 0, 1);
    }
    .glass-card:hover { transform: translateY(-4px); }
</style>



<header class="mb-12">
    <span class="font-mono text-[11px] tracking-widest uppercase block mb-1" style="color:#b8c3ff;">CUSTOMER PORTAL</span>
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-2" style="font-family: Sora, sans-serif;">A MINHA GARAGEM</h1>
    <p class="text-sm max-w-2xl" style="color:#c4c5d9;">Aceda às viaturas que guardou como favoritas no nosso showroom.</p>
</header>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @forelse($meusFavoritos ?? [] as $favorito)
        @if($favorito->viatura)
        <div class="glass-card overflow-hidden group flex flex-col justify-between">
            <div class="aspect-[16/10] overflow-hidden relative" style="background:#1c1b1b;">
                @if($favorito->viatura->foto)
                    <img src="{{ asset($favorito->viatura->foto) }}" alt="{{ $favorito->viatura->marca }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl" style="color:#8e90a2;">directions_car</span>
                    </div>
                @endif
            </div>
            <div class="p-5 flex-grow flex flex-col justify-between">
                <div class="mb-4">
                    <span class="font-mono text-[10px] uppercase tracking-widest block mb-1" style="color:#8e90a2;">
                        {{ $favorito->viatura->marca }}
                    </span>
                    <h3 class="text-lg text-white font-bold uppercase truncate" style="font-family: Sora, sans-serif;">
                        {{ $favorito->viatura->modelo }}
                    </h3>
                </div>
                <div class="pt-4 border-t flex justify-between items-center font-mono text-xs" style="border-color: rgba(255,255,255,0.05);">
                    <span class="font-bold text-sm" style="color:#b8c3ff;">
                        {{ number_format($favorito->viatura->preco ?? 0, 0, ',', '.') }} €
                    </span>
                    <a href="{{ route('viaturas.index') }}" class="text-white hover:underline uppercase tracking-wider transition-colors">
                        Ver Ficha
                    </a>
                </div>
            </div>
        </div>
        @endif
    @empty
        <div class="col-span-full border border-dashed p-16 text-center font-mono text-xs uppercase tracking-widest"
             style="border-color: rgba(255,255,255,0.1); color:#8e90a2;">
            A sua garagem de favoritos está vazia.
        </div>
    @endforelse
</div>

@endsection
