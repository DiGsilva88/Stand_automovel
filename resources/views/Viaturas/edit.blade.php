@extends('layouts.app')

@section('title', 'Editar Viatura #' . $viatura->id)

@section('content')

<a href="{{ route('viaturas.index') }}" class="back-link">&larr; Cancelar e Voltar</a>

<div class="page-header">
    <div>
        <div class="page-eyebrow">Stock</div>
        <h1 class="page-title">Editar Viatura #{{ $viatura->id }}</h1>
    </div>
</div>

<div class="form-section">
    <form action="{{ route('viaturas.update', $viatura->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Marca *</label>
            <input type="text" name="marca" class="form-input @error('marca') is-invalid @enderror" value="{{ old('marca', $viatura->marca) }}" required>
            @error('marca') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Modelo *</label>
            <input type="text" name="modelo" class="form-input @error('modelo') is-invalid @enderror" value="{{ old('modelo', $viatura->modelo) }}" required>
            @error('modelo') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Ano *</label>
            <input type="number" name="ano" class="form-input @error('ano') is-invalid @enderror" value="{{ old('ano', $viatura->ano) }}" required>
            @error('ano') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Quilómetros *</label>
            <input type="number" name="quilometros" class="form-input @error('quilometros') is-invalid @enderror" value="{{ old('quilometros', $viatura->quilometros) }}" required>
            @error('quilometros') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Preço (€) *</label>
            <input type="number" name="preco" step="0.01" class="form-input @error('preco') is-invalid @enderror" value="{{ old('preco', str_replace(',', '.', $viatura->preco)) }}" required>
            @error('preco') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Estado *</label>
            <select name="estado" class="form-input @error('estado') is-invalid @enderror">
                <option value="Disponível" {{ old('estado', $viatura->estado) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                <option value="Vendido" {{ old('estado', $viatura->estado) == 'Vendido' ? 'selected' : '' }}>Vendido</option>
            </select>
            @error('estado') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Fotografia</label>
            @if(!empty($viatura->foto))
                <div style="display:flex; align-items:center; gap:18px; padding:12px; background:var(--surface-container-lowest); border:1px solid rgba(255,255,255,0.08); border-radius:8px;">
                    {{-- CORRIGIDO: $viatura->foto já inclui o prefixo "fotos/", por isso usa-se asset() diretamente sem duplicar a pasta --}}
                    <img src="{{ asset($viatura->foto) }}" alt="Foto atual" style="height:60px; width:auto; object-fit:contain;">
                    <span style="font-size:12px; color:var(--outline);">Foto atual em stock</span>
                </div>
            @endif
            <input type="file" name="foto" class="form-input @error('foto') is-invalid @enderror" style="margin-top:10px;" accept="image/*">
            @error('foto') <span class="form-error">{{ $message }}</span> @enderror
            <span class="form-hint">Deixe em branco para manter a foto atual.</span>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Guardar Alterações</button>
    </form>
</div>

@endsection
