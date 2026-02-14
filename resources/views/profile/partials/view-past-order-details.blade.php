<x-header></x-header>

<x-layout>

<div class="container mx-auto px-6">
<br>
<h1 class="text-3xl font-bold text-gray-800 mb-2">Your Order Details</h1>
<br>
<div class="flex justify-between items-center mb-8">
    <!-- on the left its order number -->
    <p class="text-gray-700 font-semibold">Order #12345</p>
    <p class="text-gray-500 text-semibold">Placed on Feb 14, 2026</p>

    <!-- on the right its status -->
    <span class="px-6 py-1.5 rounded-lg text-sm font-semibold bg-yellow-500 text-white">
    Delivering
    </span>

</div>


<div class="lg:col-span-2 space-y-6"> 
    <!-- Example of a order item -->
    <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row items-start gap-6 border border-gray-200">
        <div class="flex-shrink-0">
            <img src="#" alt="Item" class="w-24 h-24 object-cover rounded-lg shadow-sm">
        </div>

        <div class="flex-1 min-w-0">
            <p class="text-xl font-bold text-gray-800 mb-1"> Product 1</p>
            <p class="text-sm text-gray-500 mb-3">Model: ABC123</p>
        </div>

        <div class="flex flex-col items-end md:items-center gap-2 md:gap-4 md:w-40">
            <div class="font-bold text-lg text-gray-800">£20.00</div>
            <div class="px-3 py-1 border border-gray-300 rounded-lg text-center font-semibold text-gray-700">
                Quantity: 2
            </div>
        </div>
    </div>

    <!-- Example of a order item -->
    <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row items-start gap-6 border border-gray-200">
        <div class="flex-shrink-0">
            <img src="#" alt="Item" class="w-24 h-24 object-cover rounded-lg shadow-sm">
        </div>

        <div class="flex-1 min-w-0">
            <p class="text-xl font-bold text-gray-800 mb-1"> Product 2</p>
            <p class="text-sm text-gray-500 mb-3">Model: ABC123</p>
        </div>

        <div class="flex flex-col items-end md:items-center gap-2 md:gap-4 md:w-40">
            <div class="font-bold text-lg text-gray-800">£15.00</div>
            <div class="px-3 py-1 border border-gray-300 rounded-lg text-center font-semibold text-gray-700">
                Quantity: 1
            </div>
        </div>
    </div>
</div>






</div>
</x-layout>
<br>

<x-footer></x-footer>