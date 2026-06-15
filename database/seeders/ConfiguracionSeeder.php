<?php

namespace Database\Seeders;

use App\Models\configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        configuracion::create([            
            'empresa'=> 'CIBERTEL S.R.L.',
            'nit' => '0129660357',
            'direccion' => 'AVENIDA 6 DE MARZO N° 222, EDIFICIO LUISA, PISO 2, OF. 200, ZONA VILLA BOLÍVAR B',
        ]);
    }
}
