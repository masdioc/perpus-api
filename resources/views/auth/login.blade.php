@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-[80vh] bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">

            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Selamat Datang</h2>
                <p class="text-gray-500 text-sm mt-1">Silakan masuk untuk melanjutkan</p>
            </div>

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email"
                        class="w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg shadow-sm p-3"
                        placeholder="contoh@email.com" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg shadow-sm p-3"
                        placeholder="••••••••" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
@endsection
