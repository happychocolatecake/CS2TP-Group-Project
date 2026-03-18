<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('mouse.jpeg') }}">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-gray-800 text-white p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <a href="/" class="flex-shrink-0">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" alt="Happy Hardware" class="h-14 w-auto">
                </a>
                <div class="hidden sm:block border-l border-gray-600 pl-4">
                    <p class="text-sm text-gray-300">Happy Hardware</p>
                    <p class="font-semibold">Admin Portal</p>
                </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('home') }}" class="rounded-md px-3 py-2 text-gray-300 hover:bg-white/5 hover:text-white">Store Home</a>

                @if (auth('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="rounded-md px-3 py-2 text-gray-300 hover:bg-white/5 hover:text-white">Dashboard</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-white hover:bg-red-500">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white border-t border-gray-700 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
            <p class="text-sm text-gray-400">Admin control panel for Happy Hardware.</p>
            <p class="text-sm text-gray-400">&copy; 2026 Group 27</p>
        </div>
    </footer>
</body>
</html>
