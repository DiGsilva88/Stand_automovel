<?php

namespace Database\Factories;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Viatura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Venda>
 */
class VendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Associa automaticamente a um cliente e viatura existentes ou cria novos
            'cliente_id' => Cliente::factory(),
            'viatura_id' => Viatura::factory(),
            'data_venda' => $this->faker->date(),
            'valor_venda' => $this->faker->numberBetween(5000, 60000),
            'observacoes' => $this->faker->sentence(),
        ];
    }
}
