<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\subcategoria>
 */
class SubcategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $nombre = $this->faker->randomElement(['camara','dvr','tols','alarmas','acceso','fuente']);
        $nombre = $this->faker->sentence(2);
        $categorias = Categoria::all()->random();
        return [
            'categoria_id' => $categorias->id,
            'nombre'=> $nombre,
            'slug' => Str::slug($nombre),
            'descripcion'=> $this->faker->paragraph(),
            'condicion'=> $this->faker->randomElement(['activado']),
            // 'image' => 'subcategorias/' . $this->faker->image('public/storage/subcategorias', 640, 480, null, false)
        ];
    }
}
