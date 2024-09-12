<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Creacion de los usuario por defecto para la aplicacion
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123')]);
        $admin->assignRole('admin');

        $customer = User::firstOrCreate([
            'name' => 'customer',
            'email' => 'user@example.com',
            'password' => bcrypt('user123')]);
        $customer->assignRole('customer');
    }
}
