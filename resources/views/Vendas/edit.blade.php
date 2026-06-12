@extends('layouts.app')
@section('content')
<h2>Editar Venda #{{ $venda->id }}</h2>
<form action="{{ route('vendas.update', $venda) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Cliente *</label>
        <select name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
            <option value="">-- Selecionar Cliente --</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente_id', $venda->cliente_id) == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }} (NIF: {{ $cliente->nif }})
                </option>
            @endforeach
        </select>
        @error('cliente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Viatura *</label>
        <select name="viatura_id" class="form-select @error('viatura_id') is-invalid @enderror">
            <option value="">-- Selecionar Viatura --</option>
            @foreach($viaturas as $viatura)
                <option value="{{ $viatura->id }}" {{ old('viatura_id', $venda->viatura_id) == $viatura->id ? 'selected' : '' }}>
                    {{ $viatura->marca }} {{ $viatura->modelo }}
                    @if($viatura->ano) — {{ $viatura->ano }} @endif
                    — {{ number_format($viatura->preco,2,',','.') }} €
                </option>
            @endforeach
        </select>
        @error('viatura_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Data da Venda *</label>
        <input type="date" name="data_venda" class="form-control @error('data_venda') is-invalid @enderror"
               value="{{ old('data_venda', \Carbon\Carbon::parse($venda->data_venda)->format('Y-m-d')) }}">
        @error('data_venda') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Valor da Venda (€) *</label>
        <input type="number" name="valor_venda" step="0.01" class="form-control @error('valor_venda') is-invalid @enderror"
               value="{{ old('valor_venda', $venda->valor_venda) }}">
        @error('valor_venda') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Observações</label>
        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $venda->observacoes) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Alterações</button>
    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
