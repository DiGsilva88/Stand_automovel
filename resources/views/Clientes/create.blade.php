@extends('layouts.app')

@section('title', 'Novo Cliente')

@section('content')

<a href="{{ route('clientes.index') }}" class="back-link">&larr; Cancelar e Voltar</a>

<div class="page-header">
    <div>
        <div class="page-eyebrow">Relações de Confiança</div>
        <h1 class="page-title">Novo Cliente</h1>
    </div>
</div>

<div class="form-section">
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Nome *</label>
            <input type="text" name="nome" class="form-input @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
            @error('nome') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        {{-- CORRIGIDO: o formulário não tinha os campos telefone, morada e nif,
             apesar de serem exigidos pela validação no controller. --}}
        <div class="form-group">
            <label class="form-label">Telefone *</label>
            <input type="text" name="telefone" class="form-input @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}">
            @error('telefone') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Morada *</label>
            <input type="text" name="morada" class="form-input @error('morada') is-invalid @enderror" value="{{ old('morada') }}">
            @error('morada') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">NIF *</label>
            <input type="text" name="nif" maxlength="9" class="form-input @error('nif') is-invalid @enderror" value="{{ old('nif') }}">
            @error('nif') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline btn-block">Cancelar</a>
        </div>
    </form>
</div>

@endsection
