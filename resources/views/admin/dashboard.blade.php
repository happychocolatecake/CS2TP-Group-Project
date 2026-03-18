<x-admin-layout title="Admin Dashboard">
    <section class="max-w-7xl mx-auto px-4 py-8 space-y-8">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="mt-2 text-gray-600">Manage catalog items, inspect user order history, and update delivery progress in one place.</p>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Products</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $products->count() }}</p>
                </div>
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Registered Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->count() }}</p>
                </div>
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->sum(fn($user) => $user->orders->count()) }}</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-green-200 bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="rounded-md border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="rounded-md border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Basket Popularity (Live)</h2>
                    <p class="mt-1 text-sm text-gray-500">Top items currently in user baskets, ranked by quantity.</p>
                </div>
                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">Top 10</span>
            </div>

            @if ($basketPopularity->isEmpty())
                <p class="text-sm text-gray-500">No items are currently in any basket.</p>
            @else
                <div class="h-80">
                    <canvas id="basketPopularityChart"></canvas>
                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-sm">
                    @foreach ($basketPopularity as $item)
                        <div class="rounded-md bg-gray-50 border border-gray-200 px-3 py-2 flex items-center justify-between">
                            <span class="text-gray-700 truncate pr-3">{{ $item->product_name }}</span>
                            <span class="font-semibold text-gray-900">{{ $item->popularity }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <section class="xl:col-span-2 rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Product Catalogue</h2>
                    <p class="text-sm text-gray-500">Add new products or remove existing ones.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b border-gray-200">
                                <th class="py-2 pr-4">ID</th>
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Part</th>
                                <th class="py-2 pr-4">Category</th>
                                <th class="py-2 pr-4">Price</th>
                                <th class="py-2 pr-4">Stock</th>
                                <th class="py-2 pr-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-2 pr-4">{{ $product->id }}</td>
                                    <td class="py-2 pr-4 font-medium text-gray-900">{{ $product->product_name }}</td>
                                    <td class="py-2 pr-4">{{ $product->product_part }}</td>
                                    <td class="py-2 pr-4">{{ $product->category->category_name ?? 'Uncategorised' }}</td>
                                    <td class="py-2 pr-4">£{{ number_format($product->product_price, 2) }}</td>
                                    <td class="py-2 pr-4">{{ $product->product_stock }}</td>
                                    <td class="py-2 pr-4">
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Remove this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-500">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-gray-500">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900">Add Product</h2>
                <p class="mt-1 text-sm text-gray-500">Complete all required fields to publish a new item.</p>

                <form method="POST" action="{{ route('admin.products.store') }}" class="mt-5 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input name="product_name" value="{{ old('product_name') }}" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Model</label>
                        <input name="product_model" value="{{ old('product_model') }}" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" min="0" name="product_price" value="{{ old('product_price') }}" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" min="0" name="product_stock" value="{{ old('product_stock') }}" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Part Type</label>
                                <select id="part_type_select" name="product_part" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                    <option value="" disabled {{ old('product_part') ? '' : 'selected' }}>Select Part</option>
                                    <option value="N/A" @selected(old('product_part') == 'N/A')>N/A (Not a Computer Component)</option>
                                    <option value="CPU" @selected(old('product_part') == 'CPU')>CPU</option>
                                    <option value="GPU" @selected(old('product_part') == 'GPU')>GPU</option>
                                    <option value="RAM" @selected(old('product_part') == 'RAM')>RAM</option>
                                    <option value="Motherboard" @selected(old('product_part') == 'Motherboard')>Motherboard</option>
                                    <option value="Storage" @selected(old('product_part') == 'Storage')>Storage (SSD/HDD)</option>
                                    <option value="PSU" @selected(old('product_part') == 'PSU')>PSU</option>
                                    <option value="Case" @selected(old('product_part') == 'Case')>Case</option>
                                    <option value="Cooling Fan" @selected(old('product_part') == 'Cooling Fan')>Cooling Fan</option>
                                </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Colour</label>
                            <input name="product_colour" value="{{ old('product_colour') }}" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category_select" name="category_id" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image URL</label>
                        <input name="product_image" value="{{ old('product_image') }}" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tagline</label>
                        <input name="product_tagline" value="{{ old('product_tagline') }}" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="product_description" rows="3" required class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ old('product_description') }}</textarea>
                    </div>

                    <button type="submit" class="w-full rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 transition">
                        Add Product
                    </button>
                </form>
            </section>
        </div>

        <section class="rounded-2xl bg-white border border-gray-200 p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-900">Users and Order History</h2>
            <p class="mt-1 text-sm text-gray-500">Review every registered user and update delivery status per ordered item.</p>

            <div class="mt-6 space-y-6">
                @forelse ($users as $user)
                    <article class="rounded-xl border border-gray-200 p-4">
                        <!-- dropdown box for users order list -->
                        <details id="user-{{ $user->id }}" class="group py-4">
                        <summary class="cursor-pointer list-none">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h3>
                            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">{{ $user->orders->count() }} orders</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ $user->email }}</p>
                        </summary>
                        @if ($user->orders->isEmpty())
                            <p class="mt-3 text-sm text-gray-500">No orders yet.</p>
                        @else
                            <div class="mt-4 space-y-4">
                                @foreach ($user->orders as $order)
                                    <div class="rounded-lg border border-gray-200 p-4 bg-gray-50/50">
                                    <!-- dropdown box for products in order list -->
                                    <details class="group py-4">
                                        <summary class="cursor-pointer list-none">
                                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-700">
                                            <span class="font-semibold text-gray-900">Order #{{ $order->id }}</span>
                                            <span>Total: £{{ number_format($order->total_price, 2) }}</span>
                                            <span>Method: {{ ucfirst($order->delivery_method) }}</span>
                                            <span>Date: {{ optional($order->order_date)->format('d M Y H:i') }}</span>
                                            <!-- reused span from sams filter dropdown boxes -->
                                            <span class="transition group-close:rotate-180">
                                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                                    <path d="M6 9l6 6 6-6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        </summary>

                                        <div class="mt-3 overflow-x-auto">
                                            <table class="min-w-full text-sm bg-white rounded-md">
                                                <thead>
                                                    <tr class="text-left text-gray-500 border-b border-gray-200">
                                                        <th class="py-2 pr-4">Product</th>
                                                        <th class="py-2 pr-4">Qty</th>
                                                        <th class="py-2 pr-4">Item Price</th>
                                                        <th class="py-2 pr-4">Delivery Status</th>
                                                        <th class="py-2 pr-4">Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderDetails as $item)
                                                        @php $currentStatus = $item->delivery_status ?? 'Pending'; @endphp
                                                        <tr class="border-b border-gray-100">
                                                            <td class="py-2 pr-4">{{ $item->product->product_name ?? 'Removed product' }}</td>
                                                            <td class="py-2 pr-4">{{ $item->quantity }}</td>
                                                            <td class="py-2 pr-4">£{{ number_format($item->order_price, 2) }}</td>
                                                            <td class="py-2 pr-4 font-medium text-gray-800">{{ $currentStatus }}</td>
                                                            <td class="py-2 pr-4">
                                                                <form method="POST" action="{{ route('admin.order-items.delivery-status', $item) }}" class="flex flex-wrap items-center gap-2">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <select name="delivery_status" class="rounded-md border border-gray-300 px-2 py-1 text-xs">
                                                                        @foreach ($deliveryStatuses as $status)
                                                                            <option value="{{ $status }}" @selected($currentStatus === $status)>{{ $status }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <button type="submit" class="rounded-md bg-gray-900 px-3 py-1 text-xs font-medium text-white hover:bg-gray-700">Save</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </details>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        </details>
                    </article>
                @empty
                    <p class="text-sm text-gray-500">No registered users found.</p>
                @endforelse
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </section>
    </section>

    @if ($basketPopularity->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            (function () {
                const canvas = document.getElementById('basketPopularityChart');
                if (!canvas) {
                    return;
                }

                const labels = @json($basketChartLabels);
                const values = @json($basketChartValues);

                new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Items in baskets',
                            data: values,
                            backgroundColor: 'rgba(31, 41, 55, 0.75)',
                            borderColor: 'rgba(17, 24, 39, 1)',
                            borderWidth: 1,
                            borderRadius: 6,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    stepSize: 1,
                                },
                                title: {
                                    display: true,
                                    text: 'Quantity in baskets',
                                },
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Products',
                                },
                            },
                        },
                    },
                });
            })();
        </script>
    @endif
    <script>
    //this makes it easier for the admin as the page automatically scrolls down to where it left off after updating something
    /*document.addEventListener("DOMContentLoaded", function() {
        //checks for the hash in the details html tag and uses it to navigate its way and scroll there
        const hash = window.location.hash;
        if (hash) {
            setTimeout(() => {
                const targetDetails = document.querySelector(hash);
                if (targetDetails && targetDetails.tagName === 'DETAILS') {
                    targetDetails.setAttribute('open', '');
                    //makes sure it scrolls smoothly
                    targetDetails.scrollIntoView({behavior: 'smooth', block: 'center' });
                }
            }, 500);
        }
    });* i will check with jot if he wants it if not its gone */

    //making sure you cant select a product part if the category selected is not computer components
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_select');
        const partTypeSelect = document.getElementById('part_type_select');

        const componentCategoryName = "Computer Components";

        //checks for when the category selection changes
        categorySelect.addEventListener('change', function () {
            const selectedText = this.options[this.selectedIndex].text;

            if (selectedText === componentCategoryName) {
                //enable selection of the part type
                partTypeSelect.classList.remove('bg-gray-100', 'cursor-not-allowed', 'pointer-events-none');
                //if it was N/A, reset it to the normal selection prompt
                if (partTypeSelect.value === "N/A") {
                    partTypeSelect.value = "";
                }
            } else {
                //forces value to be N/A and locks the selection
                partTypeSelect.value = "N/A";
                partTypeSelect.classList.add('bg-gray-100', 'cursor-not-allowed', 'pointer-events-none');
            }
        });

        //run when page loads
        categorySelect.dispatchEvent(new Event('change'));
    });

    </script>
</x-admin-layout>

