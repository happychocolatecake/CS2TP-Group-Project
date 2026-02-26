<x-header></x-header>
<x-layout>
    <body class="bg-gray-100 min-h-screen flex flex-col">

    <main>
        <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                        FAQ Page
                    </h1>
                    <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                        Here to answer your questions about Happy Hardware!!!.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-start">


            <div class="lg:col-span-9 border-t border-gray-300">
                <div x-data="{ open: false }" class="border-b border-gray-300">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-6 text-left font-bold text-lg uppercase text-gray-900">
                        <span>CAN I BUY HARDWARE??</span>
                        <span x-text="open ? '−' : '+'"></span>
                    </button>
                    <div x-show="open" class="pb-6 text-gray-600">
                        Yes! Happy Hardware offers prices you cannot get anywhere else...
                    </div>
                </div>
            </div>

            <div class="lg:col-span-9 border-t border-gray-300">
                <div x-data="{ open: false }" class="border-b border-gray-300">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-6 text-left font-bold text-lg uppercase text-gray-900">
                        <span>HOW DO I MAKE MY PC??</span>
                        <span x-text="open ? '−' : '+'"></span>
                    </button>
                    <div x-show="open" class="pb-6 text-gray-600">
                        With our friendly
                        <a href="/build-guide" class="text-happy-green underline hover:text-green-700 transition">
                        build guide </a>, you can construct your PC stress free
                    </div>
                </div>
            </div>

            <div class="lg:col-span-9 border-t border-gray-300">
                <div x-data="{ open: false }" class="border-b border-gray-300">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-6 text-left font-bold text-lg uppercase text-gray-900">
                        <span>WHAT'S THE MEANING OF LIFE??</span>
                        <span x-text="open ? '−' : '+'"></span>
                    </button>
                    <div x-show="open" class="pb-6 text-gray-600">
                        Computers
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


    </main>

</x-layout>
<x-footer></x-footer>
