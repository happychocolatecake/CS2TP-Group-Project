@props([
    'title',
    'tagline',
    'price',
    'image',
    'context',
    'avgRating' => 0,
    'stock' => null,
    'category' => null,
    'part' => null,
])

@php
    $stock = is_numeric($stock) ? (int) $stock : null;
    $stockLabel = $stock === null
        ? null
        : ($stock <= 0
            ? 'Out of stock'
            : ($stock <= 5 ? 'Low stock' : 'In stock'));

    $stockClasses = $stock === null
        ? ''
        : ($stock <= 0
            ? 'bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-200'
            : ($stock <= 5
                ? 'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-200'
                : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-200'));
@endphp

<div class="flex h-full flex-col rounded-2xl border border-orange-100 bg-white p-4 text-center shadow-sm shadow-orange-100/50 transition duration-200 hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg hover:shadow-orange-100/70 dark:border-gray-800 dark:bg-gray-900 dark:shadow-none dark:hover:border-gray-700 dark:hover:shadow-lg dark:hover:shadow-black/20">
    <div class="mb-5 flex w-full items-start justify-between gap-3">
        <div class="flex flex-wrap gap-2 text-xs">
            @if ($category)
                <span class="rounded-full bg-orange-50 px-3 py-1 font-medium text-orange-700 dark:bg-white/10 dark:text-slate-200">{{ $category }}</span>
            @endif
            @if ($part)
                <span class="rounded-full bg-amber-50 px-3 py-1 font-medium text-amber-700 dark:bg-indigo-500/10 dark:text-indigo-200">{{ $part }}</span>
            @endif
        </div>

        @if ($stockLabel)
            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $stockClasses }}">{{ $stockLabel }}</span>
        @endif
    </div>

    <div class="mb-5 flex h-44 w-full items-center justify-center overflow-hidden rounded-xl bg-orange-50/70 dark:bg-slate-950">
        <img src="{{ $image ?? '' }}" alt="{{ $title }}" class="max-h-full max-w-full object-scale-down">
    </div>

    <h3 class="text-lg font-bold text-gray-900 dark:text-white sm:text-xl">{{ $title }}</h3>

    <p class="mt-2 flex-grow text-sm text-gray-500 dark:text-gray-400 line-clamp-3">
        {{ $tagline }}
    </p>

    <div class="mb-4 mt-4 text-sm">
        @if ($avgRating > 0)
            <div class="flex items-center justify-center gap-1 text-yellow-400">
                @for ($i = 1; $i <= 5; $i++)
                    <span>{!! $i <= round($avgRating) ? '&starf;' : '&star;' !!}</span>
                @endfor
                <span class="ml-2 text-gray-600 dark:text-gray-300">{{ number_format($avgRating, 1) }}/5</span>
            </div>
        @else
            <div class="flex items-center justify-center gap-2 text-gray-300 dark:text-gray-600">
                <span>{!! '&star; &star; &star; &star; &star;' !!}</span>
                <span class="text-xs italic text-gray-400 dark:text-gray-500">No reviews yet</span>
            </div>
        @endif
    </div>

    @if ($context !== 'index')
        <div class="mt-auto w-full">
            <div class="flex flex-col gap-2">
                <span class="block text-lg font-bold text-gray-900 dark:text-white">&pound;{{ $price }}</span>

                <button
                    type="submit"
                    formmethod="GET"
                    formaction="{{ route('checkout.direct') }}"
                    @disabled($stock !== null && $stock <= 0)
                    class="w-full rounded-lg border border-orange-200 bg-white px-6 py-2 text-orange-700 transition hover:bg-orange-50 disabled:cursor-not-allowed disabled:opacity-50 dark:border-gray-700 dark:bg-slate-950 dark:text-white dark:hover:bg-gray-800"
                >
                    Buy now
                </button>

                <button
                    type="submit"
                    @disabled($stock !== null && $stock <= 0)
                    class="w-full rounded-lg bg-orange-500 p-2 text-white transition hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-indigo-600 dark:hover:bg-indigo-700"
                >
                    Add to Basket
                </button>
            </div>
        </div>
    @endif
</div>
