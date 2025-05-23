<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener las categorías por slug
        $categories = [
            'flores-preservadas' => Category::where('slug', 'flores-preservadas')->first(),
            'velas' => Category::where('slug', 'velas')->first(),
            'accesorios' => Category::where('slug', 'accesorios')->first(),
            'especiales' => Category::where('slug', 'especiales')->first(),
            'hogar' => Category::where('slug', 'hogar')->first(),
        ];

        // Productos para cada categoría
        $products = [
            'flores-preservadas' => [
                [
                    'name' => 'Ramo de rosas preservadas',
                    'slug' => 'ramo-rosas-preservadas',
                    'description' => 'Ramo elegante de rosas preservadas en tonos suaves.',
                    'price' => 35.00,
                    'stock' => 10,
                    'type' => 'ramo_casa',
                    'is_featured' => true,
                    'is_active' => true,
                ],
                [
                    'name' => 'Mini ramo de flores preservadas',
                    'slug' => 'mini-ramo-flores-preservadas',
                    'description' => 'Mini ramo ideal para regalo o decoración de mesas.',
                    'price' => 20.00,
                    'stock' => 15,
                    'type' => 'ramo_casa',
                    'is_featured' => false,
                    'is_active' => true,
                ],
            ],
            'velas' => [
                [
                    'name' => 'Vela aromática de vainilla',
                    'slug' => 'vela-aromatica-vainilla',
                    'description' => 'Vela de soja con aroma a vainilla, perfecta para relajarse.',
                    'price' => 12.00,
                    'stock' => 20,
                    'type' => 'vela',
                    'is_featured' => true,
                    'is_active' => true,
                ],
                [
                    'name' => 'Vela decorativa con flores secas',
                    'slug' => 'vela-decorativa-flores-secas',
                    'description' => 'Vela decorativa con flores secas incrustadas.',
                    'price' => 15.00,
                    'stock' => 18,
                    'type' => 'vela',
                    'is_featured' => false,
                    'is_active' => true,
                ],
            ],
            'accesorios' => [
                [
                    'name' => 'Diadema floral para novia',
                    'slug' => 'diadema-floral-novia',
                    'description' => 'Diadema elegante con flores preservadas para novias.',
                    'price' => 28.00,
                    'stock' => 8,
                    'type' => 'detalle',
                    'is_featured' => true,
                    'is_active' => true,
                ],
                [
                    'name' => 'Detalle para invitados',
                    'slug' => 'detalle-invitados',
                    'description' => 'Pequeño detalle floral para regalar a los invitados.',
                    'price' => 5.00,
                    'stock' => 30,
                    'type' => 'detalle',
                    'is_featured' => false,
                    'is_active' => true,
                ],
            ],
            'especiales' => [
                [
                    'name' => 'Cuadro pirograbado con flores',
                    'slug' => 'cuadro-pirograbado-flores',
                    'description' => 'Cuadro de madera pirograbado y decorado con flores.',
                    'price' => 45.00,
                    'stock' => 5,
                    'type' => 'cuadro',
                    'is_featured' => true,
                    'is_active' => true,
                ],
                [
                    'name' => 'Letra decorativa con flores',
                    'slug' => 'letra-decorativa-flores',
                    'description' => 'Letra de madera decorada con flores preservadas.',
                    'price' => 32.00,
                    'stock' => 7,
                    'type' => 'cuadro',
                    'is_featured' => false,
                    'is_active' => true,
                ],
            ],
            'hogar' => [
                [
                    'name' => 'Jarrón de cristal con flores preservadas',
                    'slug' => 'jarron-cristal-flores-preservadas',
                    'description' => 'Jarrón de cerámica diseño para tus flores preservadas.',
                    'price' => 40.00,
                    'stock' => 6,
                    'type' => 'jarron',
                    'is_featured' => true,
                    'is_active' => true,
                ],
                [
                    'name' => 'Jarrón pequeño decorativo',
                    'slug' => 'jarron-pequeno-decorativo',
                    'description' => 'Jarrón pequeño ideal para decorar cualquier rincón.',
                    'price' => 18.00,
                    'stock' => 12,
                    'type' => 'jarron',
                    'is_featured' => false,
                    'is_active' => true,
                ],
            ],
        ];

        // Crear los productos
        foreach ($products as $categorySlug => $categoryProducts) {
            foreach ($categoryProducts as $product) {
                $product['category_id'] = $categories[$categorySlug]->id;
                Product::create($product);
            }
        }
    }
}
