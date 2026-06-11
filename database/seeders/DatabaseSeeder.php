<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Viatura;
use App\Models\Venda;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria 10 clientes e 15 viaturas na base de dados
    Cliente::factory()->count(10)->create();
    Viatura::factory()->count(15)->create();

    // Cria 5 vendas associando clientes e viaturas que já existem no stand
    Venda::factory()->count(5)->create([
        'cliente_id' => Cliente::all()->random()->id,
        'viatura_id' => Viatura::where('estado', 'Disponível')->get()->random()->id,
        ]);
    }
}

