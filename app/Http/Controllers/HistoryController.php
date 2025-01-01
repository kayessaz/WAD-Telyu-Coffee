<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // Fetch purchase histories based on user role (admin or regular user)
        if (auth()->user()->email == 'admin@gmail.com') {
            $histories = History::with('products', 'user')->get(); // Fetch all histories with related products
        } else {
            $histories = History::with('products')->where('user_id', auth()->id())->get(); // Fetch user's history with related products
        }

        return view('history.index', compact('histories'));
    }

    public function store(Request $request)
    {
        // Assuming you're passing payment method and item price through the request
        $paymentMethod = $request->input('payment_method');
        $itemPrice = $request->input('item_price');

        // Assuming you're getting the product details from the product table
        $product = Product::find($request->input('product_id'));

        // Create new history record
        $history = History::create([
            'user_id' => Auth::id(),
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
            'hot_price' => in_array($cartItem->product->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']) ? $cartItem->product->hot_price : null,
            'ice_price' => in_array($cartItem->product->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']) ? $cartItem->product->ice_price : null,
            'total_price' => $cartItem->quantity * $cartItem->product->price,
            'payment_method' => 'Online Payment',
            'image_url' => $cartItem->product->image_url,
            'product_name' => $cartItem->product->name, // Save the product name here
            'category' => $cartItem->product->category,
        ]);

        // Redirect or return response
        return redirect()->route('history.success', ['history' => $history->id]);
    }

    public function show($orderId)
    {
        $history = Order::with('products')->findOrFail($orderId);

        return view('success', compact('history'));
    }

    public function success()
    {
        $user = auth()->user();

        // Fetch the latest order history, along with the associated products
        $history = History::with('products') // Change 'product' to 'products'
                    ->where('user_id', $user->id)
                    ->latest()
                    ->first(); // Fetch the latest order history

        // Fetch cart items for the authenticated user
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        // Calculate total price based on selected temperature
        $totalPrice = $cartItems->sum(function ($cartItem) {
            if (in_array($cartItem->product->category, ['Food', 'Bottle 1L'])) {
                return $cartItem->product->price * $cartItem->quantity;
            } else {
                return $cartItem->temperature === 'hot'
                    ? $cartItem->product->hot_price * $cartItem->quantity
                    : $cartItem->product->ice_price * $cartItem->quantity;
            }
        });

    // Other logic

        // Calculate tax and grand total
        $tax = $totalPrice * 0.12;
        $grandTotal = $totalPrice + $tax;

        // Format numbers as currency
        $totalPrice = number_format($totalPrice, 2);
        $tax = number_format($tax, 2);
        $grandTotal = number_format($grandTotal, 2);

        // Passing both $history and $cartItems to the view
        return view('history.success', compact('history', 'cartItems', 'tax', 'grandTotal'));
    }
}
