<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartApiController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => 1, 'product_id' => $request->product_id], // hardcoded user
            ['quantity' => $request->quantity]
        );

        return response()->json(['status' => 'success', 'message' => 'Product added to cart', 'cart' => $cart]);
    }

    public function list()
    {
        $cartItems = Cart::with('product.images')->where('user_id', 1)->get();
        return response()->json(['status' => 'success', 'data' => $cartItems]);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['status' => 'success', 'message' => 'Cart updated', 'cart' => $cart]);
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(['status' => 'success', 'message' => 'Cart item removed']);
    }

    public function checkout()
    {
        // For now, just return success
        return response()->json(['status' => 'success', 'message' => 'Checkout completed']);
    }
}