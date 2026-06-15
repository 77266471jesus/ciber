<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Proveedor::factory(20)->create();
        Proveedor::create(['nombre' => 'Digicorp', 'tipo_documento' => 'nit', 'documento' => '1000788', 'direccion' => 'calle fernando huachalla #840 Esquina Abdon Saavedra', 'telefono' => '22911020',]);
        Proveedor::create(['nombre' => 'Heinz Ruben López (INTEB)', 'tipo_documento' => 'c.i.', 'documento' => '10022980', 'direccion' => 'Z.Santa Rosa calle B#84, La Paz, Bolivia', 'telefono' => '76758192',]);
        Proveedor::create(['nombre' => 'Carlos Montalvan (Skynet)', 'tipo_documento' => 'c.i.', 'documento' => '8349950', 'direccion' => 'Edificio Cipres, Piso 2, Oficina 3, La Paz, Bolivia', 'telefono' => '77395809',]);
        Proveedor::create(['nombre' => 'ALPHA SYSTEMS SRL', 'tipo_documento' => 'nit', 'documento' => '67385668', 'direccion' => 'c. Federico Zuazo 1721 P. 2, La Paz, Bolivia', 'telefono' => '60455404',]);
        Proveedor::create(['nombre' => 'LogicaTI', 'tipo_documento' => 'nit', 'documento' => '43106778', 'direccion' => 'Calle Los Jazmines #11, Av. San Martin, Equipetrol, La Paz, Bolivia', 'telefono' => '3273579',]);
        Proveedor::create(['nombre' => 'Jonny Moro', 'tipo_documento' => 'c.i.', 'documento' => '3801021', 'direccion' => 'Av. Cristobal de Mendoza #286, Oficina 3, La Paz, Bolivia', 'telefono' => '33396939',]);
        Proveedor::create(['nombre' => 'Janeth Eperanza', 'tipo_documento' => 'nit', 'documento' => '1089997', 'direccion' => 'c. 21 # 8363, La Paz, Bolivia', 'telefono' => '2799868',]);
        Proveedor::create(['nombre' => 'Franklin Torrez', 'tipo_documento' => 'nit', 'documento' => '1006692', 'direccion' => 'Av. Velarde # 432, La Oaz Cruz, Bolivia', 'telefono' => '60455408',]);
        Proveedor::create(['nombre' => 'Vanessa', 'tipo_documento' => 'nit', 'documento' => '20034997', 'direccion' => 'URB LAS PALMITAS CALLE JENECHERU 950, La Paz, Bolivia', 'telefono' => '70209977',]);
    }
}
