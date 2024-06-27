<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Jonh Doe',
                'nick'=> 'unknown',
                'email' => 'usuario@ejemplo.com',
                'password' => bcrypt('contraseña'), // Usa bcrypt para encriptar la contraseña
            ]
        );
    }
}
