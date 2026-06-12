@extends('layouts.app')
@section('content')
<h2>{{ $viatura->marca }} {{ $viatura->modelo }}</h2>

<div class="card">
    @if($viatura->foto)
        <img src="{{ asset($viatura->foto) }}" class="card-img-top" style="max-height: 300px; object-fit: cover;">
    @endif
    <div class="card-body">
        <p><strong>Matrícula:</strong> {{ $viatura->matricula }}</p>
        <p><strong>Ano:</strong> {{ $viatura->ano }}</p>
        <p><strong>Quilómetros:</strong> {{ number_format($viatura->quilometros, 0, ',', '.') }} km</p>
        <p><strong>Preço:</strong> {{ number_format($viatura->preco, 2, ',', '.') }} €</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $viatura->estado === 'Disponível' ? 'bg-success' : 'bg-danger' }}">
                {{ $viatura->estado }}
            </span>
        </p>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('viaturas.edit', $viatura) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('viaturas.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
