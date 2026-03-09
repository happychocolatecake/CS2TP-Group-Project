<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\ReturnOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{

    public function showReturnForm(Order $order, Product $product)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $item = $order->orderDetails()->where('product_id', $product->id)->firstOrFail();

        $pendingQty = ReturnOrder::getPendingQty($order->id, $product->id);
        $returnedQty = ReturnOrder::getReturnedQty($order->id, $product->id);
        $maxQuantity = $item->quantity - ($pendingQty + $returnedQty);

        return view('returns', compact('order', 'product', 'maxQuantity'));
    }

    public function returnSingleItem(Request $request, $orderId, $productId)
    {

        $request->validate([
            'return_quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255'
        ]);



        //locates the order this return is linked to
        $order = Order::findOrFail($orderId);
        $item = $order->orderDetails()->where('product_id', $productId)->first();
        $quantityToReturn = $request->input('return_quantity');

        $alreadyReturned = ReturnOrder::where('order_id', $orderId)->where('product_id', $productId) ->sum('return_quantity');

        //make sure the order belongs to the user
        if ($order->user_id !== Auth::id()) abort(403);

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
            'reason' => $request->reason,
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

        if ($order->user_id !== Auth::id()) abort(403);

        if (!$order->isReturnable()) {
            return back()->with('error', 'Order cannot be returned.');
        }

        $createdAny = false;

        //create return records for EVERY item in the order
        foreach ($order->orderDetails as $item) {
            $pendingQty = ReturnOrder::getPendingQty($order->id, $item->product_id);
            $returnedQty = ReturnOrder::getReturnedQty($order->id, $item->product_id);

            //calculate what hasn't been touched yet
            $remainingToReturn = $item->quantity - ($pendingQty + $returnedQty);
            //only create if one doesn't already exist for this item
            if ($remainingToReturn > 0) {
            ReturnOrder::Create([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'return_date' => now(),
                    'reason' => 'Full order return requested.',
                    'return_status' => 'Pending Full Return',
                    'user_id' => Auth::id(),
                    'return_quantity' => $remainingToReturn,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            $createdAny = true;
        }
        }

        if (!$createdAny) {
        return back()->with('error', 'All items in this order are already pending or returned.');
        }

        //update the main order status
        $order->update(['order_status' => 'Pending Full Return']);
        return back()->with('success', 'Entire order marked for return.');
    }

    public function processReturn(Request $request, $orderId, $productId)
    {

        //make sure a reason was selected
        $request->validate([
            'reason' => 'required|string',
            'additional_details' => 'nullable|string|max:500'
        ]);

        $selectedReason = $request->input('reason');
        $details = $request->input('additional_details');

        //if there are details, combine ther just use the selected reason
        $combinedReason = $details ? $selectedReason . ': ' . $details  : $selectedReason;
        $request->merge(['reason' => $combinedReason]);
        return $this->returnSingleItem($request, $orderId, $productId);
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

      DB::transaction(function () use ($order) {
            //updates the order status
            $order->update(['order_status' => 'Cancelled']);

            //loop through the order items and put them back into stock making sure its the right one
            foreach ($order->orderDetails()->with('product')->get() as $item) {
                if ($item->product) {
                    $item->product->increment('product_stock', $item->quantity);
                }
            }
        });

        return back()->with('success', 'Order #'. $order->id .' has been cancelled.');
    }

    public function approveReturn(ReturnOrder $returnOrder)
    {
        DB::transaction(function () use ($returnOrder) {
            $returnOrder->update(['return_status' => 'Approved']);

            //put the specific returned quantity back into stock
            $returnOrder->product->increment('product_stock', $returnOrder->return_quantity);
        });

        return back()->with('success', 'Return approved and stock updated.');
    }
}
