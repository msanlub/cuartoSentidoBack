<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Crear un pedido a partir del carrito
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'El carrito está vacío'], 400);
        }

        // Validar datos de envío y pago
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'shipping_phone' => 'required|string|max:20',
            'recipient_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Calcular el total del carrito
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // Crear el pedido
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_postal_code' => $request->shipping_postal_code,
            'shipping_country' => $request->shipping_country,
            'shipping_phone' => $request->shipping_phone,
            'recipient_name' => $request->recipient_name ?? $user->name,
            'notes' => $request->notes,
        ]);

        // Crear los ítems del pedido
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Vaciar el carrito
        $cart->items()->delete();

        return response()->json(['message' => 'Pedido creado correctamente', 'order' => $order]);
    }

    // Mostrar pedidos del usuario
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->get();
        return response()->json($orders);
    }
}
