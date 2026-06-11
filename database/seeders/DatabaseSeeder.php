<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viatura;
use App\Models\Cliente;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 2 viaturas de teste diretamente
        Viatura::create([
            'marca' => 'Mercedes-Benz',
            'modelo' => 'A200 d',
            'matricula' => 'AA-00-XX',
            'ano' => 2021,
            'quilometros' => 45000,
            'preco' => 29900.00,
            'foto' => null,
            'estado' => 'Disponível'
        ]);

        Viatura::create([
            'marca' => 'BMW',
            'modelo' => '116d',
            'matricula' => '99-ZZ-11',
            'ano' => 2019,
            'quilometros' => 85000,
            'preco' => 19500.00,
            'foto' => null,
            'estado' => 'Disponível'
        ]);
    }
}

