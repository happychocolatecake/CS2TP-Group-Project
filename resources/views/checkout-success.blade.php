<x-header></x-header>
<x-layout>
    
<section class="bg-gray-100 py-10 md:py-12">
    <main class="container mx-auto max-w-4xl px-4">
        <div class = "mx-auto rounded-2xl border border-grey-200 bg-white p-10 shadow-lg text-center">
            

            <!-- confirmation title -->
             <h1 class= "text-4xl font-extrabold text-grey-800 mb-4">
                Order Placed Successfully
            </h1>

            <p class="text-grey-600 text-lg">
                Thank you for shopping with us.
            </p>

            <p class= "text-sm text-grey-500 mb-8">
                A confirmation has been sent to your inbox.
            </p>

             @if(session('order_total'))
            <p><strong>Total Paid:</strong> £{{ number_format(session('order_total'), 2) }}</p>
        @endif
        <br>

        <!-- the back to store button -->
         <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href= "{{route('store.index')}}"
            class= "rounded-lg border border-gray-300 bg-white px-6 py-3 text-lg font-bold text-grey-700 shadow-sm transition hover:bg-gray-100">
            Back to Store 
        </a>

        <!-- the order history button -->
         <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href= "{{route('store.index')}}"
            class= "rounded-lg border border-gray-300 bg-white px-6 py-3 text-lg font-bold text-grey-700 shadow-sm transition hover:bg-gray-100">
            Order History
        </a>

</div>
</main>
</section>
</x-layout>
<x-footer></x-footer>

