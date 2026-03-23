<x-header></x-header>

<x-layout>
    <div class="mb-10 grid grid-cols-1 overflow-hidden rounded-[2rem] border border-orange-100 bg-gradient-to-r from-orange-50 via-white to-amber-50 shadow-sm shadow-orange-100/60 md:mb-12 md:grid-cols-2 dark:border-gray-800 dark:bg-gray-900 dark:shadow-none">


        <div class="h-56 overflow-hidden sm:h-72 md:h-auto">
            <img src="/images/hero_pc.jpg" alt="Cool PC" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
        </div>

        <div class="p-6 sm:p-8 md:p-12 flex flex-col justify-center">

            <h1 class="text-2xl sm:text-3xl font-bold mb-4 text-gray-900">
                "Your Dream Build. Without the Guesswork."
            </h1>

            <p class="text-gray-600 mb-6 sm:mb-8">
                    We offer the best prices on CPUs, GPUs and pre-builts. Better service, better gaming.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <a href="/store" class="rounded-full bg-orange-500 px-6 py-3 text-center font-semibold text-white shadow-lg shadow-orange-200/60 transition hover:bg-orange-600">
                    Shop Now
                </a>
                <a href="/build-guide" class="rounded-full border border-orange-200 bg-white px-6 py-3 text-center font-semibold text-orange-700 transition hover:bg-orange-50">
                    Build Guide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">

            <a href="/store?selectedCategories[0]=1" class="block group">
                <div class="transform transition duration-300 hover:translate-y-2 hover:shadow-lg">
                    <div class="mb-3 flex h-48 items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-amber-100 transition group-hover:-translate-y-1 group-hover:border-orange-200 group-hover:shadow-lg group-hover:shadow-orange-100/70">
                        <span class="font-bold text-xl text-orange-700">Components</span>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-orange-950">Shop Individual Parts</h3>
            </a>

            <a href="/store?selectedCategories[0]=2" class="block group">
                <div class="transform transition duration-300 hover:translate-y-1 hover:shadow-lg">
                    <div class="mb-3 flex h-48 items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-amber-100 transition group-hover:-translate-y-1 group-hover:border-orange-200 group-hover:shadow-lg group-hover:shadow-orange-100/70">
                        <span class="font-bold text-xl text-orange-700">Pre-Built</span>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-orange-950">Ready to Game</h3>
            </a>

            <a href="/store?selectedCategories[0]=3" class="block group">
                <div class="transform transition duration-300 hover:translate-y-2 hover:shadow-lg">
                    <div class="mb-3 flex h-48 items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-amber-100 transition group-hover:-translate-y-1 group-hover:border-orange-200 group-hover:shadow-lg group-hover:shadow-orange-100/70">
                        <span class="font-bold text-xl text-orange-700">Bundles</span>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-orange-950">Save with Bundles</h3>
            </a>
        </div>

    </div>

    <div class="mb-16 rounded-[2rem] bg-gradient-to-b from-white to-orange-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h2 class="mb-10 text-center text-3xl font-bold text-orange-950">Best Sellers</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @foreach ( $bestSellers as $product )

                    @php
                        $avgRating = $product->reviews_avg_rating ?? 0;
                    @endphp

                    <form method="POST" action="{{ route('basket.add') }}">

                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="quantity" value="1">
                        @csrf
                            <div class="transform transition duration-200 hover:scale-105 hover:shadow-lg">
                                <a href="{{ route('product.show', $product->id)}}" class="block">
                                    <x-product-card
                                        title="{{$product->product_name}}"
                                       tagline="{{$product->product_tagline}}"
                                        price="{{$product->product_price}}"
                                        image="{{$product->product_image}}"
                                        :avgRating="$avgRating"
                                        :context="'index'"

                                    />
                                </a>
                            </div>
                    </form>

                @endforeach

            </div>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white py-16 ring-1 ring-orange-100/80">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center w-full justify-center">
                <div class="hidden md:block -mt-12">
                    <img src="{{asset('images/reviewmouse.png')}}" class="w-40 h-40 object-scale-down">
                </div>
                <div class="text-center mb-10 md:mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">What Our Users Say</h2>
                    <p class="text-gray-600 mt-2">Real feedback from our community.</p>
                </div>
                <div class="hidden md:block -mt-12">
                    <img src="{{asset('images/reviewmouse.png')}}" class="w-40 h-40 object-scale-down -scale-x-100">
                </div>
            </div>

            @auth
                @if($userReview)
                    <div class="mx-auto mb-12 max-w-3xl rounded-2xl border-2 border-orange-100 bg-orange-50/70 p-5 shadow-sm sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 font-bold text-white">
                                    {{ substr($userReview->user->first_name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Your Review</h3>
                                    <span class="text-xs px-2 py-1 rounded-full {{ $userReview->review_status == 'Approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $userReview->review_status }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-4 text-sm">
                                <form action="{{ route('website-reviews.destroy', $userReview->id) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div class="flex text-yellow-400 mb-2">
                            @for($i=1; $i<=5; $i++)
                                <span class="text-lg">{{ $i <= $userReview->rating ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                        <p class="text-gray-700 italic">"{{ $userReview->review_text }}"</p>
                        <p class="mt-3 text-xs text-gray-500">Once submitted, website reviews cannot be edited.</p>
                    </div>
                @else
                    <div class="text-center mb-12">
                        <button onclick="document.getElementById('websiteReviewPopup').classList.remove('hidden')"
                                class="rounded-full bg-orange-500 px-8 py-3 font-bold text-white shadow-lg shadow-orange-200/60 transition hover:bg-orange-600">
                            Write a Website Review
                        </button>
                    </div>
                    </div>
                @endif
            @endauth

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($websiteReviews as $review)
                <div class="flex flex-col justify-between rounded-2xl border border-orange-100 bg-white p-8 shadow-sm shadow-orange-100/50 transition-transform hover:scale-[1.02] hover:shadow-lg hover:shadow-orange-100/70">
                    <div>
                        <div class="flex text-yellow-400 mb-4">
                            @for($i=1; $i<=5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                        <p class="text-gray-600 italic leading-relaxed mb-6">"{{ $review->review_text }}"</p>
                    </div>

                    <div class="flex items-center gap-3 border-t pt-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 font-semibold text-orange-700">
                            {{ substr($review->user->first_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $review->user->first_name }} {{ $review->user->last_name }}</p>
                            <p class="text-xs text-gray-400">{{ $review->created_at ? $review->created_at->format('M d, Y') : 'Recently' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $websiteReviews->links() }}
            </div>
        </div>
    </div>
    <br>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 text-center">

        <h2 class="text-2xl sm:text-3xl font-bold mb-4">Not sure where to start?</h2>
        <p class="text-gray-600 mb-10 sm:mb-12">Save your time of researching, and use our resources to configure your computer.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <div class="flex flex-col item-center">
            <div class="mb-4 flex items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-white p-6 shadow-sm shadow-orange-100/50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>

            </div>
            <p class="rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm text-orange-900 shadow-sm shadow-orange-100/40">Purchase Bundles, chosen by our experts</p>
        </div>

        <div class="flex flex-col item-center">
            <div class="mb-4 flex items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-white p-6 shadow-sm shadow-orange-100/50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

            </div>
            <p class="rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm text-orange-900 shadow-sm shadow-orange-100/40">Configure and check for compactibility to build your dream PC</p>
        </div>

        <div class="flex flex-col item-center">
            <div class="mb-4 flex items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-white p-6 shadow-sm shadow-orange-100/50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
                </svg>

            </div>
            <p class="rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm text-orange-900 shadow-sm shadow-orange-100/40">To learn the essentials of building a PC, read our guides.</p>
        </div>

        </div>

        <div class="mt-12">
            <a href="/build-guide" class="rounded-full bg-orange-500 px-8 py-3 text-white shadow-lg shadow-orange-200/60 transition hover:bg-orange-600 dark:bg-gray-800">
                Start Now
            </a>
        </div>
    </div>

    <div id="websiteReviewPopup" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="max-h-[90vh] w-full max-w-md overflow-y-auto rounded-2xl border border-orange-100 bg-white p-6 shadow-2xl shadow-orange-100/70 sm:p-8">
            <h2 class="text-2xl font-bold mb-4">Write a Review</h2>

            <form action="{{ route('website-reviews.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Rating</label>
                    <select name="rating" class="w-full border rounded-lg p-2">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold mb-2">Your Feedback</label>
                    <textarea name="review_text" rows="4" class="w-full border rounded-lg p-2" placeholder="What did you think of our service?"></textarea>
                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <button type="button" onclick="document.getElementById('websiteReviewPopup').classList.add('hidden')" class="px-4 py-2 text-gray-500">Cancel</button>
                    <button type="submit" class="rounded-lg bg-orange-500 px-6 py-2 font-bold text-white transition hover:bg-orange-600">Submit Review</button>
                </div>
            </form>
        </div>
    </div>


</x-layout>

<x-footer></x-footer>



