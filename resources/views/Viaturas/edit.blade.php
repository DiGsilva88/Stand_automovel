@extends('layouts.app')
@section('content')
<h2>Editar Viatura #{{ $viatura->id }}</h2>
<form action="{{ route('viaturas.update', $viatura) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Marca *</label>
        <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror"
               value="{{ old('marca', $viatura->marca) }}">
        @error('marca') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Modelo *</label>
        <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror"
               value="{{ old('modelo', $viatura->modelo) }}">
        @error('modelo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Matrícula *</label>
        <input type="text" name="matricula" class="form-control @error('matricula') is-invalid @enderror"
               value="{{ old('matricula', $viatura->matricula) }}" placeholder="AA-00-AA">
        @error('matricula') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Ano *</label>
        <input type="number" name="ano" class="form-control @error('ano') is-invalid @enderror"
               value="{{ old('ano', $viatura->ano) }}" min="1900" max="{{ date('Y') }}">
        @error('ano') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Quilómetros *</label>
        <input type="number" name="quilometros" class="form-control @error('quilometros') is-invalid @enderror"
               value="{{ old('quilometros', $viatura->quilometros) }}" min="0">
        @error('quilometros') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Preço (€) *</label>
        <input type="number" step="0.01" name="preco" class="form-control @error('preco') is-invalid @enderror"
               value="{{ old('preco', $viatura->preco) }}" min="0">
        @error('preco') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Estado *</label>
        <select name="estado" class="form-select @error('estado') is-invalid @enderror">
            <option value="Disponível" {{ old('estado', $viatura->estado) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
            <option value="Vendido" {{ old('estado', $viatura->estado) == 'Vendido' ? 'selected' : '' }}>Vendido</option>
        </select>
        @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Fotografia</label>
        @if($viatura->foto)
            <div class="mb-2">
                <img src="{{ asset($viatura->foto) }}" width="150" class="rounded d-block mb-2">
            </div>
        @endif
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Deixa em branco para manter a foto atual.</small>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Alterações</button>
    <a href="{{ route('viaturas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
