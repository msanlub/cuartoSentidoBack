<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Flores preservadas',
                'slug' => 'flores-preservadas',
                'description' => 'Ramos, composiciones y arreglos con flores preservadas.',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Velas',
                'slug' => 'velas',
                'description' => 'Velas aromáticas y decorativas para regalo o decoración.',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Accesorios',
                'slug' => 'accesorios',
                'description' => 'Diademas, detalles para invitados y complementos para eventos.',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Especiales',
                'slug' => 'especiales',
                'description' => 'Cuadros pirograbados y letras decorativas con flores.',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Hogar',
                'slug' => 'hogar',
                'description' => 'Jarrones y elementos decorativos para el hogar.',
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
