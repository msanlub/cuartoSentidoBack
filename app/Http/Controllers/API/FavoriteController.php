<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Mostrar los favoritos del usuario
    public function index()
    {
        $favorites = Favorite::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($favorites->map(function ($fav) {
            return [
                'id' => $fav->id,
                'product' => [
                    'id' => $fav->product->id,
                    'name' => $fav->product->name,
                    'description' => $fav->product->description,
                    'price' => $fav->product->price,
                    'image' => $fav->product->image, 
                ]
            ];
        }));
    }

    // Añadir un producto a favoritos
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Producto añadido a favoritos']);
    }

    // Eliminar un producto de favoritos
    public function destroy($id)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->firstOrFail();

        $favorite->delete();

        return response()->json(['message' => 'Producto eliminado de favoritos']);
    }
}
