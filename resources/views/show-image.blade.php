 <x-header></x-header>
    <x-layout>

    @php
        //obtain order quantity for the review
        $itemName = \App\Models\Product::where('id', $review->product_id)
            ->first()->product_name;
    @endphp
    <div class=" min-h-screen flex flex-col items-center justify-center p-6">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="flex items-center hover:text-indigo-400 transition font-bold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Product
            </a>
        </div>

        <div class="max-w-4xl w-full bg-black rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <img src="{{ asset('images/reviews/' . $review->review_image) }}"
                 class="w-full h-auto max-h-[70vh] object-contain mx-auto"
                 alt="Expanded review image">

            <div class="p-6 bg-gray-800 text-white">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">{{ $review->user->first_name }}'s Review on the {{$itemName}}</h2>
                    <span class="text-gray-400 text-sm">{{ $review->created_at->format('M d, Y') }}</span>
                </div>
                <p class="text-gray-300 italic">"{{ $review->review_text }}"</p>

                <!--downloadable button so you can download the image from the review -->
                <div class="mt-4">
                    <a href="{{ asset('storage/' . $review->review_image) }}" download
                       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm transition">
                        Download Image
                    </a>
                </div>
            </div>
        </div>
    </div>

    </x-layout>
    <x-footer></x-footer>

