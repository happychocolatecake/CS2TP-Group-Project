<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>

    <script>
        (function () {
            try {
                var storedTheme = localStorage.getItem('theme');
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                var useDark = storedTheme ? storedTheme === 'dark' : prefersDark;
                if (useDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (error) {
                // Fallback to system preference if localStorage is blocked.
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                }
            }
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
    @include('partials.theme-overrides')
    @livewireStyles
    <link rel="icon" href="{{ asset('mouse.jpeg') }}">
</head>
<body class="bg-gray-100 text-gray-900 transition-colors duration-300 dark:bg-slate-900 dark:text-gray-100">

    <main>
        {{ $slot }}
    </main>



    @livewireScripts
    <livewire:chatbot />
    <script>
        window.toggleTheme = function () {
            var root = document.documentElement;
            var willBeDark = !root.classList.contains('dark');
            root.classList.toggle('dark', willBeDark);
            localStorage.setItem('theme', willBeDark ? 'dark' : 'light');
        };
    </script>
</body>
</html>
