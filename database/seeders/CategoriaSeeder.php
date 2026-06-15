<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['nombre' => 'VIDEOVIGILANCIA', 'slug' => 'VIDEOVIGILANCIA', 'descripcion' => 'categoria de cables conectores camas y otros', 'condicion' => 'activado',]);
        Categoria::create(['nombre' => 'CONTROL DE ACCESO', 'slug' => 'CONTROL-DE-ACCESO', 'descripcion' => '', 'condicion' => 'activado',]);
        Categoria::create(['nombre' => 'DETECTORES DE FUEGO', 'slug' => 'DETECTORES-DE-FUEGO', 'descripcion' => '', 'condicion' => 'activado',]);
        Categoria::create(['nombre' => 'ENERGIA', 'slug' => 'ENERGIA', 'descripcion' => '', 'condicion' => 'activado',]);
        Categoria::create(['nombre' => 'RADIOCOMUNICACION', 'slug' => 'RADIOCOMUNICACION', 'descripcion' => '', 'condicion' => 'activado',]);
        Categoria::create(['nombre' => 'HERRAMIENTAS', 'slug' => 'HERRAMIENTAS', 'descripcion' => '', 'condicion' => 'activado',]);
    }
}
