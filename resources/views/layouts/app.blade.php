<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stand de Viaturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .navbar-toggler {
            border: none;
            background: transparent;
            padding: 0.25rem 0.5rem;
            line-height: 1;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <i class="bi bi-car-front"></i> Stand Viaturas
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list text-white" style="font-size: 1.5rem;"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
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
  </div>
</nav>

<div class="container mt-4">

    {{-- Mensagens de sucesso/erro --}}
    {{-- //As mensagens flash (session('success')) aparecem automaticamente após cada operação CRUD. --}}
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
<script>
  // Fallback manual para o menu hambúrguer, caso o JS do Bootstrap não carregue
  document.addEventListener('DOMContentLoaded', function () {
    var toggler = document.querySelector('.navbar-toggler');
    var menu = document.getElementById('navbarNav');
    if (toggler && menu) {
      toggler.addEventListener('click', function () {
        menu.classList.toggle('show');
      });
    }
  });
</script>
</body>
</html>
