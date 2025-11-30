<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Store</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- Sidebar Filter -->
        <aside class="md:col-span-1">
            <h2 class="text-2xl font-bold mb-4">Filter</h2>

            <x-filter-group title="Category" open>
                <x-filter-item label="Prebuilt PCs" name="category_prebuilt" />
                <x-filter-item label="Components" name="category_components" />
                <x-filter-item label="Bundles" name="category_bundles" />
            </x-filter-group>

            <x-filter-group title="Price">
                <div class="px-1">
                    <p class="text-sm text-gray-500">Price slider coming soon.</p>
                </div>
            </x-filter-group>

            <x-filter-group title="Primary Colour">
                <x-filter-item label="Black" name="color_black" />
                <x-filter-item label="White" name="color_white" />
                <x-filter-item label="Silver" name="color_silver" />
            </x-filter-group>
        </aside>

        <!-- Main Content Area -->
        <main class="md:col-span-3">
            
            <!-- Top Bar: Search & Sort -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full md:w-1/2">
                    <input 
                        wire:model.live="search" 
                        type="text" 
                        placeholder="Search products..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-500"
                    >
                </div>

                <button class="px-4 py-2 border border-gray-300 rounded bg-white hover:bg-gray-50 text-sm font-medium">
                    Sort By
                </button>
            </div>

            <!-- Product Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <x-product-card
                            :title="$product->product_name"
                            :description="$product->product_description"
                            :price="$product->product_price"
                            :image="$product->product_image"
                        />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                    <p class="text-gray-500">We couldn't find any products matching "{{ $search }}"</p>
                </div>
            @endif

        </main>
    </div>
</div>
