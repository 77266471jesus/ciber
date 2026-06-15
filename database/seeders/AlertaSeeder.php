<?php

namespace Database\Seeders;

use App\Models\Alerta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alerta::create([
            'alerta'=> 'Critico',
            'valor' => 5,
        ]);
        Alerta::create([
            'alerta'=> 'Alto',
            'valor' => 10,
        ]);
        Alerta::create([
            'alerta'=> 'Moderado',
            'valor' => 15,
        ]);
    }
}
