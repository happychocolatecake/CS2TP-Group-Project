<x-header></x-header>
<x-layout>
    <div>
        <x-video-background lightOpacity="opacity-10" darkOpacity="opacity-40" />

    <body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="min-h-screen py-12">

        <main class="relative max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-white">
                <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                    <div class="text-center">

                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('mouse.jpeg') }}" alt="Happy Hardware" class="h-20 w-auto rounded-md">
                        </div>

                        <div>
                            <h1 class="text-4xl font-extrabold text-center mb-10 sm:text-5xl text-gray-900 uppercase tracking-widest">
                                FAQ PAGE
                            </h1>

                            <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                                <strong> Here to answer your questions about Happy Hardware!!! </strong>
                            </p>
                        </div>

                        <br>

                        <div>
                            <div class="bg-gray-800 p-8 space-y-6 border-[2vw] shadow-xl rounded-lg">
                                <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                                        <span>Can I Purchase Hardware For My PC??</span>
                                        <span class="text-2xl font-light" x-text="open ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="open" x-collapse class="p-5 border-t border-gray-200 text-gray-600 bg-gray-50">
                                        Yes! Happy Hardware offers price for hardware you cannot get anywhere else...
                                    </div>
                                </div>

                                <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                                        <span>How Do I Construct My PC??</span>
                                        <span class="text-2xl font-light" x-text="open ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="open" x-collapse class="p-5 border-t border-gray-200 text-gray-600 bg-gray-50">
                                        With our friendly
                                        <a href="/build-guide" class="text-happy-green underline hover:text-green-700 transition"> build guide</a>
                                        , you can construct your PC stress free!!
                                    </div>
                                </div>

                                <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                                        <span>What Is The Meaning of Life??</span>
                                        <span class="text-2xl font-light" x-text="open ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="open" x-collapse class="p-5 border-t border-gray-200 text-gray-600 bg-gray-50">
                                        Happy Hardware!!
                                    </div>
                                </div>

                                <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                                        <span>How Can I Check What Have I Ordered??</span>
                                        <span class="text-2xl font-light" x-text="open ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="open" x-collapse class="p-5 border-t border-gray-200 text-gray-600 bg-gray-50">
                                        You can check you order in the built in order history tab, in the profile page.
                                    </div>
                                </div>

                                <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                    <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                                        <span>How Can I Contact You Concerning Something??</span>
                                        <span class="text-2xl font-light" x-text="open ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="open" x-collapse class="p-5 border-t border-gray-200 text-gray-600 bg-gray-50">
                                        You can get in touch with us, through the dedicated
                                        <a href="/contact" class="text-happy-green underline hover:text-green-700 transition"> contact page.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    </body>
    </div>
</x-layout>
<x-footer></x-footer>
