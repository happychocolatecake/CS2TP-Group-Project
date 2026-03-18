@if (session('success'))
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
@endif

<div class="relative min-h-screen w-full">

    <x-video-background lightOpacity="opacity-10" darkOpacity="opacity-40" />
<div class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">

    <div class="min-h-screen py-10 px-4">

        <div class="max-w-6xl mx-auto space-y-8">

            <div class = "bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <!-- Header -->
                <div class = "py-2">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        PC Part Picker
                    </h1>
                    <p class="text-gray-500 mt-2">
                        Select compatible components to build your custom PC and see the estimated total price.
                </div>
            </div>
            <div>
                <!-- Summary Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 flex justify-between items-center">
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

                @foreach($categories as $key => $data)
                    <div class="p-5 flex items-center justify-between hover:bg-gray-50 transition">

                        <!-- Left Side -->
                        <div>
                            <div class="font-semibold text-gray-900">
                                {{ $data['label'] }}
                            </div>

                            @if(isset($selected[$key]))
                                <div class="text-sm text-gray-600 mt-1">
                                    {{ $selected[$key]['name'] }}
                                    <span class="ml-2 font-medium text-gray-900">
                                        £{{ number_format($selected[$key]['price'], 2) }}
                                    </span>
                                </div>
                            @else
                                <div class="text-sm text-gray-400 mt-1">
                                    No part selected
                                </div>
                            @endif
                        </div>

                        <!-- Right Side -->
                        <div class="flex gap-3">

                            <button
                                wire:click="selectCategory('{{ $key }}')"
                                class="px-4 py-2 text-sm font-medium rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition"
                            >
                                {{ isset($selected[$key]) ? 'Change' : 'Choose' }}
                            </button>

                            @if(isset($selected[$key]))
                                <button
                                    wire:click="removePart('{{ $key }}')"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100 transition"
                                >
                                    Remove
                                </button>
                            @endif

                        </div>
                    </div>
                    <!--this area manages listing each product and selecting it-->
                    @if($activeCategory === $key)
                        @forelse($availableProducts as $product)
                            <div class="flex items-center p-3 bg-white border rounded-lg shadow-sm hover:border-blue-500 transition cursor-pointer"
                                wire:click="selectPart('{{ $key }}', {{ $product->id }})">

                                <img src="{{ $product->product_image }}" class="w-12 h-12 object-cover rounded">
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-bold">{{ $product->product_name }}</div>
                                    <div class="text-xs text-gray-500">£{{ number_format($product->product_price, 2) }}</div>
                                </div>
                                <div class="text-blue-600 text-xs font-bold">Select</div>
                            </div>
                        @empty
                        @endforelse
                    @endif
                @endforeach

            </div>

        </div>
    </div>
</div>
</div>
