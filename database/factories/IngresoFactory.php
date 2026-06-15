<?php

namespace Database\Factories;

use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingreso>
 */
class IngresoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'proveedor_id' =>Proveedor::all()->random()->id,
            'user_id'=>User::all()->random()->id,
            'tipo_comprobante' => $this->faker->randomElement(['boleta','factura']),
            'comprobante' => $this->faker->sentence(2),
            // 'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'fecha' => $this->faker->dateTime(),
            'impuesto' => $this->faker->randomDigit(),
            'total_compra' => $this->faker->randomDigit(),
            'estado' => $this->faker->randomElement(['aceptado','anulado']),
        ];
    }
}
