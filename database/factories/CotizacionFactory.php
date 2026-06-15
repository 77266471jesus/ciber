<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cotizacion>
 */
class CotizacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cliente_id' =>Cliente::all()->random()->id,
            'user_id'=>User::all()->random()->id,
            'comprobante' => $this->faker->randomDigit(),
            // 'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'fecha' => $this->faker->dateTime(),
            'impuesto' => $this->faker->randomDigit(),
            'total_cotizacion' => $this->faker->randomDigit(),
            'total' => $this->faker->randomDigit(),
        ];
    }
}
