<?php

namespace Database\Factories;

use App\Models\Subcategoria;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subcategorias = Subcategoria::all()->random();
        $nombre = $this->faker->name();
        $stock_inicial = 25;

        return [
            'subcategoria_id' => $subcategorias->id,
            'codigo'=> $this->faker->word(50),
            'nombre'=> $nombre,
            'slug' => Str::slug($nombre),
            'marca' => $this->faker->sentence(2),
            'medida' => $this->faker->sentence(2),
            'stock'=> $stock_inicial,
            'stock_inicial'=> $stock_inicial,
            'precio' => $this->faker->randomDigit(),
            'precio_unitario' => $this->faker->randomDigit(),
            'descripcion'=> $this->faker->paragraph(),
            'condicion'=> $this->faker->randomElement(['activado']),
            'image' => 'productos/' . $this->faker->image('public/storage/productos', 640, 480, null, false)
        ];
    }
}
