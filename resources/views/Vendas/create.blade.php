@extends('layouts.app')
@section('content')
<h2>Registar Venda</h2>
<form action="{{ route('vendas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Cliente *</label>
        <select name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
            <option value="">-- Selecionar Cliente --</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }} (NIF: {{ $cliente->nif }})
                </option>
            @endforeach
        </select>
        @error('cliente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Viatura *</label>
        @if($viaturas->isEmpty())
            <div class="alert alert-warning">Não há viaturas disponíveis para venda.</div>
        @else
            <select name="viatura_id" class="form-select @error('viatura_id') is-invalid @enderror">
                <option value="">-- Selecionar Viatura --</option>
                @foreach($viaturas as $viatura)
                    <option value="{{ $viatura->id }}">
                        {{ $viatura->marca }} {{ $viatura->modelo }}
                        — {{ $viatura->matricula }}
                        — {{ number_format($viatura->preco,2,',','.') }} €
                    </option>
                @endforeach
            </select>
            @error('viatura_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @endif
    </div>

    <div class="mb-3">
        <label>Data da Venda *</label>
        <input type="date" name="data_venda" class="form-control" value="{{ old('data_venda', date('Y-m-d')) }}">
    </div>

    <div class="mb-3">
        <label>Valor da Venda (€) *</label>
        <input type="number" name="valor_venda" step="0.01" class="form-control" value="{{ old('valor_venda') }}">
    </div>

    <div class="mb-3">
        <label>Observações</label>
        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Registar Venda</button>
    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
