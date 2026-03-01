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
                        $avgRating = round($product->reviews->avg('rating'), 1); // e.g., 4.5
                        $totalReviews = $product->reviews->count();
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
            <!-- Customer reviews with images, name, date and comment-->
             <div class="w-full p-4 border border-grey-500 rounded-lg mt-10">
                <h3 class="text-lg font-bold mb-4 text-center"> Customer Reviews </h3>

                @if($product->reviews->count() > 0)
                    @foreach($product->reviews as $review)
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-4">
                                @if($review->review_image)
                                    <a href="{{ route('reviews.image.show', $review->id) }}" class="flex-shrink-0 group">
                                    <img src="{{ asset('images/reviews/' . $review->review_image) }}"
                                        class="w-24 h-24 object-cover rounded-lg shadow-sm border border-gray-100"
                                        alt="Review photo">
                                @else
                                    <!-- <img src="placeholder" class="w-24 h-15 object-cover" alt="No Image"> no image -->
                                @endif
                                    <div class="flex-1">
                                        <div class="flex justify-between mb-1">
                                            <span class="font-semibold"> {{ $review->user->first_name }} {{ $review->user->last_name }}</span>
                                            <span class="text-xs text-grey-500"> {{ $review->created_at->format('d F Y (H:i)') }} </span>
                                        </div>
                                        <p class= "text-grey-700 text-sm"> {{ $review->review_text }} </p>
                                    @php
                                        //obtain order quantity for the review
                                        $orderDetail = \App\Models\OrderDetail::where('order_id', $review->order_id)
                                                        ->where('product_id', $review->product_id)
                                                        ->first();
                                    @endphp
                                        <p class= "text-xs font-extralight"> Purchased {{$orderDetail->quantity}}</p>
                                    </div>

                            </div>
                    @endforeach
                     <!-- <div class="mt-2 text-center font-bold text-grey-600 cursor-pointer"> Show more reviews</div> -->
                @else
                    <p class="font-bold">No reviews yet.</p>
                @endif
</div>
</div>
</main>
</x-layout>

<x-footer></x-footer>


