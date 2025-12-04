<x-header></x-header>
<x-layout>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">My Account</h1>
        <p class="text-gray-600 mb-8">Manage your account settings and view your order history.</p>

        @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            
            <aside class="col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <nav class="flex flex-col">
                        
                        
                        <a href="{{ route('profile.index') }}" 
                           class="{{ request()->routeIs('profile.index') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} text-left px-6 py-4 font-medium transition-colors duration-200 focus:outline-none">
                            <i class="fas fa-user-circle mr-2"></i> Profile Information
                        </a>
                        
                        
                        <a href="{{ route('profile.security') }}" 
                           class="{{ request()->routeIs('profile.security') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} text-left px-6 py-4 font-medium transition-colors duration-200 focus:outline-none">
                            <i class="fas fa-lock mr-2"></i> Security (Password)
                        </a>
                        
                        
                        <a href="{{ route('profile.orders') }}" 
                           class="{{ request()->routeIs('profile.orders') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} text-left px-6 py-4 font-medium transition-colors duration-200 focus:outline-none">
                            <i class="fas fa-box-open mr-2"></i> Order History
                        </a>

                    </nav>
                </div>
            </aside>

            
            <main class="col-span-1 md:col-span-3">

                
                @if(request()->routeIs('profile.index'))
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        @include('profile.partials.update-profile')
                    </div>
                @endif

                
                @if(request()->routeIs('profile.security'))
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        @include('profile.partials.update-password')
                    </div>
                @endif

               
                @if(request()->routeIs('profile.orders'))
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        @include('profile.partials.order-history')
                    </div>
                @endif

            </main>
        </div>
    </div>

</body>
</x-layout>
<x-footer></x-footer>