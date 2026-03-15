<nav class="sticky top-0 z-50 bg-white text-gray-900 shadow-lg transition-colors duration-300 dark:bg-gradient-to-r dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 dark:text-white">
        <div class="max-w-7xl mx-auto px-6 py-3">
            <div class="flex justify-between items-center">

                {{-- Logo & Nav Links --}}
                <div class="flex items-center space-x-8">
                    <a href="/" class="shrink-0">
                        <img id="main-logo" src="{{ asset('images/logo-removebg-preview.png') }}" alt="Happy Hardware" class="h-16 w-auto drop-shadow-lg" >
                    </a>

                    <div id="main-nav-links" class="relative hidden md:flex items-center rounded-full bg-gray-100 px-2 py-1 space-x-1 dark:bg-white/5">
                        <span id="main-nav-active-pill" class="pointer-events-none absolute inset-y-1 left-0 rounded-full bg-gray-200 transition-all duration-300 ease-out dark:bg-white/10"></span>
                        <a href="/" data-nav-link data-active="{{ request()->is('home') ? 'true' : 'false' }}" class="relative z-10 rounded-full px-5 py-2 text-sm font-medium transition-colors duration-200 {{ request()->is('home') ? 'text-gray-900 dark:text-white' : 'text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white' }}">Home</a>
                        <a href="/store" data-nav-link data-active="{{ request()->is('store*') ? 'true' : 'false' }}" class="relative z-10 rounded-full px-5 py-2 text-sm font-medium transition-colors duration-200 {{ request()->is('store*') ? 'text-gray-900 dark:text-white' : 'text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white' }}">Store</a>
                        <a href="/build-guide" data-nav-link data-active="{{ request()->is('build-guide*') ? 'true' : 'false' }}" class="relative z-10 rounded-full px-5 py-2 text-sm font-medium transition-colors duration-200 {{ request()->is('build-guide*') ? 'text-gray-900 dark:text-white' : 'text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white' }}">Build Guide</a>
                        <a href="{{ route('part-picker') }}" data-nav-link data-active="{{ request()->is('part-picker*') ? 'true' : 'false' }}" class="relative z-10 rounded-full px-5 py-2 text-sm font-medium transition-colors duration-200 {{ request()->is('part-picker*') ? 'text-gray-900 dark:text-white' : 'text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white' }}">Part Picker</a>
                        <a href="/about" data-nav-link data-active="{{ request()->is('about*') ? 'true' : 'false' }}" class="relative z-10 rounded-full px-5 py-2 text-sm font-medium transition-colors duration-200 {{ request()->is('about*') ? 'text-gray-900 dark:text-white' : 'text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white' }}">About</a>
                        <a href="/contact" data-nav-link data-active="{{ request()->is('contact*') ? 'true' : 'false' }}" class="relative z-10 rounded-full px-5 py-2 text-sm font-medium transition-colors duration-200 {{ request()->is('contact*') ? 'text-gray-900 dark:text-white' : 'text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white' }}">Contact</a>
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center space-x-4">
                    <button type="button" onclick="window.toggleTheme && window.toggleTheme()" class="rounded-full border border-gray-300 px-4 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-100 transition-all duration-200 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-white/10">
                        <span class="dark:hidden">Dark</span>
                        <span class="hidden dark:inline">Light</span>
                    </button>

                    @guest
                        <a href="/login" class="rounded-full px-6 py-2 text-sm font-semibold bg-gray-900 text-white hover:bg-purple-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-lg dark:bg-white dark:text-gray-900">Sign In</a>
                        <a href="/register" class="rounded-full px-5 py-2 text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-all duration-300 dark:border-white/20 dark:text-gray-300 dark:hover:bg-white/10 dark:hover:text-white dark:hover:border-white/40">Register</a>
                    @endguest

                    @auth
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Welcome, {{ auth()->user()->first_name ?? 'User' }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full px-5 py-2 text-sm font-medium border border-red-400/40 text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 dark:border-red-500/30 dark:text-red-300">
                                Sign Out
                            </button>
                        </form>
                    @endauth

                    <div class="ml-2 flex items-center space-x-2 border-l border-gray-300 pl-4 dark:border-white/10">
                        <a href="/profile" class="rounded-full p-2 hover:bg-gray-100 transition-all duration-200 dark:hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-600 hover:text-gray-900 transition-colors duration-200 dark:text-gray-400 dark:hover:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>

                        <a href="/basket" class="rounded-full p-2 hover:bg-gray-100 transition-all duration-200 dark:hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-600 hover:text-gray-900 transition-colors duration-200 dark:text-gray-400 dark:hover:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>

{{ $slot }}

<script>
    (function () {
        // Ensure theme is initialized on pages that don't render x-header.
        var root = document.documentElement;
        if (!root.classList.contains('dark') && !root.classList.contains('light-theme-initialized')) {
            try {
                var storedTheme = localStorage.getItem('theme');
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                var useDark = storedTheme ? storedTheme === 'dark' : prefersDark;
                root.classList.toggle('dark', useDark);
            } catch (error) {
                root.classList.toggle('dark', window.matchMedia('(prefers-color-scheme: dark)').matches);
            }
            root.classList.add('light-theme-initialized');
        }
        //initialises the correct logo based on the current view mode toggled (light/dark)
        var useDark = root.classList.contains('dark');
        var logo = document.getElementById('main-logo');
        if (logo) {
            logo.src = useDark ? "{{ asset('images/logo-removebg-preview.png') }}" : "{{ asset('images/lightmodelogo.png') }}";
        }

        if (typeof window.toggleTheme !== 'function') {
            window.toggleTheme = function () {
                var willBeDark = !root.classList.contains('dark');
                root.classList.toggle('dark', willBeDark);

                try {
                    localStorage.setItem('theme', willBeDark ? 'dark' : 'light');

                } catch (error) {
                    // Ignore storage errors.
                }
            };
        }

        var navContainer = document.getElementById('main-nav-links');
        var indicator = document.getElementById('main-nav-active-pill');
        if (navContainer && indicator) {
            var navLinks = navContainer.querySelectorAll('[data-nav-link]');

            var moveIndicator = function (targetLink) {
                if (!targetLink) return;
                indicator.style.width = targetLink.offsetWidth + 'px';
                indicator.style.transform = 'translateX(' + targetLink.offsetLeft + 'px)';
            };

            var activeLink = navContainer.querySelector('[data-active="true"]') || navLinks[0];
            requestAnimationFrame(function () {
                moveIndicator(activeLink);
            });

            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    moveIndicator(link);
                });
            });

            window.addEventListener('resize', function () {
                var currentActive = navContainer.querySelector('[data-active="true"]') || activeLink;
                moveIndicator(currentActive);
            });
        }
        //looks out for any mode changes seperately from the isToggle function to change the logo specifically
        var observer = new MutationObserver(function(modeChanges) {
            modeChanges.forEach(function(modeChange) {
                if (modeChange.attributeName === "class") {
                    var isDark = document.documentElement.classList.contains('dark');
                    var logo = document.getElementById('main-logo');
                    if (logo) {
                        logo.src = isDark ? "{{ asset('images/logo-removebg-preview.png') }}"  : "{{ asset('images/lightmodelogo.png') }}";
                    }
                }
            });
        });

        observer.observe(document.documentElement, { attributes: true });
    })();


</script>
