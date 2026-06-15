<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Subcategoria::factory(20)->create();
        Subcategoria::create(['nombre' => 'cables', 'slug' => 'cables', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'almacenamiento', 'slug' => 'almacenamiento', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'servidores', 'slug' => 'servidores', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'grabadores analogicos', 'slug' => 'grabadores-analogicos', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'camaras analogicas', 'slug' => 'camaras-analogicas', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'sensores', 'slug' => 'sensores', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'camaras ip', 'slug' => 'camaras-ip', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'NVR', 'slug' => 'NVR', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'energia', 'slug' => 'energia', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'Biometricos', 'slug' => 'Biometricos', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 2,]);
        Subcategoria::create(['nombre' => 'Detectores de metal', 'slug' => 'Detectores-de-metal', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 2,]);
        Subcategoria::create(['nombre' => 'Tarjetas', 'slug' => 'Tarjetas', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 2,]);
        Subcategoria::create(['nombre' => 'Cerraduras', 'slug' => 'Cerraduras', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 2,]);
        Subcategoria::create(['nombre' => 'Detectores Autonomos', 'slug' => 'Detectores-Autonomos', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 3,]);
        Subcategoria::create(['nombre' => 'Paneles', 'slug' => 'Paneles', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 3,]);
        Subcategoria::create(['nombre' => 'sistemas completos', 'slug' => 'sistemas-completos', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 1,]);
        Subcategoria::create(['nombre' => 'fuentes de alimentacion', 'slug' => 'fuentes-de-alimentacion', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 2,]);
        Subcategoria::create(['nombre' => 'Timbres', 'slug' => 'Timbres', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 2,]);
        Subcategoria::create(['nombre' => 'Notificaciones', 'slug' => 'Notificaciones', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 3,]);
        Subcategoria::create(['nombre' => 'Banco de Capacitores', 'slug' => 'Banco-de-Capacitores', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 4,]);
        Subcategoria::create(['nombre' => 'Tierra fisica y pararrayos', 'slug' => 'Tierra-fisica-y-pararrayos', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 4,]);
        Subcategoria::create(['nombre' => 'Telefonos IP', 'slug' => 'Telefonos-IP', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 5,]);
        Subcategoria::create(['nombre' => 'Video Conferencia', 'slug' => 'Video-Conferencia', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 5,]);
        Subcategoria::create(['nombre' => 'Probadores', 'slug' => 'Probadores', 'descripcion' => '', 'condicion' => 'activado', 'categoria_id' => 6,]);
    }
}
