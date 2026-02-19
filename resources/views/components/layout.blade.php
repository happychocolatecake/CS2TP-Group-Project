<body class="bg-gray-100">
    <nav class="sticky top-0 z-50 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-3">
            <div class="flex justify-between items-center">

                {{-- Logo & Nav Links --}}
                <div class="flex items-center space-x-8">
                    <a href="/" class="flex-shrink-0">
                        <img src="{{ asset('images/logo-removebg-preview.png') }}" alt="Happy Hardware" class="h-16 w-auto drop-shadow-lg">
                    </a>

                    <div class="hidden md:flex items-center bg-white/5 rounded-full px-2 py-1 space-x-1">
                        <a href="/store" class="rounded-full px-5 py-2 text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">Store</a>
                        <a href="/build-guide" class="rounded-full px-5 py-2 text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">Build Guide</a>
                        <a href="/about" class="rounded-full px-5 py-2 text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">About</a>
                        <a href="/contact" class="rounded-full px-5 py-2 text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">Contact</a>
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center space-x-4">

                    @guest
                        <a href="/login" class="rounded-full px-6 py-2 text-sm font-semibold bg-white text-gray-900 hover:bg-purple-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-lg">Sign In</a>
                        <a href="/register" class="rounded-full px-5 py-2 text-sm font-medium border border-white/20 text-gray-300 hover:bg-white/10 hover:text-white hover:border-white/40 transition-all duration-300">Register</a>
                    @endguest

                    @auth
                        <span class="text-sm font-medium text-gray-300">Welcome, {{ auth()->user()->first_name ?? 'User' }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full px-5 py-2 text-sm font-medium border border-red-500/30 text-red-300 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300">
                                Sign Out
                            </button>
                        </form>
                    @endauth

                    <div class="flex items-center space-x-2 ml-2 pl-4 border-l border-white/10">
                        <a href="/profile" class="rounded-full p-2 hover:bg-white/10 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 hover:text-white transition-colors duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>

                        <a href="/basket" class="rounded-full p-2 hover:bg-white/10 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 hover:text-white transition-colors duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}
</body>
