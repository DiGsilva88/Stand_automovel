<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Viatura;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Visita;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===================== UTILIZADORES DE SISTEMA =====================
        // 1. Cria a sua conta de Administrador para conseguir fazer login
        $admin = User::updateOrCreate(
            ['email' => 'admin@ssautomoveis.pt'],
            [
                'name' => 'Diana Silva',
                'telefone' => '912345678',
                'role' => 'admin',
                'password' => Hash::make('password123'), // Altere a password se pretender
            ]
        );

        // 2. Cria uma conta de Cliente de Teste para simular a garagem
        $clienteUser = User::updateOrCreate(
            ['email' => 'cliente@email.com'],
            [
                'name' => 'Ricardo Pereira',
                'telefone' => '934567890',
                'role' => 'cliente',
                'password' => Hash::make('password123'),
            ]
        );

        // ===================== CLIENTES DA FACTURAÇÃO =====================
        // Cria 10 clientes fictícios para o histórico de vendas do stand
        $clientes = Cliente::factory()->count(10)->create();

        // ===================== VIATURAS =====================
        // Cria 15 viaturas disponíveis no catálogo público
        $viaturasDisponiveis = Viatura::factory()
            ->count(15)
            ->state(['estado' => 'Disponível'])
            ->create();

        // Cria 5 viaturas já vendidas pelo stand
        $viaturasVendidas = Viatura::factory()
            ->count(5)
            ->state(['estado' => 'Vendido'])
            ->create();

        // ===================== VENDAS & FATURAÇÃO =====================
        // Para cada viatura vendida, injeta uma venda associada ao valor do carro
        foreach ($viaturasVendidas as $viatura) {
            Venda::factory()->create([
                'cliente_id' => $clientes->random()->id,
                'viatura_id' => $viatura->id,
                'valor_venda' => $viatura->preco ?? 45000.00, // Força o preenchimento do campo correto
            ]);
        }

        // ===================== VISITAS / TEST DRIVES =====================
        // Cria uma simulação de agendamento pendente para testar os botões do Admin
        if ($viaturasDisponiveis->count() > 0) {
            Visita::create([
                'viatura_id' => $viaturasDisponiveis->first()->id,
                'nome_cliente' => $clienteUser->name,
                'email_cliente' => $clienteUser->email,
                'telefone_cliente' => $clienteUser->telefone,
                'data_hora' => now()->addDays(2)->setHour(14)->setMinute(0),
                'notas' => 'Gostaria de agendar a visita para o período da tarde.',
                'estado' => 'Pendente'
            ]);
        }
    }
}
