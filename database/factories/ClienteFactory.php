<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'tipo_documento' => $this->faker->randomElement(['c.i.','nit']),
            'documento' => $this->faker->numberBetween($min = 100000, $max = 99999999),
            'direccion' => $this->faker->sentence(),
            'telefono' => $this->faker->numberBetween($min = 100000, $max = 99999999),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
