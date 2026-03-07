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
        $reason = $request->input('reason', 'No reason provided');
        //locates the order this return is linked to
        $order = Order::findOrFail($orderId);

        //makes sure order is returnable (if its been delivered)
        if (!$order->isReturnable()) {
            return redirect()->route('profile.orders.show', $orderId)->with('error', 'Only delivered orders can be returned.');

        }

        ReturnOrder::create([
            'return_date' => now(),
            'reason' => $reason,
            'status' => 'Pending Return',
            'product_id' => $productId,
            'order_id' => $orderId,
            'user_id' => Auth::id(),
        ]);

        //because its only one item, we dont update order status until all items are return requested
        $totalItemsInOrder = $order->orderDetails()->count();
        $totalItemsReturned = ReturnOrder::where('order_id', $orderId)->count();

        if ($totalItemsReturned === $totalItemsInOrder) {
            //all items are now requested for return, so we update the main order status
            $order->update(['order_status' => 'Pending Return']);
            $message = 'All items requested for return. Order status updated.';
        } else {
            //some items are still kept, so we leave the order as 'Delivered' (or a partial status)
            $message = 'Item return requested. Other items in this order remain active.';
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
                    'status' => 'Pending Return',
                    'user_id' => Auth::id(),
                ]
            );
        }

        //update the main order status
        $order->update(['order_status' => 'Pending Return']);
        return back()->with('success', 'Entire order marked for return.');
    }

    public function cancel(Order $order)
    {
        //ensure the user owns the order and it's actually pending
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        if (!$order->isCancellable()) {
            return back()->with('error', 'This order cannot be cancelled as it is already being processed.');
        }

        $order->update(['order_status' => 'Cancelled']);

        return back()->with('success', 'Order #'. $order->id .' has been cancelled.');
    }
}
