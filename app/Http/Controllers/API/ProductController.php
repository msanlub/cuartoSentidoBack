<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    // Crear un nuevo producto 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->only([
            'name', 'description', 'price', 'image', 'stock', 'category_id'
        ]));

        return response()->json($product, 201);
    }

    // Actualizar un producto (opcional)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'image' => 'nullable|string',
            'stock' => 'sometimes|integer|min:0',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only([
            'name', 'description', 'price', 'image', 'stock', 'category_id'
        ]));

        return response()->json($product);
    }

    // Eliminar un producto (opcional)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}
