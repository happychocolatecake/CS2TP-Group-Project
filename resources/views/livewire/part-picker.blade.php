@if (session('success'))
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
@endif

<div class="relative min-h-screen w-full bg-gray-200/50 dark:bg-gray-800/50">

    <x-video-background lightOpacity="opacity-10" darkOpacity="opacity-40" />
<div class="relative min-h-screen w-full overflow-hidden">

    <div class="min-h-screen py-8 sm:py-10 px-4">

        <div class="max-w-6xl mx-auto space-y-8">

            <div class = "bg-white border border-gray-200 rounded-xl shadow-sm p-5 sm:p-6">
                <!-- Header -->
                <div class = "py-2">
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
                        PC Part Picker
                    </h1>
                    <p class="text-gray-500 mt-2">
                        Select compatible components to build your custom PC and see the estimated total price.
                </div>
            </div>
            <div>
                <!-- Summary Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 sm:p-6 flex justify-between items-center">
                    <div>
                        <div class="text-sm text-gray-500">Estimated Total</div>
                        <div class="text-2xl font-semibold text-gray-900">
                            £{{ number_format($this->total, 2) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parts Table -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm divide-y">

                <div class="bg-blue-50 text-blue-800 text-sm px-5 py-3 rounded-t-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Compatibility filter is active. Only compatible parts are shown based on your current selections.
                </div>

                @foreach($categories as $key => $data)
                    <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-gray-50 transition">
                         </div>
                    <!--this area manages listing enach product and selecting it-->
                    @if($activeCategory === $key)
                        <div class="bg-gray-50 border-t border-b border-gray-100 max-h-96 overflow-y-auto">
                            @forelse($availableProducts as $product)
                                <div class="flex items-center p-4 border-b last:border-0 hover:bg-blue-50 transition cursor-pointer"
                                    wire:click="selectPart('{{ $key }}', {{ $product->id }})">

                                    <img src="{{ $product->product_image }}" class="w-16 h-16 object-cover rounded shrink-0 border bg-white">
                                    <div class="ml-4 flex-1 min-w-0">
                                        <div class="text-sm font-bold text-gray-900">{{ $product->product_name }}</div>

                                        <div class="text-xs text-gray-500 mt-1 flex gap-2">
                                            @foreach($product->specs->take(3) as $spec)
                                                <span class="bg-gray-200 px-2 py-0.5 rounded text-gray-700">
                                                    {{ ucfirst(str_replace('_', ' ', $spec->spec_key)) }}: {{ $spec->spec_value }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-gray-900">£{{ number_format($product->product_price, 2) }}</div>
                                        <div class="text-blue-600 text-xs font-bold mt-1">Select part</div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-500 text-sm">
                                    No compatible parts found. Try changing your other selected components.
                                </div>
                            @endforelse
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
</div>
</div>
