@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Painel Principal</h2>
    <span class="text-muted">
        <i class="bi bi-person-circle"></i> Bem-vindo, {{ auth()->user()->name }}
    </span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Viaturas Disponíveis</h6>
                        <h2 class="mb-0">{{ $totalDisponiveis }}</h2>
                    </div>
                    <i class="bi bi-car-front" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Viaturas Vendidas</h6>
                        <h2 class="mb-0">{{ $totalVendidas }}</h2>
                    </div>
                    <i class="bi bi-check-circle" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Total de Vendas</h6>
                        <h2 class="mb-0">{{ $totalVendas }}</h2>
                    </div>
                    <i class="bi bi-graph-up" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Total de Clientes</h6>
                        <h2 class="mb-0">{{ $totalClientes }}</h2>
                    </div>
                    <i class="bi bi-people" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title text-muted">Total de Viaturas no Stand</h6>
                <h3>{{ $totalViaturas }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title text-muted">Valor Total de Vendas</h6>
                <h3>{{ number_format($valorTotalVendas, 2, ',', '.') }} €</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong>Últimas Vendas</strong>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Viatura</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimasVendas as $venda)
                <tr>
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
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">Ainda não existem vendas registadas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
