<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasketItem;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest('id')->get();
        $categories = Category::orderBy('category_name')->get();
        //used paginate here to make sure the admin page is easy to view even with a lot of useres
        $users = User::with([
            'orders' => fn ($query) => $query->latest('id'),
            'orders.orderDetails.product',
        ])->orderBy('id')->paginate(10);

        $basketPopularity = BasketItem::query()
            ->join('products', 'products.id', '=', 'basket_items.product_id')
            ->select('products.product_name', DB::raw('SUM(basket_items.quantity) as popularity'))
            ->groupBy('products.id', 'products.product_name')
            ->orderByDesc('popularity')
            ->limit(10)
            ->get();

        $basketChartLabels = $basketPopularity->pluck('product_name')->values();
        $basketChartValues = $basketPopularity->pluck('popularity')->map(fn ($value) => (int) $value)->values();

        $deliveryStatuses = $this->deliveryStatuses();

        return view('admin.dashboard', compact(
            'products',
            'categories',
            'users',
            'deliveryStatuses',
            'basketPopularity',
            'basketChartLabels',
            'basketChartValues'
        ));
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

        //checks who owns the order and then uses it to locate where to scroll back to after updating
        //$userId = $orderDetail->order->user_id;

        //this is the redirect for the scroll thing
        //return redirect()->to(route('admin.dashboard') . '#user-' . $userId)->with('success', 'Delivery status updated.');
        return redirect()->route('admin.dashboard')->with('success', 'Delivery status updated.');
    }

    private function deliveryStatuses(): array
    {
        return ['Pending', 'Packed', 'Shipped', 'Out for Delivery', 'Delivered', 'Cancelled'];
    }
}
