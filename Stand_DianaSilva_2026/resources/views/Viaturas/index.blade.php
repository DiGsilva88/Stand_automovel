@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Viaturas</h2>
    <a href="{{ route('viaturas.create') }}" class="btn btn-primary">Nova Viatura</a>
</div>

{{-- Formulário de pesquisa --}}
<form method="GET" action="{{ route('viaturas.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Pesquisar por marca, modelo ou matrícula..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
        @if(request('search'))
            <a href="{{ route('viaturas.index') }}" class="btn btn-outline-danger">Limpar</a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            @php
                $cols = ['id'=>'ID','marca'=>'Marca','modelo'=>'Modelo','ano'=>'Ano','preco'=>'Preço'];
                $ord  = request('ordenar','id');
                $dir  = request('direcao','asc');
                $newDir = $dir === 'asc' ? 'desc' : 'asc';
            @endphp
            @foreach($cols as $col => $label)
                <th>
                    <a href="{{ request()->fullUrlWithQuery(['ordenar'=>$col,'direcao'=>$ord===$col?$newDir:'asc']) }}"
                       class="text-white text-decoration-none">
                        {{ $label }}
                        @if($ord === $col)
                            {{ $dir === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
            @endforeach
            <th>Estado</th><th>Foto</th><th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($viaturas as $viatura)
        <tr>
            <td>{{ $viatura->id }}</td>
            <td>{{ $viatura->marca }}</td>
            <td>{{ $viatura->modelo }}</td>
            <td>{{ $viatura->ano }}</td>
            <td>{{ number_format($viatura->preco, 2, ',', '.') }} €</td>
            <td>
                <span class="badge {{ $viatura->estado === 'disponivel' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($viatura->estado) }}
                </span>
            </td>
            <td>
                @if($viatura->foto)
                    <img src="{{ asset('storage/' . $viatura->foto) }}"
                         width="60" class="rounded">
                @else
                    <span class="text-muted">Sem foto</span>
                @endif
            </td>
            <td>
                <a href="{{ route('viaturas.show', $viatura) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('viaturas.edit', $viatura) }}" class="btn btn-sm btn-warning">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $viaturas->links() }}
@endsection
