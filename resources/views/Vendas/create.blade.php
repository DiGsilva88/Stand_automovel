<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SS Automóveis — Registar Venda</title>
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

  /* ── NAVBAR MINIMALISTA UNIFORMIZADA ── */
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

  .container { max-width: 700px; margin: 0 auto; padding: 60px 20px; }
  .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--muted); text-decoration: none; font-size: 13px; margin-bottom: 30px; }
  .back-link:hover { color: var(--accent); }

  /* ── SECTION HEADER ── */
  .section-header { margin-bottom: 36px; }
  .section-title { font-family: var(--font-display); font-size: 42px; font-weight: 800; text-transform: uppercase; letter-spacing: -1px; line-height: 1; }
  .section-eyebrow { font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase; color: var(--accent); margin-bottom: 8px; }

  /* ── ESTRUTURA DO FORMULÁRIO ESCURO ── */
  .form-section { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 40px; }
  .form-group { margin-bottom: 24px; display: flex; flex-direction: column; gap: 8px; }
  .form-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--muted); font-weight: 600; }

  /* Inputs, Selects e Textareas Customizados */
  .form-input {
    background: var(--black);
    color: var(--white);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    font-family: var(--font-body);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    width: 100%;
    appearance: none; /* Remove seta padrão em alguns browsers para customização */
  }
  select.form-input {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://w3.org' fill='none' viewBox='0 0 24 24' stroke='%23888888'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    background-size: 16px;
    padding-right: 40px;
  }
  .form-input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px var(--accent-dim);
  }

  /* Mensagens de Erro do Laravel */
  .error-message { color: #e74c3c; font-size: 12px; margin-top: 4px; font-weight: 500; }

  /* Botão Redondo Premium */
  .btn-submit {
    background: var(--accent);
    color: var(--black);
    border: none;
    padding: 14px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-radius: 50px;
    width: 100%;
    cursor: pointer;
    margin-top: 12px;
    transition: opacity 0.2s, box-shadow 0.2s;
  }
  .btn-submit:hover { opacity: 0.9; box-shadow: 0 0 20px rgba(200,168,75,0.25); }
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
      <li><a href="{{ route('viaturas.index') }}">Viaturas</a></li>
      <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
      <li><a href="{{ route('vendas.index') }}" class="active">Vendas</a></li>
    </ul>
    <div class="nav-user">{{ Auth::user()->name ?? 'Diana Silva' }}</div>
  </header>

  <div class="container">
    <a href="{{ route('vendas.index') }}" class="back-link">← Voltar ao Historial</a>

    <div class="section-header">
      <div class="section-eyebrow">Registo de Transação</div>
      <h1 class="section-title">Nova Venda</h1>
    </div>

    <!-- FORMULÁRIO MINIMALISTA -->
    <div class="form-section">
      <form action="{{ route('vendas.store') }}" method="POST">
        @csrf

        <!-- Seleção de Viatura -->
        <div class="form-group">
          <label class="form-label" for="viatura_id">Viatura</label>
          <select name="viatura_id" id="viatura_id" class="form-input @error('viatura_id') is-invalid @enderror">
            <option value="">Selecione a viatura transacionada...</option>
            @foreach($viaturas as $viatura)
              <option value="{{ $viatura->id }}" {{ (old('viatura_id') == $viatura->id || request('viatura_id') == $viatura->id) ? 'selected' : '' }}>
                {{ $viatura->marca }} {{ $viatura->modelo }} — {{ number_format($viatura->preco ?? 0, 0, ',', '.') }} € ({{ $viatura->ano }})
              </option>
            @endforeach
          </select>
          @error('viatura_id')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <!-- Seleção de Cliente -->
        <div class="form-group">
          <label class="form-label" for="cliente_id">Cliente Adquirente</label>
          <select name="cliente_id" id="cliente_id" class="form-input @error('cliente_id') is-invalid @enderror">
            <option value="">Selecione o cliente de destino...</option>
            @foreach($clientes as $cliente)
              <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                {{ $cliente->nome }} (NIF: {{ $cliente->nif ?? 'N/D' }})
              </option>
            @endforeach
          </select>
          @error('cliente_id')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <!-- Valor Real da Venda -->
        <div class="form-group">
          <label class="form-label" for="valor_venda">Valor Final do Negócio (€)</label>
          <input type="number" name="valor_venda" id="valor_venda" step="0.01" class="form-input @error('valor_venda') is-invalid @enderror" value="{{ old('valor_venda') }}" placeholder="Ex: 85000">
          @error('valor_venda')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <!-- Botão Redondo de Submissão -->
        <button type="submit" class="btn-submit">
          Concluir e Registar Venda
        </button>

      </form>
    </div>
  </div>

</body>
</html>
