<<<<<<< HEAD
@props(['title', 'description', 'price', 'image'])

<div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center h-full">
    <div class="w-full bg-gray-200 h-48 rounded mb-6 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
    </div>
    
    <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
    
    <p class="text-gray-500 text-sm mb-6 flex-grow line-clamp-3">
        {{ $description }}
    </p>
    
    <div class="mt-auto w-full">
        <span class="block text-lg font-bold mb-2">£{{ $price }}</span>
        <button class="w-full bg-gray-800 text-white px-8 py-2 rounded hover:bg-gray-700 transition">
            Buy now
        </button>
    </div>
=======
<!--The product cards found on the store-->
@props(['title','description','price','image'])

<div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center">
    <div class="w-full bg-gray-200 h-48 rounded mb-6">
        <img src={{$image ?? ''}} double bracket here alt="product image">
    </div>
    <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
    <p class="text-gray-500 text-sm mb-6">{{ $description }}</p>
    <p class="text-gray-400 text-sm mb-6">£{{ $price }}</p>
    <button class="mt-auto bg-gray-800 text-white px-8 py-2 rounded hover:bg-gray-700 transition">
        Buy now
    </button>
>>>>>>> origin/main
</div>
