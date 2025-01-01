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

        // Fetch cart items for the authenticated user
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        // Calculate total price based on selected temperature
        $totalPrice = $cartItems->sum(function ($cartItem) {
            if ($cartItem->temperature === 'general') {
                return $cartItem->product->price * $cartItem->quantity;
            } else {
                return $cartItem->temperature === 'hot'
                    ? $cartItem->product->hot_price * $cartItem->quantity
                    : $cartItem->product->ice_price * $cartItem->quantity;
            }
        });

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'temperature' => 'required_if:category,!Food,!Bottle 1L|string|in:hot,ice,general',
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

        return response()->json(['success' => true]);
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

        return response()->json(['success' => true]);
    }
}
