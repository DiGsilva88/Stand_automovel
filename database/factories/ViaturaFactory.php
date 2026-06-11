<?php

namespace Database\Factories;

use App\Models\Viatura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Viatura>
 */
class ViaturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

    $marcas = ['Renault', 'Peugeot', 'BMW', 'Mercedes', 'Volkswagen', 'Fiat', 'Opel'];
    $estados = ['Disponível', 'Reservado', 'Vendido'];

    return [
        'marca' => $this->faker->randomElement($marcas),
        'modelo' => $this->faker->word(),
        'matricula' => strtoupper($this->faker->bothify('??-##-??')), // Ex: AA-11-BB
        'ano' => $this->faker->numberBetween(2010, 2026),
        'quilometros' => $this->faker->numberBetween(0, 250000),
        'preco' => $this->faker->randomFloat(2, 5000, 60000),
        'foto' => null, // Deixamos nulo por padrão para simular carros sem foto
        'estado' => $this->faker->randomElement($estados),
    ];
}
}
