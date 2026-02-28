<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{

    public function createReview(Order $order, Product $product)
    {

        //check that this is their order and that the order is delivered
        if ($order->user_id !== Auth::id()) {
            abort(403, 'This is not your order.'); //send forbidden message 403
        }

        if ($order->order_status !== 'Delivered') {
            return redirect()->back()->with('error', 'You can only review delivered items.');
        }

        //checks if they have already reviewed this product for this specific order

        $exists = Review::where('order_id', $order->id)
                        ->where('product_id', $product->id)
                        ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You have already reviewed the ' . $product->product_name . '.');
        }

        return view('create-review-page', compact('order', 'product'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
            'review_image' => 'nullable|image|max:2048',
        ]);

        //saves the new review to the database where it is retrieved on the product page later
        $review = new Review();
        $review->user_id = Auth::id();
        $review->order_id = $request->order_id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->review_text = $request->review_text;
        $review->created_at = now();

        //image upload (for after aishas part in case)
        if ($request->hasFile('review_image')) {
            $path = $request->file('review_image')->store('reviews', 'public');
            $review->review_image = $path;
        }

        $review->save();

        return redirect()->route('profile.orders.show', $request->order_id)
                        ->with('success', 'Thank you for your review!');
    }
}
