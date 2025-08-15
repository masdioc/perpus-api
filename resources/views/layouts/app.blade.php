<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perpustakaan Universitas Siliwangi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <div class="space-x-4">
                @auth
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-red-500 hover:text-red-600 font-medium transition">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-lg border border-blue-500 transition
                 {{ request()->routeIs('home') ? ' bg-blue-600 text-white' : 'text-blue-500 hover:bg-blue-50' }}">
                        Home
                    </a>

                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-lg border border-blue-500 transition
                  {{ request()->routeIs('login') ? ' bg-blue-600 text-white' : 'text-blue-500 hover:bg-blue-50' }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded-lg border border-blue-500 transition
              {{ request()->routeIs('register') ? ' bg-blue-600 text-white' : 'text-blue-500 hover:bg-blue-50' }}">
                        Register
                    </a>
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
