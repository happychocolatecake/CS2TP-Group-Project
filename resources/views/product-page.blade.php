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

        <main class="container mx-auto px-6 py-8 max-w-7xl">
            <x-product-page-breadcrumb />


            <form method="POST" action="{{ route('basket.add') }}">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1"> <!-- doing 1 for now -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20">

                    @php
                        $title = $product->product_name;
                        $brandName = $product->product_model;
                        $image = $product->product_image;
                        $description = !empty($product->product_description) ? $product->product_description : 'This item is still in development.';
                        $price = $product->product_price;
                        $stock = $product->product_stock;
                        $colour = $product->product_colour;
                        //we will only use approved review stats for the products
                        $approvedReviews = $product->reviews->where('review_status', 'Approved');

                            $avgRating = round($approvedReviews->avg('rating'), 1);
                            $totalReviews = $approvedReviews->count();
                    @endphp

                    <x-product-page-gallery
                    :image=$image
                    />

                    <div class="flex flex-col pt-2">

                        <x-product-page-header
                        :title=$title
                        :brandName=$brandName
                        :avgRating="$avgRating"
                        :totalReviews="$totalReviews" />

                        <p class="text-gray-700 text-lg mb-10">{{$description}}</p>

                        <x-product-page-variant-selecter
                        variant1={{$colour}}
                        />

                        <x-product-page-purchase-actions
                        :stock=$stock
                        :price=$price />
                    </div>
                </div>
            </form>


                @if($approvedReviews->count() > 0)
                     <!-- Customer reviews with images, name, date and comment-->
             <div class="w-full p-4 border-2 border-grey-500 rounded-lg mt-10">
                <h3 class="text-lg font-bold mb-4 text-center"> Customer Reviews </h3>

                    @foreach($approvedReviews as $review)
                        <!-- only show approved reviews-->
                        @if($review->review_status === 'Approved')
                        <div class="flex flex-col gap-4 mb-8 border-b border-gray-100 pb-6">
                            <div class="flex gap-6">
                                <div class="w-24 flex-shrink-0">
                                    @if($review->review_image)
                                        <a href="{{ route('reviews.image.show', $review->id) }}" class="block group">
                                            <img src="{{ asset('images/reviews/' . $review->review_image) }}"
                                            class="w-24 h-24 object-cover rounded-lg shadow-sm border border-gray-100"
                                            alt="Review photo">
                                        </a>
                                    @else
                                            <!-- no image -->
                                            <div class="w-24 h-24 bg-gray-50 rounded-lg border border-dashed border-gray-200 flex items-center justify-center text-gray-400 text-[10px] text-center px-1">
                                                No Photo
                                            </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <div>
                                            <span class="font-semibold text-lg block">
                                                {{ $review->user->first_name }} {{ $review->user->last_name }}
                                            </span>
                                            <div class="flex text-yellow-400 text-sm mt-0.5">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                                @endfor
                                            </div>
                                        </div>
                                        <span class="text-xs text-grey-500 px-2 py-1 rounded">
                                            {{ $review->created_at->format('d F Y (H:i)') }}
                                        </span>
                                    </div>
                                        <p class= "text-grey-700 text-sm mt-3 leading-relaxed">

                                            @if(strlen($review->review_text) > 120)
                                                "{{ \Illuminate\Support\Str::limit($review->review_text, 120, '...') }}"
                                                <a href="{{ route('reviews.image.show', $review->id) }}"
                                                class="text-indigo-600 font-medium hover:underline ml-1">
                                                    Read full review
                                                </a>
                                            @else
                                                {{ $review->review_text }}
                                                <div class="mt-2 text-sm">
                                                    <a href="{{ route('reviews.image.show', $review->id) }}"
                                                    class="text-indigo-600 font-medium hover:underline">
                                                        Read full review
                                                    </a>
                                                </div>
                                            @endif
                                        </p>
                                    @php
                                        //obtain order quantity for the review
                                        $orderDetail = \App\Models\OrderDetail::where('order_id', $review->order_id)->where('product_id', $review->product_id)->first();
                                    @endphp
                                        <div class="mt-4 flex items-center gap-3">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-green-600 bg-green-50 px-2 py-0.5 rounded border border-green-100">
                                                Verified Purchase
                                            </span>
                                            <p class="text-xs text-gray-400 italic">Purchased: {{ $orderDetail->quantity ?? 1 }}</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                @endif
</div>
</div>
</main>
</x-layout>
<x-footer></x-footer>


