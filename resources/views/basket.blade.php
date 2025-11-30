<x-header></x-header>

<x-layout>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <nav class="w-full bg-white shadow-sm p-4 mb-8 text-center text-gray-400 border-b border-gray-200">
        [Navigation Bar Placeholder]
    </nav>

    <main class="flex-grow container mx-auto px-4 max-w-4xl">
        
        <h1 class="text-3xl font-bold text-[#333] mb-8 text-center">
            My shopping basket
        </h1>

        <div class="bg-white rounded-[10px] shadow-md p-[60px] mb-6 flex flex-col md:flex-row items-center gap-4 md:gap-8">
            
            <div class="flex-1 font-bold text-[#333] text-lg text-center md:text-left">
                Products in your basket
            </div>

            <div class="flex items-center gap-4">
                <div class="font-bold text-[#333]">
                    Select Quantity:
                </div>
                
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1 text-base border border-gray-300 rounded bg-[#f9f9f9] hover:bg-gray-200 cursor-pointer transition-colors leading-none">
                        -
                    </button>
                    
                    <span class="min-w-[24px] text-center font-bold text-[#333]">
                        1
                    </span>
                    
                    <button class="px-3 py-1 text-base border border-gray-300 rounded bg-[#f9f9f9] hover:bg-gray-200 cursor-pointer transition-colors leading-none">
                        +
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 mb-10 px-4">
            <div class="flex items-center">
                <input type="checkbox" id="gift" class="w-4 h-4 mr-3 cursor-pointer accent-gray-700">
                <label for="gift" class="text-gray-800 cursor-pointer select-none">
                    Buying as a Gift?
                </label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="subscribe" class="w-4 h-4 mr-3 cursor-pointer accent-gray-700">
                <label for="subscribe" class="text-gray-800 cursor-pointer select-none">
                    Stay updated with our offers! Subscribe to our newsletter?
                </label>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-6 px-2 mb-12">
            <a href="/checkout" class="flex-1 text-center bg-[#374151] text-white text-[15px] p-5 rounded-[10px] shadow-md hover:bg-gray-500 transition-colors duration-200 no-underline font-sans">
                Go to checkout
            </a>
            
            <a href="/" class="flex-1 text-center bg-white text-[#222] text-[15px] p-5 rounded-[10px] shadow-sm hover:bg-gray-300 transition-colors duration-200 no-underline font-sans border border-transparent">
                Back to store
            </a>
        </div>

    </main>

</x-layout>

<x-footer></x-footer>