<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perpustakaan Universitas Siliwangi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="flex items-center text-2xl font-bold text-blue-600">
                <img src="{{ asset('public/images/logo-unsil.jpg') }}" alt="Logo" class="h-8 w-auto mr-2">
                Perpustakaan
            </h1>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-red-500 hover:text-red-600 font-medium transition">Logout</button>
                    </form>
                @endauth

                @guest
                    <!-- Dropdown Menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center gap-2">
                            Menu
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg overflow-hidden">
                            <a href="{{ route('home') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 {{ request()->routeIs('home') ? 'bg-blue-100 font-semibold' : '' }}">
                                Home
                            </a>
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 {{ request()->routeIs('login') ? 'bg-blue-100 font-semibold' : '' }}">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 {{ request()->routeIs('register') ? 'bg-blue-100 font-semibold' : '' }}">
                                Register
                            </a>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner py-4 mt-8">
        <div class="container mx-auto text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Perpustakaan Online by Alya & Friend.
        </div>
    </footer>

</body>

</html>
