<?php

namespace Database\Seeders;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\Subcategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
       // $this->call(CategoriaSeeder::class);
      //  $this->call(SubcategoriaSeeder::class);
      //  $this->call(ProductoSeeder::class);
      //  $this->call(KardexSeeder::class);
        //$this->call(ProveedorSeeder::class);
        // $this->call(IngresoSeeder::class);
        // $this->call(DetalleIngresoSeeder::class);
       // $this->call(ClienteSeeder::class);
        // $this->call(VentaSeeder::class);
        // $this->call(DetalleVentaSeeder::class);
        // $this->call(CotizacionSeeder::class);
        // $this->call(DetalleCotizacionSeeder::class);
        $this->call(ConfiguracionSeeder::class);
        $this->call(AlertaSeeder::class);
    }
}