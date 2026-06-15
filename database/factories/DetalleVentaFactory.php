<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>User::all()->random()->id,
            'venta_id' =>Venta::all()->random()->id,
            'producto_id' =>Producto::all()->random()->id,
            'cantidad' => $this->faker->randomDigit(),
            'precio_venta' => $this->faker->randomDigit(),
            'descuento' => $this->faker->randomDigit(),
            'subtotal' => $this->faker->randomDigit(),
        ];
    }
}
