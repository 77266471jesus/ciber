<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cliente::factory(20)->create();
        Cliente::create(['nombre' => 'Gregorio Mamani de Cutili', 'tipo_documento' => 'c.i.', 'documento' => '3445610', 'direccion' => 'z. villa adela yunguyo c. copacabana', 'telefono' => '60655501',]);
        Cliente::create(['nombre' => 'Gustabo Mamani Parraga', 'tipo_documento' => 'c.i.', 'documento' => '10022980', 'direccion' => 'z. libertad c. Q #862', 'telefono' => '60055202',]);
        Cliente::create(['nombre' => 'Ruben Leonardo Aruquipa Quispe Limachi', 'tipo_documento' => 'c.i.', 'documento' => '8349950', 'direccion' => 'z. murarata c.monteaquedo #1414', 'telefono' => '60655503',]);
        Cliente::create(['nombre' => 'Esteban Mamani Quisoe', 'tipo_documento' => 'c.i.', 'documento' => '67385668', 'direccion' => 'z. mercedario av. daniel salamanca #12', 'telefono' => '60455404',]);
        Cliente::create(['nombre' => 'Julio Cesar Blanco', 'tipo_documento' => 'c.i.', 'documento' => '43106778', 'direccion' => 'El Alto', 'telefono' => '60455405',]);
        Cliente::create(['nombre' => 'Faustino Mendoza', 'tipo_documento' => 'c.i.', 'documento' => '3801021', 'direccion' => 'z. amistad ', 'telefono' => '60455406',]);
        Cliente::create(['nombre' => 'Jhony Alarcon Fernandez', 'tipo_documento' => 'c.i.', 'documento' => '7020792', 'direccion' => 'z. san felipe de seque c. tucu #8075', 'telefono' => '60455407',]);
        Cliente::create(['nombre' => 'Marta VIrginia Choque Mamani', 'tipo_documento' => 'c.i.', 'documento' => '8437275', 'direccion' => 'el alto', 'telefono' => '60455408',]);
        Cliente::create(['nombre' => 'Margarita Catari Alanoca', 'tipo_documento' => 'c.i.', 'documento' => '8422618', 'direccion' => 'z. milluni bajo #5', 'telefono' => '60455409',]);
        Cliente::create(['nombre' => 'Mary Lucre Arispe Rojas', 'tipo_documento' => 'c.i.', 'documento' => '6988457', 'direccion' => 'z. alto tejar c. rio seco # 2278', 'telefono' => '60455410',]);
        Cliente::create(['nombre' => 'Franz FLores Huayhua', 'tipo_documento' => 'c.i.', 'documento' => '7033566', 'direccion' => 'z. libertad c.flores', 'telefono' => '60455411',]);
        Cliente::create(['nombre' => 'Yerson Gomez Alaniz', 'tipo_documento' => 'c.i.', 'documento' => '9150749', 'direccion' => 'z. villa adela yunguyo c.catacora #2025', 'telefono' => '60455412',]);
        Cliente::create(['nombre' => 'Octavio Idelfonso', 'tipo_documento' => 'c.i.', 'documento' => '6034997', 'direccion' => 'z. 25 de julio c.sahuita # 3521', 'telefono' => '60455413',]);
        Cliente::create(['nombre' => 'Jorge Luis Oscamaita', 'tipo_documento' => 'c.i.', 'documento' => '8286692', 'direccion' => 'z. Illimani municipal', 'telefono' => '60455414',]);
        Cliente::create(['nombre' => 'Sheyla Scarlett FLores Ramos', 'tipo_documento' => 'c.i.', 'documento' => '7089997', 'direccion' => 'z. 25 de diciembte c. 9 de enero # 2475', 'telefono' => '60455415',]);
        Cliente::create(['nombre' => 'Gerardo Diego Mamani', 'tipo_documento' => 'nit', 'documento' => '8848012', 'direccion' => 'z. mercedario c. pedro domingo #11', 'telefono' => '60455416',]);
        Cliente::create(['nombre' => 'Victor Sarniento', 'tipo_documento' => 'nit', 'documento' => '341031012', 'direccion' => 'z. 16 de febrero c. barrientos #442', 'telefono' => '60455417',]);
        Cliente::create(['nombre' => 'Elizabeth Ibañez Parra', 'tipo_documento' => 'c.i.', 'documento' => '9861863', 'direccion' => '', 'telefono' => '60455418',]);
        Cliente::create(['nombre' => 'Arnold Ruben Saavedra Flores', 'tipo_documento' => 'c.i.', 'documento' => '7063028', 'direccion' => 'c. huanacuni z. 25 de julio # 9212', 'telefono' => '60455419',]);
        Cliente::create(['nombre' => 'Maruja Pinto Mamani', 'tipo_documento' => 'c.i.', 'documento' => '9259575', 'direccion' => 'z. 25 de julio c. Huanacuni #4075', 'telefono' => '60455420',]);
    }
}
