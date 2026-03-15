<!--The title, brand and review-->
<div class="mb-10">
    <h1 class="text-6xl font-normal mb-2 tracking-tight">{{ $title }}</h1>
    <h2 class="text-2xl font-bold">{{ $brandName}}</h2>
    <h3 class="text-1xl font-bold mb-6 text-gray-500"> {{ $pcPart}} </h3>
    <!-- start reviews of the product-->
    <div class="flex items-center gap-4">
        <!-- labels and star -->
        <div class="flex text-black gap-2">
          <div class="text-yellow-400 text-lg">
            @for ($i = 1; $i <=5 ; $i++)
                {{ $i <= $avgRating ? '★' : '☆' }}
            @endfor

        </div>
    </div>
        <span class="text-sm text-gray-500 font-bold">{{ $avgRating }}/5</span>

    </div>


        @if ($totalReviews == 1)
            <span class="text-sm text-gray-500 font-extrabold">{{ $totalReviews }} Review</span>

        @else
            <span class="text-sm text-gray-500 font-extrabold">{{ $totalReviews }} Reviews</span>
        @endif
</div>
