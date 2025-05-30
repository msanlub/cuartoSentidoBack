<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Flores preservadas',
                'description' => 'Ramos, composiciones y arreglos con flores preservadas.',
            ],
            [
                'name' => 'Velas',
                'description' => 'Velas aromáticas y decorativas para regalo o decoración.',
            ],
            [
                'name' => 'Accesorios',
                'description' => 'Diademas, detalles para invitados y complementos para eventos.',
            ],
            [
                'name' => 'Especiales',
                'description' => 'Cuadros pirograbados y letras decorativas con flores.',
            ],
            [
                'name' => 'Hogar',
                'description' => 'Jarrones y elementos decorativos para el hogar.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
