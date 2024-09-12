<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Nota: se ejecuta el seeder de roles y luego el de usuarios
     */
    public function run(): void
    {
        // Configuracion del seeder
        $this->call([
            RoleSeeder::class,  // Se ejecuta primero
            UserSeeder::class,  
        ]);
    }

}
