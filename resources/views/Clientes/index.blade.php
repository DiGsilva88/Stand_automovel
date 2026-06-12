<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS Automóveis — Gestão de Clientes</title>
<link href="https://googleapis.com" rel="stylesheet">
<style>
  :root {
    --black: #0a0a0a;
    --dark: #111111;
    --card: #161616;
    --border: #222222;
    --accent: #c8a84b;
    --accent-dim: rgba(200,168,75,0.12);
    --white: #f5f5f5;
    --muted: #888888;
    --font-display: 'Barlow Condensed', sans-serif;
    --font-body: 'Inter', sans-serif;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    background: var(--black);
    color: var(--white);
    font-family: var(--font-body);
    font-size: 14px;
    line-height: 1.6;
    overflow-x: hidden;
  }

  /* ── NAVBAR MINIMALISTA ── */
  .custom-navbar {
    position: sticky; top: 0; z-index: 1000;
    background: rgba(10,10,10,0.95);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
    padding: 0 40px;
    display: flex; align-items: center; justify-content: space-between;
    height: 64px; width: 100vw;
  }
  .custom-navbar a { text-decoration: none; }
  .nav-logo-box { display: flex; align-items: center; gap: 8px; }
  .nav-logo-ss { font-family: var(--font-body); font-weight: 800; font-size: 20px; letter-spacing: 2px; color: var(--white); }
  .nav-logo-pipe { color: #374151; font-weight: 100; font-size: 18px; }
  .nav-logo-sub { text-transform: uppercase; letter-spacing: 2px; font-size: 11px; color: var(--accent); font-weight: 400; }
  .nav-links-box { display: flex; gap: 32px; list-style: none; margin: 0; padding: 0; align-items: center; }
  .nav-links-box a { color: var(--muted); font-size: 13px; font-weight: 500; letter-spacing: 0.3px; transition: color .2s; }
  .nav-links-box a:hover, .nav-links-box a.active { color: var(--white); }
  .nav-user { color: var(--white); font-size: 13px; font-weight: 500; }

  .container { max-width: 1200px; margin: 0 auto; padding: 60px 20px; }

  /* ── SECTION HEADER ── */
  .section-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; }
  .section-title { font-family: var(--font-display); font-size: 42px; font-weight: 800; text-transform: uppercase; letter-spacing: -1px; line-height: 1; }
  .section-eyebrow { font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase; color: var(--accent); margin-bottom: 8px; }

  .btn-action-gold {
    background: var(--accent); color: var(--black); padding: 10px 24px; border-radius: 30px;
    font-size: 12px; font-weight: 700; text-decoration: none; letter-spacing: 0.5px; transition: opacity .2s; text-transform: uppercase;
  }
  .btn-action-gold:hover { opacity: 0.85; }

  /* ── TABELA DE CLIENTES ── */
  .data-section { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 30px; }
  .table-responsive { overflow-x: auto; }
  .table-premium { width: 100%; border-collapse: collapse; text-align: left; }
  .table-premium th { color: var(--muted); text-transform: uppercase; letter-spacing: 1px; font-size: 11px; font-weight: 600; padding: 14px 16px; border-bottom: 1px solid var(--border); }
  .table-premium td { padding: 16px; border-bottom: 1px solid rgba(34,34,34,0.5); font-size: 13px; color: #e5e5e5; }
  .table-premium tr:last-child td { border-bottom: none; }

  .client-name { font-weight: 600; color: var(--white); text-decoration: none; transition: color 0.2s; }
  .client-name:hover { color: var(--accent); }

  .btn-table-round {
    display: inline-block; padding: 6px 16px; border-radius: 30px; border: 1px solid var(--border);
    color: var(--white); text-decoration: none; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s;
  }
  .btn-table-round:hover { border-color: var(--white); background: var(--white); color: var(--black); }
</style>
</head>
<body>

  <header class="custom-navbar">
    <div class="nav-logo-box">
      <span class="nav-logo-ss">SS</span>
      <span class="nav-logo-pipe">|</span>
      <span class="nav-logo-sub">Automóveis</span>
    </div>
    <ul class="nav-links-box">
      <li><a href="{{ route('dashboard') }}">Painel</a></li>
      <li><a href="{{ route('viaturas.index') }}">Viaturas</a></li>
      <li><a href="{{ route('clientes.index') }}" class="active">Clientes</a></li>
      <li><a href="{{ route('vendas.index') }}">Vendas</a></li>
    </ul>
    <div class="nav-user">{{ Auth::user()->name ?? 'Diana Silva' }}</div>
  </header>

  <div class="container">
    <div class="section-header">
      <div>
        <div class="section-eyebrow">Relações de Confiança</div>
        <h1 class="section-title">Clientes Registados</h1>
      </div>
      <a href="{{ route('clientes.create') }}" class="btn-action-gold">+ Novo Cliente</a>
    </div>

    <div class="data-section">
      <div class="table-responsive">
        <table class="table-premium">
          <thead>
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Telemóvel</th>
              <th>NIF / Documento</th>
              <th style="text-align: right;">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach($clientes as $cliente)
              <tr>
                <td>
                  <a href="{{ route('clientes.show', $cliente->id) }}" class="client-name">
                    {{ $cliente->nome }}
                  </a>
                </td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telemovel ?? $cliente->telefone ?? 'N/D' }}</td>
                <td>{{ $cliente->nif ?? 'N/D' }}</td>
                <td style="text-align: right;">
                  <a href="{{ route('clientes.show', $cliente->id) }}" class="btn-table-round">Ficha</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
