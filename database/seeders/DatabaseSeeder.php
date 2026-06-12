<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===================== CLIENTES =====================
        // Cria 10 clientes fictícios usando a ClienteFactory
        $clientes = Cliente::factory()->count(10)->create();

        // ===================== VIATURAS =====================
        // Cria 15 viaturas disponíveis
        $viaturasDisponiveis = Viatura::factory()
            ->count(15)
            ->state(['estado' => 'Disponível'])
            ->create();

        // Cria 5 viaturas já vendidas
        $viaturasVendidas = Viatura::factory()
            ->count(5)
            ->state(['estado' => 'Vendido'])
            ->create();

        // ===================== VENDAS =====================
        // Para cada viatura vendida, cria uma venda associada a um cliente aleatório
        foreach ($viaturasVendidas as $viatura) {
            Venda::factory()->create([
                'cliente_id' => $clientes->random()->id,
                'viatura_id' => $viatura->id,
            ]);
        }
    }
}
