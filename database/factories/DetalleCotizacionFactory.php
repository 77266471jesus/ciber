<?php

namespace Database\Factories;

use App\Models\Cotizacion;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCotizacion>
 */
class DetalleCotizacionFactory extends Factory
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
            'cotizacion_id' =>Cotizacion::all()->random()->id,
            'producto_id' =>Producto::all()->random()->id,
            'cantidad' => $this->faker->randomDigit(),
            'precio_venta' => $this->faker->randomDigit(),
            'descuento' => $this->faker->randomDigit(),
            'subtotal' => $this->faker->randomDigit(),
        ];
    }
}
