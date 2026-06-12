<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS Automóveis — Painel Principal</title>
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
    --success: #2ecc71;
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
    height: 64px;
    width: 100vw;
  }
  .custom-navbar a { text-decoration: none; }
  .nav-logo-box { display: flex; align-items: center; gap: 8px; }
  .nav-logo-ss {
    font-family: var(--font-body); font-weight: 800; font-size: 20px;
    letter-spacing: 2px; color: var(--white);
  }
  .nav-logo-pipe { color: #374151; font-weight: 100; font-size: 18px; }
  .nav-logo-sub {
    text-transform: uppercase; letter-spacing: 2px; font-size: 11px;
    color: var(--accent); font-weight: 400;
  }
  .nav-links-box { display: flex; gap: 32px; list-style: none; margin: 0; padding: 0; align-items: center; }
  .nav-links-box a {
    color: var(--muted); font-size: 13px; font-weight: 500;
    letter-spacing: 0.3px; transition: color .2s;
  }
  .nav-links-box a:hover, .nav-links-box a.active { color: var(--white); }
  .nav-user { color: var(--white); font-size: 13px; font-weight: 500; }
/* ANTES: max-width: 1200px; */

.container {
    max-width: 95%; /* Ocupa 95% do ecrã, ideal para painéis de dados */
    margin: 0 auto;
    padding: 40px 0; /* Menos margem vertical, mais foco nos dados */
}

  /* ── SECTION HEADER ── */
  .section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
  }
  .section-title {
    font-family: var(--font-display);
    font-size: 42px; font-weight: 800;
    text-transform: uppercase; letter-spacing: -1px;
    line-height: 1;
  }
  .section-eyebrow {
    font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase;
    color: var(--accent); margin-bottom: 8px;
  }
  .btn-action-gold {
    background: var(--accent); color: var(--black);
    padding: 10px 24px; border-radius: 30px;
    font-size: 12px; font-weight: 700; text-decoration: none;
    letter-spacing: 0.5px; transition: opacity .2s;
    text-transform: uppercase;
  }
  .btn-action-gold:hover { opacity: 0.85; }

  /* ── STATS BAR GRID ── */
  .stats-bar {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 50px;
  }
  .stat-cell {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 24px;
    display: flex; align-items: center; gap: 20px;
  }
  .stat-icon {
    width: 48px; height: 48px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 20px;
  }
  .stat-icon.gold { background: var(--accent-dim); color: var(--accent); }
  .stat-icon.green { background: rgba(46,204,113,0.12); color: var(--success); }
  .stat-icon.blue { background: rgba(52,152,219,0.12); color: #3498db; }
  .stat-icon.purple { background: rgba(155,89,182,0.12); color: #9b59b6; }

  .stat-num {
    font-family: var(--font-display);
    font-size: 32px; font-weight: 800; line-height: 1; color: var(--white);
    margin-bottom: 4px;
  }
  .stat-lbl { font-size: 11px; color: var(--muted); letter-spacing: 0.5px; text-transform: uppercase; }

  /* ── TABLE RESUME ── */
  .data-section {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 30px;
  }
  .table-title {
    font-family: var(--font-display);
    font-size: 24px; font-weight: 800; text-transform: uppercase;
    letter-spacing: 0.5px; margin-bottom: 24px; color: var(--white);
  }
  .table-responsive { overflow-x: auto; }
  .table-premium {
    width: 100%; border-collapse: collapse; text-align: left;
  }
  .table-premium th {
    color: var(--muted); text-transform: uppercase;
    letter-spacing: 1px; font-size: 11px; font-weight: 600;
    padding: 14px 16px; border-bottom: 1px solid var(--border);
  }
  .table-premium td {
    padding: 16px; border-bottom: 1px solid rgba(34,34,34,0.5);
    font-size: 13px; color: #e5e5e5;
  }
  .table-premium tr:last-child td { border-bottom: none; }

  .status-badge {
    display: inline-block; padding: 4px 12px; border-radius: 20px;
    font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
  }
  .status-badge.success { background: rgba(46,204,113,0.12); color: var(--success); }
</style>
</head>
<body>

  <!-- NAVBAR UNIFORMIZADA -->
  <header class="custom-navbar">
    <div class="nav-logo-box">
      <span class="nav-logo-ss">SS</span>
      <span class="nav-logo-pipe">|</span>
      <span class="nav-logo-sub">Automóveis</span>
    </div>

    <ul class="nav-links-box">
      <li><a href="{{ route('dashboard') }}" class="active">Painel</a></li>
      <li><a href="{{ route('viaturas.index') }}">Viaturas</a></li>
      <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
      <li><a href="{{ route('vendas.index') }}">Vendas</a></li>
    </ul>

    <div class="nav-user">
      {{ Auth::user()->name ?? 'Diana Silva' }}
    </div>
  </header>

  <div class="container">

    <!-- CABEÇALHO DO PAINEL -->
    <div class="section-header">
      <div>
        <div class="section-eyebrow">Gestão de Performance</div>
        <h1 class="section-title">Painel Principal</h1>
      </div>
      <a href="{{ route('vendas.create') }}" class="btn-action-gold">+ Registar Venda</a>
    </div>

    <!-- MÉTRICAS SOLICITADAS (Grelha de Indicadores) -->
    <div class="stats-bar">

      <!-- Número de Vendas -->
      <div class="stat-cell">
        <div class="stat-icon gold">📊</div>
        <div>
          <div class="stat-num">{{ $totalVendas ?? '24' }}</div>
          <div class="stat-lbl">Vendas Efetuadas</div>
        </div>
      </div>

      <!-- Total Faturado -->
      <div class="stat-cell">
        <div class="stat-icon green">€</div>
        <div>
          <div class="stat-num">{{ isset($totalFaturado) ? number_format($totalFaturado, 0, ',', '.') . ' €' : '842.500 €' }}</div>
          <div class="stat-lbl">Total Faturado</div>
        </div>
      </div>

      <!-- Viaturas Disponíveis -->
      <div class="stat-cell">
        <div class="stat-icon blue">🚗</div>
        <div>
          <div class="stat-num">{{ $totalViaturas ?? '18' }}</div>
          <div class="stat-lbl">Stock Disponível</div>
        </div>
      </div>

      <!-- Total Clientes -->
      <div class="stat-cell">
        <div class="stat-icon purple">👥</div>
        <div>
          <div class="stat-num">{{ $totalClientes ?? '56' }}</div>
          <div class="stat-lbl">Clientes Registados</div>
        </div>
      </div>

    </div>

    <!-- RESUMO DAS ÚLTIMAS TRANSAÇÕES DINÂMICAS -->
    <div class="data-section">
      <h2 class="table-title">Atividade Recente</h2>
      <div class="table-responsive">
        <table class="table-premium">
          <thead>
            <tr>
              <th>Viatura</th>
              <th>Cliente</th>
              <th>Data</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($ultimasVendas) && $ultimasVendas->count() > 0)
              @foreach($ultimasVendas as $venda)
                <tr>
                  <!-- Nome/Modelo da Viatura -->
                  <td style="font-weight: 600;">
                    {{ $venda->viatura->marca ?? 'Viatura' }} {{ $venda->viatura->modelo ?? '' }}
                  </td>
                  <!-- Nome do Cliente -->
                  <td>{{ $venda->cliente->nome ?? 'Cliente Geral' }}</td>
                  <!-- Data Formatada -->
                  <td>{{ $venda->created_at ? $venda->created_at->format('d/m/Y') : 'N/D' }}</td>
                  <!-- Preço com Destaque Dourado -->
                  <td style="color: var(--accent); font-weight: 600;">
                    {{ number_format($venda->valor_venda ?? 0, 0, ',', '.') }} €
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4" class="text-center text-muted" style="padding: 24px;">
                  Nenhuma venda registada até ao momento.
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

  </div> <!-- Fim do container principal -->

</body>
</html>


