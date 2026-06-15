<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'dan mamani',
            'user_name' => 'DAN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'tipo_documento' => 'c.i.',
            'ci' => 2376543,
            'cargo' => 'Administrador',
            'telefono' => 77735173,
            'direccion' => 'El Alto z. villa Adela Av. Costanera #100',
        ])->assignRole('Administrador');
       
    }
}
