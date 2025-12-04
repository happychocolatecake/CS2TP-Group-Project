<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Order; going to use later to save orders to a database


class CheckoutController extends Controller
{
    //show checkout page
    public function index()
    {
        // Get users basket from database
        $user = Auth::user();
        $basket = $user->basket()->with('items.product')->first();

        // Check if basket existts and it has items
        if (!$basket || $basket->items->isEmpty()) {
            return redirect()->route('store.index'); 
        }

        // Add database date to match what View expects
        $cartItems = $basket->items->map(function($item) {
            return [
                'name' => $item->product->product_name,
                'price' => $item->product->product_price,
                'quantity' => $item->quantity,
            ];
        });

        //  Calculate price
        $subtotal = $cartItems->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        // Return the checkout view
        return view('checkout', compact('cartItems', 'subtotal'));
    }

    //handle submissions
    public function processOrder(Request $request)
    {
        // 1. Validate incoming data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'shipping_cost' => 'required|numeric|in:3.95,6.95', 
        ]);

        // Get data from database
        $user = Auth::user();
        $basket = $user->basket()->with('items.product')->first();
        
        if (!$basket || $basket->items->isEmpty()) {
            return redirect()->route('store.index')->withErrors(['cart' => 'Your cart is empty.']);
        }

        // Calculate the total from the servers side
        $subtotal = 0;
        foreach ($basket->items as $item) {
            $subtotal += $item->product->product_price * $item->quantity;
        }
        
        $shippingCost = $validatedData['shipping_cost'];
        $grandTotal = $subtotal + $shippingCost;

        // Im going to implement saving the order later

        // Empty the cart after success
        $basket->items()->delete(); 

        // Redirect to success page
        return redirect()->route('checkout.success')->with([
            'success' => 'Thank you for your order!',
            'order_total' => $grandTotal
        ]);
    }
    
    /**
     * Show the success page.
     */
    public function success()
    {
        if (!session()->has('success')) {
            return redirect('/');
        }
        return view('checkout-success');
    }
}