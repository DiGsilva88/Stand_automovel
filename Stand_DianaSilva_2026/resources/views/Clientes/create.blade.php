@extends('layouts.app')
@section('content')
<h2>Novo Cliente</h2>
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nome *</label>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
               value="{{ old('nome') }}">
        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label>Email *</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <!-- Repetir para telefone, morada, nif -->
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection


        {{-- Usa @error('campo') para mostrar erros de validação inline com Bootstrap is-invalid. --}}
        {{-- O valor old('campo') mantém o valor do campo após falha de validação. --}}
