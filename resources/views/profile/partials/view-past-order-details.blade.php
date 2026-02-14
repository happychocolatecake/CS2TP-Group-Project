<x-header></x-header>

<x-layout>
<body class="bg-gray-100 min-h-screen flex flex-col">
<div class="container mx-auto px-6 ">
<br>
<!-- title of the page -->
<h1 class="text-3xl font-extrabold text-gray-800 mb-4 text-center">Your Order Details</h1>

<div class="flex justify-between items-center mb-8">
    <!-- on the left its order number -->
    <p class="text-gray-700 font-semibold text-xl">Order #12345</p>
    <!-- the middle its the date of the order -->
    <p class="text-gray-600 text-semibold text-xl">Placed on Feb 14, 2026</p>
    <!-- on the right its status -->
    <span class="px-6 py-1.5 rounded-lg text-lg font-semibold bg-indigo-600 text-white"> Ordered </span>
</div>

<!-- box for all order items -->
<div class="lg:col-span-2 space-y-6 mb-8"> 
    <!-- example of a ordered item -->
    <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row items-start gap-6 border border-gray-200">
        <div class="flex-shrink-0">
            <!-- the image of the item-->
            <img src="#" alt="Item" class="w-24 h-24 object-cover rounded-lg shadow-sm">
        </div>
        <div class="flex-1 min-w-0">
              <!-- shows the item name -->
            <p class="text-xl font-bold text-gray-800 mb-1"> Product 1</p>
              <!-- show the model of the item -->
            <p class="text-sm text-gray-500 mb-3">Model: ABC123</p>
        </div>

        <div class="flex flex-col items-end md:items-center gap-2 md:gap-4 md:w-40">
              <!-- shows the price of this item -->
            <div class="font-bold text-lg text-gray-800">£20.00</div>
              <!-- shows the quantity of this item -->
            <div class="px-3 py-1 border border-gray-300 rounded-lg text-center font-semibold text-gray-700"> Quantity: 2 </div>
        </div>
    </div>
</div>


<!-- box for the order details and order summary -->
<div class="flex flex-col md:flex-row gap-6 mb-8">
    
    <!-- the order details box -->
    <div class="flex-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <!-- the heading for the box -->
        <h2 class="text-2xl font-bold mb-4 text-gray-800 mb-4 text-center">Order Details</h2>

        <!-- showing customer details -->
        <p class="text-lg"><span class="font-semibold">Name:</span> Hello </p>
        <p class="text-lg"><span class="font-semibold">Email:</span> hello@example.com</p>
        <p class="text-lg"><span class="font-semibold">Phone Number:</span> +447845723384</p>
        <p class="text-lg"><span class="font-semibold">Shipping Address:</span> 123 Hello Street, City B11 1AA</p>
    </div>
    
    <!-- the order summary box -->
    <div class="flex-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <!-- the heading for the box -->
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Order Summary</h2>

        <!-- Showing the prices of the order -->
        <p class="text-lg mb-2"><span class="font-semibold">Subtotal:</span> £150.00</p>
        
        <p class="text-lg mb-2"><span class="font-semibold">Delivery Charges:</span> £5.00</p>
        
        <p class="text-lg mb-2"><span class="font-semibold">Grand Total:</span> £155.00</p>
    </div>

</div>



</div>
</x-layout>
</body>
<x-footer></x-footer>