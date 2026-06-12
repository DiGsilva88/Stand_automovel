@extends('layouts.app')
@section('content')
<h2>Detalhes da Venda #{{ $venda->id }}</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Cliente:</strong> {{ $venda->cliente->nome ?? '-' }}</p>
        <p><strong>Email do Cliente:</strong> {{ $venda->cliente->email ?? '-' }}</p>
        <p><strong>NIF do Cliente:</strong> {{ $venda->cliente->nif ?? '-' }}</p>

        <hr>

        <p><strong>Viatura:</strong>
            @if($venda->viatura)
                {{ $venda->viatura->marca }} {{ $venda->viatura->modelo }} ({{ $venda->viatura->ano ?? '-' }})
            @else
                -
            @endif
        </p>

        <hr>

        <p><strong>Data da Venda:</strong> {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</p>
        <p><strong>Valor da Venda:</strong> {{ number_format($venda->valor_venda, 2, ',', '.') }} €</p>
        <p><strong>Observações:</strong> {{ $venda->observacoes ?? 'Sem observações.' }}</p>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('vendas.edit', $venda) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
