<x-header></x-header>
<x-layout>
    <h1>Hello from the Store Page.</h1>
</x-layout>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
    @foreach(range(1, 16) as $item)
            <x-product-card 
                title="Popular Pre-Built #{{ $item }}" 
                description="High performance gaming rig suitable for 4k gaming." 
                price="$1200"
            />
        @endforeach
</div>
<x-footer></x-footer>