<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = auth()->user();
        $cartItem = Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        return response()->json($cartItem, 201);
    }

    public function viewCart()
    {
        $user = auth()->user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        return response()->json($cartItems);
    }

    public function updateCart(Request $request, $cartId)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = auth()->user();
        $cartItem = Cart::where('id', $cartId)->where('user_id', $user->id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Товар не найден в корзине'], 404);
        }

        $cartItem->update(['quantity' => $request->quantity]);
        return response()->json($cartItem);
    }

    public function removeFromCart($cartId)
    {
        $user = auth()->user();
        $cartItem = Cart::where('id', $cartId)->where('user_id', $user->id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Товар не найден в корзине'], 404);
        }

        $cartItem->delete();
        return response()->json(['message' => 'Товар удален из корзины'], 200);
    }
}
