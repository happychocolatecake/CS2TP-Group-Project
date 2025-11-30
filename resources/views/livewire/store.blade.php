<div>
    <!-- Search Input -->
    <div class="mb-8 flex justify-center">
        <div class="relative w-full max-w-md">
            <input 
                wire:model.live="search" 
                type="text" 
                placeholder="Search for products..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-500"
            >
        </div>
    </div>

    <!-- Product Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
        <!-- No Results State -->
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">No products found</h3>
            <p class="text-gray-500">We couldn't find any products matching "{{ $search }}"</p>
        </div>
    @endif
</div>
