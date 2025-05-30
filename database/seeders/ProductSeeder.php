<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ramo de rosas preservadas',
                'description' => 'Ramo de rosas preservadas en caja de regalo.',
                'price' => 25.99,
                'image' => null,
                'stock' => 10,
                'category_id' => 1, // Flores preservadas
            ],
            [
                'name' => 'Vela aromática de vainilla',
                'description' => 'Vela aromática de vainilla, perfecta para decorar.',
                'price' => 12.50,
                'image' => null,
                'stock' => 20,
                'category_id' => 2, // Velas
            ],
            [
                'name' => 'Diadema floral',
                'description' => 'Diadema con flores preservadas para eventos.',
                'price' => 18.99,
                'image' => null,
                'stock' => 15,
                'category_id' => 3, // Accesorios
            ],
            [
                'name' => 'Cuadro pirograbado con flores',
                'description' => 'Cuadro pirograbado con flores preservadas.',
                'price' => 35.00,
                'image' => null,
                'stock' => 5,
                'category_id' => 4, // Especiales
            ],
            [
                'name' => 'Jarrón decorativo',
                'description' => 'Jarrón decorativo con flores preservadas.',
                'price' => 29.99,
                'image' => null,
                'stock' => 8,
                'category_id' => 5, // Hogar
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

