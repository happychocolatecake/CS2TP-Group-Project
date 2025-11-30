<x-header></x-header>

<x-layout>
<main class="container mx-auto px-6 py-8 max-w-7xl">
    <x-product-page-breadcrumb />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20">
        <x-product-page-gallery />

        <div class="flex flex-col pt-2">
            <x-product-page-header />
            <p class="text-gray-700 text-lg mb-10">Description...</p>

            <x-product-page-variant-selecter />

            <x-product-page-purchase-actions />
        </div>
    </div>
</main>
</x-layout>

<x-footer></x-footer>