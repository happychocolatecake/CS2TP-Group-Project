@props(['title', 'tagline', 'price', 'image', 'context'])

<div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center h-full">
    <div class="w-full bg-white h-48 rounded mb-6 overflow-hidden flex items-center justify-center">
        <img src="{{ $image ?? '' }}" alt="{{ $title }}" class="max-w-full max-h-full object-scale-down">
    </div>

    <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>

    <p class="text-gray-500 text-sm mb-6 flex-grow line-clamp-3">
        {{ $tagline }}
    </p>

    @if($context !== 'index')
        <div class="mt-auto w-full">
            <span class="block text-lg font-bold mb-2">£{{ $price }}</span>
            <button class="w-full bg-gray-800 text-white px-8 py-2 rounded hover:bg-gray-700 transition">
                Buy now
            </button>
        </div>

        <div class="mt-auto w-full">
            <button type="submit" class="w-full mt-2 p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Add to Basket
            </button>
        </div>
    @endif

</div>
