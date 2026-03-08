<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\ReturnOrder;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{

    public function returnSingleItem(Request $request, $orderId, $productId)
    {

        $request->validate([
            'return_quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255'
        ]);

        $reason = $request->input('reason', 'No reason provided');
        //locates the order this return is linked to
        $order = Order::findOrFail($orderId);
        $item = $order->orderDetails()->where('product_id', $productId)->first();
        $quantityToReturn = $request->input('return_quantity');

        $alreadyReturned = ReturnOrder::where('order_id', $orderId)->where('product_id', $productId) ->sum('return_quantity');

        //makes sure order is returnable (if its been delivered)
        if (!$order->isReturnable()) {
            return redirect()->route('profile.orders.show', $orderId)->with('error', 'Only delivered orders can be returned.');
        }

        //make sure returning quantity doesnt exceed the product stock
        if ($request->return_quantity > ($item->quantity - $alreadyReturned)) {
        return back()->with('error', 'You cannot return more items than you currently possess.');
        }

        $returnOrder = ReturnOrder::create([
            'return_date' => now(),
            'reason' => $reason,
            'return_status' => 'Pending Partial Return',
            'return_quantity' => $quantityToReturn,
            'product_id' => $productId,
            'order_id' => $orderId,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //because its only one item, we dont update order status until all items are return requested
        //sum of everything originally bought
        $totalUnitsOrdered = $order->orderDetails->sum('quantity');

        //sum of everything currently being returned (across all products in this order)
        $totalUnitsReturned = ReturnOrder::where('order_id', $orderId)->sum('return_quantity');

        if ($totalUnitsReturned >= $totalUnitsOrdered) {
            //every single item is coming back from the order
            $order->update(['order_status' => 'Pending Full Return']);
            //its still part of a full order so returnOrder will view it as a partial return
            $returnOrder->update(['return_status' => 'Pending Partial Return']);
            $message = 'Entire order is now pending full return.';
        } else {
            //user is still holding onto some items
            $order->update(['order_status' => 'Pending Partial Return']);
            $message = 'Item(s) added to return. Return request updated.';
        }

        return redirect()->route('profile.orders.show', $orderId)->with('success', $message);
    }

    public function returnEntireOrder(Request $request, $orderId)
    {
        $order = Order::with('orderDetails')->findOrFail($orderId);

        if (!$order->isReturnable()) {
            return back()->with('error', 'Order cannot be returned.');
        }

        //create return records for EVERY item in the order
        foreach ($order->orderDetails as $item) {
            //only create if one doesn't already exist for this item
            ReturnOrder::firstOrCreate(
                ['order_id' => $orderId, 'product_id' => $item->product_id],
                [
                    'return_date' => now(),
                    'reason' => 'Full order return requested by user.',
                    'return_status' => 'Pending Full Return',
                    'user_id' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        //update the main order status
        $order->update(['order_status' => 'Pending Full Return']);
        return back()->with('success', 'Entire order marked for return.');
    }

    public function cancel(Order $order)
    {
        //ensure the user owns the order and it's actually pending (not shipped or delivered to cancel)
        if (Auth::id() !== $order->user_id && $order->order_status == 'Placed') {
            abort(403);
        }

        if (!$order->isCancellable()) {
            return back()->with('error', 'This order cannot be cancelled as it is already being processed.');
        }

        $order->update(['order_status' => 'Cancelled']);

        return back()->with('success', 'Order #'. $order->id .' has been cancelled.');
    }
}
