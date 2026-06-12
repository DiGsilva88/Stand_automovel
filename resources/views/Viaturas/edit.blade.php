<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS Automóveis — Editar Viatura #{{ $viatura->id }}</title>
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
  }

  /* ── NAVBAR UNIFORMIZADA ── */
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
  .nav-logo-sub { text-transform: uppercase; letter-spacing: 2px; font-size: 11px; color: var(--accent); font-weight: 400; }
  .nav-links-box { display: flex; gap: 32px; list-style: none; margin: 0; padding: 0; align-items: center; }
  .nav-links-box a { color: var(--muted); font-size: 13px; font-weight: 500; letter-spacing: 0.3px; }
  .nav-links-box a.active { color: var(--white); }
  .nav-user { color: var(--white); font-size: 13px; font-weight: 500; }

  .container { max-width: 700px; margin: 0 auto; padding: 60px 20px; }
  .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--muted); text-decoration: none; font-size: 13px; margin-bottom: 30px; }
  .back-link:hover { color: var(--accent); }

  .section-header { margin-bottom: 36px; }
  .section-title { font-family: var(--font-display); font-size: 42px; font-weight: 800; text-transform: uppercase; letter-spacing: -1px; }

  /* ── FORMULÁRIO ESCURO PREMIUM ── */
  .form-section { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 40px; }
  .form-group { margin-bottom: 24px; display: flex; flex-direction: column; gap: 8px; }
  .form-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--muted); font-weight: 600; }

  .form-input {
    background: var(--black); color: var(--white); border: 1px solid var(--border);
    border-radius: 8px; padding: 12px 16px; font-size: 14px; outline: none; width: 100%;
    transition: border-color 0.2s;
  }
  .form-input:focus { border-color: var(--accent); }

  select.form-input {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://w3.org' fill='none' viewBox='0 0 24 24' stroke='%23888888'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 16px center; background-size: 16px; padding-right: 40px;
  }

  .current-photo-box { display: flex; align-items: center; gap: 20px; margin-top: 8px; padding: 12px; background: var(--black); border: 1px solid var(--border); border-radius: 8px; }
  .current-photo-box img { height: 60px; width: auto; object-fit: contain; }

  .btn-submit {
    background: var(--accent); color: var(--black); border:4; padding: 16px;
    font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-radius: 50px;
    width: 100%; cursor: pointer; margin-top: 12px; transition: all 0.2s;
  }
  .btn-submit:hover { box-shadow: 0 0 20px rgba(200,168,75,0.3); opacity: 0.9; }
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
    <div class="nav-user">{{ Auth::user()->name ?? 'Diana Silva' }}</div>
  </header>

  <div class="container">
    <a href="{{ route('viaturas.index') }}" class="back-link">← Cancelar e Voltar</a>

    <div class="section-header">
      <h1 class="section-title">Editar Viatura #{{ $viatura->id }}</h1>
    </div>

    <div class="form-section">
      <!-- CRUCIAL: Garantir o enctype para upload de ficheiros -->
      <form action="{{ route('viaturas.update', $viatura->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label">Marca *</label>
          <input type="text" name="marca" class="form-input" value="{{ old('marca', $viatura->marca) }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Modelo *</label>
          <input type="text" name="modelo" class="form-input" value="{{ old('modelo', $viatura->modelo) }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Ano *</label>
          <input type="number" name="ano" class="form-input" value="{{ old('ano', $viatura->ano) }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Quilómetros *</label>
          <input type="number" name="quilometros" class="form-input" value="{{ old('quilometros', $viatura->quilometros) }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Preço (€) *</label>
          <!-- CORREÇÃO TÉCNICA: Usa ponto em vez de vírgula para evitar falhas no MySQL -->
          <input type="number" name="preco" step="0.01" class="form-input" value="{{ old('preco', str_replace(',', '.', $viatura->preco)) }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Estado *</label>
          <select name="estado" class="form-input">
            <option value="Disponível" {{ old('estado', $viatura->estado) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
            <option value="Vendido" {{ old('estado', $viatura->estado) == 'Vendido' ? 'selected' : '' }}>Vendido</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Fotografia</label>
          @if(!empty($viatura->foto))
            <div class="current-photo-box">
              <img src="{{ asset('fotos/' . $viatura->foto) }}" alt="Atual">
              <span style="font-size: 12px; color: var(--muted);">Foto atual em stock</span>
            </div>
          @endif
          <input type="file" name="foto" class="form-input" style="margin-top: 10px;">
          <span style="font-size: 11px; color: var(--muted); margin-top: 4px;">Deixe em branco para manter a foto atual.</span>
        </div>

        <button type="submit" class="btn-submit">Guardar Alterações</button>
      </form>
    </div>
  </div>

</body>
</html>
