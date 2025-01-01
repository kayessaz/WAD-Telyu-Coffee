<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();

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

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function processCheckout(Request $request)
    {
        $user = auth()->user();

        $deliveryOption = $request->input('delivery_option');
        $paymentOption = $request->input('payment_option');

        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        foreach ($cartItems as $cartItem) {
            if (in_array($cartItem->product->category, ['Food', 'Bottle 1L'])) {
                $price = $cartItem->product->price;
            } else {
                $price = $cartItem->temperature === 'hot'
                    ? $cartItem->product->hot_price
                    : $cartItem->product->ice_price;
            }

            History::create([
                'user_id' => $cartItem->user_id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'hot_price' => $cartItem->product->hot_price,
                'ice_price' => $cartItem->product->ice_price,
                'total_price' => $price * $cartItem->quantity,
                'payment_method' => $paymentOption,
                'image_url' => $cartItem->product->image_url,
                'product_name' => $cartItem->product->name, // Save the product name here
                'category' => $cartItem->product->category,
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();

        if ($paymentOption == 'Cash') {
            // Redirect to success page for 'Pay at Cashier'
            return redirect()->route('history.success')->with('success', 'Checkout berhasil!');
        }

        if ($paymentOption == 'Online Payment') {
            // Redirect to QRIS page for 'Online Payment'
            return redirect()->route('checkout.qris');
        }
    }

    public function showQris()
    {
        return view('checkout.qris');
    }

    public function completePayment()
    {
        $user = auth()->user();
        $history = History::where('user_id', $user->id)->latest()->first();
        $history->payment_method = 'Online Payment';
        $history->save();

        return redirect()->route('history.success')->with('success', 'Payment completed successfully!');
    }

    public function success()
    {
        $user = auth()->user();
        $history = History::with('product')->where('user_id', $user->id)->latest()->first(); // Fetch the latest order history

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

        // Calculate tax and grand total
        $tax = $totalPrice * 0.12;
        $grandTotal = $totalPrice + $tax;

        // Passing both $history and $cartItems to the view
        return view('checkout.success', compact('history', 'cartItems', 'tax', 'grandTotal'));
    }
}
