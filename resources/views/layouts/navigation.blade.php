<nav>
    <!-- Logótipo Oficial SS -->
    <a href="{{ route('dashboard') }}" class="nav-logo" style="display: flex; align-items: center; gap: 8px;">
        SS <span>AUTOMÓVEIS</span>
    </a>

    <!-- Links de Navegação Dinâmicos -->
    <ul class="nav-links">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Painel Principal
            </a>
        </li>
        <li>
            <a href="{{ route('viaturas.index') }}" class="{{ request()->routeIs('viaturas.*') ? 'active' : '' }}">
                Viaturas
            </a>
        </li>
        <li>
            <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                Clientes
            </a>
        </li>
        <li>
            <a href="{{ route('vendas.index') }}" class="{{ request()->routeIs('vendas.*') ? 'active' : '' }}">
                Vendas
            </a>
        </li>
    </ul>

    <!-- Menu do Utilizador / Terminar Sessão -->
    <div style="display: flex; align-items: center; gap: 20px;">
        <span style="font-size: 13px; font-weight: 500; color: var(--muted);">
            {{ Auth::user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <a href="{{ route('logout') }}" class="nav-cta"
               onclick="event.preventDefault(); this.closest('form').submit();">
                Sair
            </a>
        </form>
    </div>
</nav>
