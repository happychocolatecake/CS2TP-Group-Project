<x-header></x-header>

<x-layout>

    @if (session('success'))
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="container mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">Store</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <aside class="md:col-span-1">
                <h2 class="text-2xl font-bold mb-4">Filter</h2>
                <x-filter-group title="Category" open>
                    <x-filter-item label="Prebuilt PCs" name="category_prebuilt" />
                    <x-filter-item label="Components" name="category_components" />
                    <x-filter-item label="Bundles" name="category_bundles" />
                </x-filter-group>
                <x-filter-group title="Price">
                    <div class="px-1">
                        <p>Price slider or range inputs go here.</p>
                    </div>
                </x-filter-group>
                <x-filter-group title="Primary Colour">
                    <x-filter-item label="Black" name="color_black" />
                    <x-filter-item label="White" name="color_white" />
                    <x-filter-item label="Silver" name="color_silver" />
                </x-filter-group>
            </aside>

            <main class="md:col-span-3">
                <div class="flex justify-end items-center space-x-4 mb-6">
                    <button class="px-4 py-2 border border-gray-300 rounded bg-white hover:bg-gray-50 text-sm font-medium">
                        Sort By
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                    @foreach($products as $item)

                        <form method="POST" action="{{ route('basket.add') }}">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <input type="hidden" name="quantity" value="1">

                            @php
                                $title = $item->product_name;
                                $image = $item->product_image;
                                $price = $item->product_price;
                                $description = !empty($item->product_description) ? $item->product_description : 'This item is still in development.';
                            @endphp

                            <x-product-card
                                :title="$title"
                                :description="$description"
                                :price="$price"
                                :image="$image"
                            />

                            <button type="submit" class="w-full mt-2 p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Add to Basket
                            </button>

                        </form>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</x-layout>

<x-footer></x-footer>
