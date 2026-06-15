<?php

namespace Database\Seeders;

use App\Models\kardex;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KardexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kardexs = Producto::all();
        foreach ($kardexs as $kardex ) {
            kardex::create([
                'fecha' => '2022-01-03 22:53:04',
                'detalle' => 'Inicio de actividad de producto',
                'costo_unitario' =>  $kardex->precio_unitario,
                'cantidad_entrada' => null,
                'cantidad_salida' => null,
                'precio_entrada' =>  null,
                'precio_salida' => null,
                'cantidad_total' => $kardex->stock_inicial,
                'precio_total' => $kardex->precio_unitario * $kardex->stock_inicial,
                'cantidad' => $kardex->stock_inicial,
                'producto_id' => $kardex->id,
                'venta_id' => null,
                'cantidad' => $kardex->stock_inicial,
                'estado' => 'ingreso',
                'inicio' => 'inicio',
            ]);
        }

    }
}
