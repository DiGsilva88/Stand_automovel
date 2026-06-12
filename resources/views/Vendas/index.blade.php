@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Vendas</h2>
    <a href="{{ route('vendas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Nova Venda
    </a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Viatura</th>
            <th>Data da Venda</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($vendas as $venda)
        <tr>
            <td>{{ $venda->id }}</td>
            <td>{{ $venda->cliente->nome ?? '-' }}</td>
            <td>
                @if($venda->viatura)
                    {{ $venda->viatura->marca }} {{ $venda->viatura->modelo }}
                @else
                    -
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
            <td>{{ number_format($venda->valor_venda, 2, ',', '.') }} €</td>
            <td>
                <a href="{{ route('vendas.show', $venda) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('vendas.edit', $venda) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('vendas.destroy', $venda) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Eliminar venda? A viatura voltará a estar disponível.')">Apagar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">Não existem vendas registadas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $vendas->links() }}
@endsection
