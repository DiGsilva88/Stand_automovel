<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stand de Viaturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <i class="bi bi-car-front"></i> Stand Viaturas
    </a>
    <div class="navbar-nav">
      <a class="nav-link" href="{{ route('dashboard') }}">Painel</a>
      <a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a>
      <a class="nav-link" href="{{ route('viaturas.index') }}">Viaturas</a>
      <a class="nav-link" href="{{ route('vendas.index') }}">Vendas</a>
    </div>

    <div class="navbar-nav ms-auto">
      @auth
        <span class="nav-link text-light">
          <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
        </span>
        <form action="{{ route('logout') }}" method="POST" class="d-flex">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-light ms-2">Sair</button>
        </form>
      @else
        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
        <a class="nav-link" href="{{ route('register') }}">Registar</a>
      @endauth
    </div>
  </div>
</nav>

<div class="container mt-4">

    {{-- Mensagens de sucesso/erro --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
