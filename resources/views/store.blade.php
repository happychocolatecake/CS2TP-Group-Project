<x-header></x-header>
<x-layout>

    <!--Filter-->
    <div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Store</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

        <aside class="md:col-span-1">

            <h2 class="text-2xl font-bold mb-4">Filter</h2>

            <!-- 1. Category Group (Open by default) -->
            <x-filter-group title="Category" open>
                <x-filter-item label="Prebuilt PCs" name="category_prebuilt" />
                <x-filter-item label="Components" name="category_components" />
                <x-filter-item label="Bundles" name="category_bundles" />
            </x-filter-group>

            <!-- 2. Price Group (Closed by default) -->
            <x-filter-group title="Price">
                <div class="px-1">
                    <p>Price slider or range inputs go here.</p>
                </div>
            </x-filter-group>

            <!-- 3. Colour Group (Closed by default) -->
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

                {{-- The product cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                    @foreach($products as $item)
                        @php
                            $title = $item->product_name;
                            $image = $item->product_image;
                            $price = $item->product_price;
                            //this checks if the descriptions empty it will fill it with placeholder data
                            $description = !empty($item->product_description) ? $item->product_description : 'This item is still in development.';
                        @endphp
                        <x-product-card
                            :title="$title"
                            :description="$description"
                            :price="$price"
                            :image="$image"
                        />
                    @endforeach
            </div>
        </main>
    </div>
</x-layout>
<x-footer></x-footer>
