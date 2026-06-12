<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS Automóveis — Catálogo de Viaturas</title>
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

  /* ── NAVBAR PREMIUM INDEPENDENTE ── */
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

  /* ── LAYOUT EXPANDIDO (95% DE ECRÃ) ── */
  .container {
    max-width: 95%;
    margin: 0 auto;
    padding: 60px 20px;
  }

  .section-header {
    text-align: center;
    margin-bottom: 50px;
  }
  .section-title {
    font-family: var(--font-display);
    font-size: 44px; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--white); margin-bottom: 12px;
  }
  .section-sub { color: var(--muted); font-size: 14px; letter-spacing: 0.5px; }

  /* ── GRELHA DE VIATURAS ── */
  .vehicles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
  }
  .vehicle-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    display: flex; flex-direction: column;
    transition: transform 0.3s ease, border-color 0.3s ease;
  }
  .vehicle-card:hover {
    transform: translateY(-5px); border-color: var(--accent);
  }
  .card-media {
    position: relative; width: 100%; height: 210px;
    background: #1c1c1f;
    overflow: hidden;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
  }
  .card-media img {
    width: 100%; height: 100%; object-fit: cover; display: block;
  }
  .no-image-placeholder {
    font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #555; text-align: center;
  }
  .diagnostic-text {
    font-size: 10px; color: #ef4444; font-weight: 600; margin-top: 8px; letter-spacing: 0.5px; text-align: center; padding: 0 10px;
  }
  .price-tag {
    position: absolute; top: 16px; right: 16px;
    background: rgba(10, 10, 10, 0.85); backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: var(--white); padding: 6px 14px; border-radius: 30px;
    font-size: 12px; font-weight: 700; z-index: 2;
  }
  .price-tag span { color: var(--accent); }

  .card-body { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .vehicle-name {
    font-size: 18px; font-weight: 700; color: var(--white);
    margin-bottom: 6px; text-decoration: none; display: block;
  }
  .vehicle-category {
    font-size: 11px; color: var(--accent); text-transform: uppercase;
    letter-spacing: 1.5px; font-weight: 600; margin-bottom: 20px;
  }
  .tech-specs {
    border-top: 1px solid var(--border); padding-top: 16px;
    display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;
  }
  .spec-item { display: flex; justify-content: space-between; font-size: 12px; }
  .spec-label { color: var(--muted); }
  .spec-value { color: var(--white); font-weight: 500; }

  .card-actions { display: flex; gap: 12px; margin-top: auto; }
  .btn-view {
    flex: 1; text-align: center; background: transparent;
    border: 1px solid var(--border); color: var(--white);
    padding: 11px; font-size: 11px; font-weight: 600;
    text-decoration: none; border-radius: 30px;
    text-transform: uppercase; letter-spacing: 1px;
    transition: background 0.2s, border-color 0.2s, color 0.2s;
  }
  .btn-view:hover { border-color: var(--white); background: var(--white); color: var(--black); }
  .btn-edit { border-color: var(--accent-dim); color: var(--accent); }
  .btn-edit:hover { border-color: var(--accent); background: var(--accent); color: var(--black); }
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
      <li><a href="{{ route('viaturas.index') }}" class="active">Viaturas</a></li>
      <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
      <li><a href="{{ route('vendas.index') }}">Vendas</a></li>
    </ul>

    <div class="nav-user">
      {{ Auth::user()->name ?? 'Diana Silva' }}
    </div>
  </header>

  <div class="container">

    <div class="section-header">
      <h1 class="section-title">Viaturas Disponíveis</h1>
      <p class="section-sub">Explore a nossa coleção exclusiva de veículos de alta gama</p>
    </div>

    <div class="vehicles-grid">
      @foreach($viaturas as $viatura)
        <div class="vehicle-card">

          <!-- MEDIA BLOCK COM RASTREIO DE ERRO ATIVO -->
                   <!-- CORREÇÃO DEFINITIVA: Remoção do prefixo duplicado -->
          <div class="card-media">
            <div class="price-tag">
              Desde <span>{{ number_format($viatura->preco, 0, ',', '.') }} €</span>
            </div>

            @if(!empty($viatura->foto))
              <!-- Removeu-se o /fotos/ manual porque a sua BD já traz a palavra fotos/carro.jpg -->
              <img src="/{{ $viatura->foto }}" alt="Viatura" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
              <span class="no-image-placeholder" style="display:none;">Sem Imagem</span>
            @else
              <span class="no-image-placeholder">Sem Imagem</span>
            @endif
          </div>


          <div class="card-body">
            <span class="vehicle-name">
              {{ $viatura->ano }} {{ $viatura->marca }}
            </span>
            <div class="vehicle-category">
              {{ $viatura->modelo }} &bull; {{ number_format($viatura->quilometros, 0, ',', '.') }} km
            </div>

            <div class="tech-specs">
              <div class="spec-item">
                <span class="spec-label">Tipo de Caixa</span>
                <span class="spec-value">{{ $viatura->caixa ?? 'Manual' }}</span>
              </div>
              <div class="spec-item">
                <span class="spec-label">Motorização</span>
                <span class="spec-value">{{ $viatura->motor ?? 'N/D' }}</span>
              </div>
              <div class="spec-item">
                <span class="spec-label">Transmissão</span>
                <span class="spec-value">{{ $viatura->combustivel ?? 'Gasóleo' }}</span>
              </div>
            </div>

            <div class="card-actions">
              <a href="{{ route('viaturas.show', $viatura->id) }}" class="btn-view">Visualizar</a>
              <a href="{{ route('viaturas.edit', $viatura->id) }}" class="btn-view btn-edit">Editar</a>
            </div>
          </div>

        </div>
      @endforeach
    </div>

  </div>

</body>
</html>
