<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest('id')->get();
        $categories = Category::orderBy('category_name')->get();
        $users = User::with([
            'orders' => fn ($query) => $query->latest('id'),
            'orders.orderDetails.product',
        ])->orderBy('id')->get();

        $deliveryStatuses = $this->deliveryStatuses();

        return view('admin.dashboard', compact('products', 'categories', 'users', 'deliveryStatuses'));
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'product_model' => ['nullable', 'string', 'max:255'],
            'product_price' => ['required', 'integer', 'min:0'],
            'product_part' => ['required', 'string', 'max:255'],
            'product_description' => ['required', 'string'],
            'product_tagline' => ['required', 'string', 'max:255'],
            'product_image' => ['nullable', 'string', 'max:1000'],
            'product_stock' => ['required', 'integer', 'min:0'],
            'product_colour' => ['required', 'string', 'max:50'],
            'category_id' => ['required', 'exists:product_category,id'],
        ]);

        $data['product_createdate'] = now();

        Product::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully.');
    }

    public function destroyProduct(Product $product): RedirectResponse
    {
        if ($product->orderDetails()->exists()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'This product is linked to existing orders and cannot be deleted.');
        }

        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product removed successfully.');
    }

    public function updateDeliveryStatus(Request $request, OrderDetail $orderDetail): RedirectResponse
    {
        $validated = $request->validate([
            'delivery_status' => ['required', 'string', 'in:' . implode(',', $this->deliveryStatuses())],
        ]);

        $orderDetail->update([
            'delivery_status' => $validated['delivery_status'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Delivery status updated.');
    }

    private function deliveryStatuses(): array
    {
        return ['Pending', 'Packed', 'Shipped', 'Out for Delivery', 'Delivered', 'Cancelled'];
    }
}
