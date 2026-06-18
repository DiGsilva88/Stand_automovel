<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS Automóveis — {{ $viatura->marca }} {{ $viatura->modelo }}</title>
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
    --danger: #e74c3c;
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

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
  }

  /* ── VOLTAR ATRÁS ── */
  .back-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--muted); text-decoration: none; font-size: 13px;
    margin-bottom: 30px; transition: color 0.2s;
  }
  .back-link:hover { color: var(--accent); }

  /* ── ESTRUTURA EM DOIS BLOCOS ── */
  .showcase-wrapper {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 40px;
    align-items: start;
  }

  /* Imagem Principal Focada */
  .showcase-media {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    height: 500px;
    display: flex; align-items: center; justify-content: center;
  }
  .showcase-media img {
    width: 100%; height: 100%; object-fit: cover;
  }
  .no-img-text { font-size: 14px; text-transform: uppercase; letter-spacing: 2px; color: #444; }

  /* Detalhes da Viatura */
  .showcase-details {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 40px;
  }

  .vehicle-eyebrow {
    font-size: 12px; font-weight: 700; letter-spacing: 2px;
    color: var(--accent); text-transform: uppercase; margin-bottom: 8px;
  }
  .vehicle-title {
    font-family: var(--font-display);
    font-size: 48px; font-weight: 800; text-transform: uppercase;
    line-height: 1; color: var(--white); margin-bottom: 20px;
  }
  .vehicle-price {
    font-family: var(--font-display);
    font-size: 36px; font-weight: 800; color: var(--white);
    border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 24px;
  }
  .vehicle-price span { color: var(--accent); }

  /* Ficha Técnica Detalhada */
  .specs-list {
    display: flex; flex-direction: column; gap: 14px; margin-bottom: 36px;
  }
  .spec-row {
    display: flex; justify-content: space-between; font-size: 13px;
    padding-bottom: 10px; border-bottom: 1px solid rgba(34,34,34,0.4);
  }
  .spec-row:last-child { border-bottom: none; }
  .spec-label { color: var(--muted); }
  .spec-value { color: var(--white); font-weight: 600; }

  /* Painel de Ações Redondas */
  .action-group {
    display: flex; flex-direction: column; gap: 12px;
  }
  .btn-action {
    width: 100%; text-align: center; padding: 14px;
    font-size: 12px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; border-radius: 50px; text-decoration: none;
    transition: all 0.3s ease; display: block; cursor: pointer; outline: none;
  }
  .btn-gold {
    background: var(--accent); color: var(--black); border: none;
  }
  .btn-gold:hover { opacity: 0.9; box-shadow: 0 0 20px rgba(200,168,75,0.2); }

  .btn-outline {
    background: transparent; color: var(--white); border: 1px solid var(--border);
  }
  .btn-outline:hover { border-color: var(--white); }

  .btn-delete {
    background: transparent; color: var(--danger); border: 1px solid rgba(231,76,60,0.2);
    width: 100%;
  }
  .btn-delete:hover { background: var(--danger); color: var(--white); border-color: var(--danger); }

  /* ── BOTÃO DE FAVORITOS (GARAGEM) ── */
  .btn-favorito {
    width: 100%; text-align: center; padding: 14px;
    font-size: 12px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; border-radius: 50px;
    transition: all 0.3s ease; display: flex; align-items: center;
    justify-content: center; gap: 8px; cursor: pointer; outline: none;
    background: transparent; color: var(--white); border: 1px solid var(--border);
  }
  .btn-favorito:hover { border-color: var(--accent); color: var(--accent); }
  .btn-favorito.is-active {
    background: var(--accent-dim); color: var(--accent); border-color: var(--accent);
  }
  .btn-favorito .icon-star { font-size: 16px; line-height: 1; }

  /* ── MENSAGEM FLASH (CONFIRMAÇÃO DE AÇÃO) ── */
  .flash-toast {
    background: var(--accent-dim); color: var(--accent);
    border: 1px solid rgba(200,168,75,0.3); border-radius: 8px;
    padding: 14px 20px; font-size: 13px; margin-bottom: 24px;
    display: flex; align-items: center; gap: 10px;
  }
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

    <!-- Link para voltar ao catálogo -->
    <a href="{{ route('viaturas.index') }}" class="back-link">
      ← Voltar ao Catálogo
    </a>

    @if(session('success'))
      <div class="flash-toast">★ {{ session('success') }}</div>
    @endif

    <div class="showcase-wrapper">

      <!-- BLOCO DA ESQUERDA: FOTOGRAFIA DA VIATURA CORRIGIDA -->
      <div class="showcase-media">
        @if(!empty($viatura->foto))
          <!-- Correção da sintaxe HTML e rota direta do banco -->
          <img src="/{{ $viatura->foto }}" alt="Viatura" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
          <span class="no-img-text" style="display:none;">Imagem não encontrada</span>
        @else
          <span class="no-img-text">Sem fotografia associada</span>
        @endif
      </div>

      <!-- BLOCO DA DIREITA: DADOS E FICHA TÉCNICA -->
      <div class="showcase-details">
        <div class="vehicle-eyebrow">{{ $viatura->ano }} &bull; {{ number_format($viatura->quilometros, 0, ',', '.') }} KM</div>
        <h1 class="vehicle-title">{{ $viatura->marca }}</h1>

        <div class="vehicle-price">
          {{ number_format($viatura->preco ?? 0, 0, ',', '.') }} <span>€</span>
        </div>

        <!-- Ficha Técnica Avançada -->
        <div class="specs-list">
          <div class="spec-row">
            <span class="spec-label">Modelo</span>
            <span class="spec-value">{{ $viatura->modelo }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Combustível</span>
            <span class="spec-value">{{ $viatura->combustivel ?? 'Gasóleo' }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Tipo de Caixa</span>
            <span class="spec-value">{{ $viatura->caixa ?? 'Manual' }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Cilindrada / Motor</span>
            <span class="spec-value">{{ $viatura->motor ?? 'N/D' }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Estado de Stock</span>
            <span class="spec-value" style="color: var(--success);">{{ $viatura->estado ?? 'Disponível' }}</span>
          </div>
        </div>

        <!-- GRUPO DE OPERAÇÕES COMPLETO E FECHADO CORRETAMENTE -->
        <div class="action-group">

          @auth
            <!-- BOTÃO DE GUARDAR/REMOVER DOS FAVORITOS (GARAGEM PESSOAL) -->
            @php
                $jaGuardada = \App\Models\Favorito::where('user_id', auth()->id())
                    ->where('viatura_id', $viatura->id)
                    ->exists();
            @endphp
            <form action="{{ route('favoritos.toggle', $viatura->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn-favorito {{ $jaGuardada ? 'is-active' : '' }}">
                <span class="icon-star">{{ $jaGuardada ? '★' : '☆' }}</span>
                {{ $jaGuardada ? 'Guardada na Garagem' : 'Guardar na Garagem' }}
              </button>
            </form>
          @endauth

          @if(auth()->check() && !auth()->user()->isCliente())
          <a href="{{ route('viaturas.edit', $viatura->id) }}" class="btn-action btn-gold">
            Editar Especificações
          </a>

          <a href="{{ route('vendas.create', ['viatura_id' => $viatura->id]) }}" class="btn-action btn-outline">
            Registar Venda Desta Viatura
          </a>

          <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST" onsubmit="return confirm('Remover esta viatura permanentemente do stock?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-action btn-delete">
              Eliminar Viatura
            </button>
          </form>
          @endif

        </div>

      </div>

    </div>
  </div>

</body>
</html>
