<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        $totalPrice = $cartItems->sum(function ($cartItem) {
            // Assuming the product has a price attribute for hot and ice
            return $cartItem->temperature === 'hot'
                ? $cartItem->product->hot_price * $cartItem->quantity
                : $cartItem->product->ice_price * $cartItem->quantity;
        });

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'temperature' => 'required|string|in:hot,ice',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = auth()->id();

        // Check if the cart item already exists for the same product and temperature
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->where('temperature', $request->temperature)
            ->first();

        if ($cartItem) {
            // Update quantity if the item already exists
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create a new cart item if it doesn't exist
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'temperature' => $request->temperature,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('message', 'Product added to cart successfully!');
    }


    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function updateCartItem(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart item updated successfully!');
    }
}
