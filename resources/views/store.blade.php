<x-header></x-header>
<!--Filter-->
<x-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Store Components</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <aside class="md:col-span-1">
                <h2 class="text-2xl font-bold mb-4">Filter</h2>

                <x-filter-group title="Category" open>
                    <x-filter-item label="Gaming PCs" name="category_gaming" />
                    <x-filter-item label="Laptops" name="category_laptops" />
                    <x-filter-item label="Accessories" name="category_accessories" />
                </x-filter-group>

                <x-filter-group title="Price">
                     <div class="px-1">
                        <input type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                        <div class="flex justify-between text-xs mt-2">
                            <span>£0</span>
                            <span>£3000+</span>
                        </div>
                    </div>
                </x-filter-group>

                <x-filter-group title="Primary Colour" open>
                    <x-filter-item label="Black" name="color_black" />
                    <x-filter-item label="White" name="color_white" />
                    <x-filter-item label="Silver" name="color_silver" />
                </x-filter-group>

            </aside>

            <main class="md:col-span-3">
                </main>

        </div>
    </div>

<!--menu-->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
    @foreach(range(1, 16) as $item)
            <x-product-card 
                title="Popular Pre-Built #{{ $item }}" 
                description="High performance gaming rig suitable for 4k gaming." 
                price="$1200"
            />
        @endforeach
</div>

</x-layout>
<x-footer></x-footer>