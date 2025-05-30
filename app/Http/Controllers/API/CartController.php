<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Añadir producto al carrito
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = $user->cart ?? $user->cart()->create();

        // Buscamos el producto para verificar el stock
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'No hay suficiente stock'], 400);
        }

        // Actualizamos el stock del producto
        $product->stock -= $request->quantity;
        $product->save();

        // Añadimos el producto al carrito
        $cart->items()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return response()->json(['message' => 'Producto añadido al carrito']);
    }

    // Eliminar producto del carrito
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = Auth::user()->cart;
        if (!$cart) {
            return response()->json(['message' => 'No se encontró el carrito'], 404);
        }

        // Buscamos el producto y el ítem del carrito
        $product = Product::findOrFail($request->product_id);
        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            // Sumamos la cantidad al stock del producto
            $product->stock += $cartItem->quantity;
            $product->save();

            // Eliminamos el ítem del carrito
            $cartItem->delete();
            return response()->json(['message' => 'Producto eliminado del carrito']);
        }

        return response()->json(['message' => 'Producto no encontrado en el carrito'], 404);
    }


    // Sumar o restar cantidad de producto en el carrito
    public function updateCartItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|in:increase,decrease',
        ]);

        $cart = Auth::user()->cart;
        if (!$cart) {
            return response()->json(['message' => 'No se encontró el carrito'], 404);
        }

        $item = $cart->items()->where('product_id', $request->product_id)->first();
        if (!$item) {
            return response()->json(['message' => 'Producto no encontrado en el carrito'], 404);
        }

        $product = Product::findOrFail($request->product_id);

        if ($request->action === 'increase') {
            // Verificamos que haya suficiente stock para añadir una unidad más
            if ($product->stock < 1) {
                return response()->json(['message' => 'No hay suficiente stock'], 400);
            }
            $product->stock--;
            $item->quantity++;
        } else {
            $product->stock++;
            $item->quantity--;
            if ($item->quantity < 1) {
                $item->delete();
                return response()->json(['message' => 'Producto eliminado del carrito']);
            }
        }

        $product->save();
        $item->save();

        return response()->json(['message' => 'Cantidad actualizada', 'quantity' => $item->quantity]);
    }
}