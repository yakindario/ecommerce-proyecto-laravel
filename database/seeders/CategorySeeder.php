<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Creacion de las categorias por defecto
     */
    public function run(): void
    {
        collect([
            'Tecnología',
            'Hogar',
            'Electrodomésticos',
            'Deportes',
            'Moda',
            'Mascotas',
            'Libros',
            'Juguetes',
            'Herramientas',
            'Muebles',
        ])->each(fn ($category) => Category::firstOrCreate(['name' => $category]));
        
    }
}
