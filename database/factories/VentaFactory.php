<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
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
            'tipo_comprobante' => $this->faker->randomElement(['boleta','factura']),
            'comprobante' => $this->faker->randomDigit(),
            // 'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'fecha' => $this->faker->dateTime(),
            'impuesto' => $this->faker->randomDigit(),
            'total_venta' => $this->faker->randomDigit(),
            'total' => $this->faker->randomDigit(),
            'estado' => $this->faker->randomElement(['aceptado']),
        ];      
    }
}
