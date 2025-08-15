@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Buat Akun</h2>
            <p class="text-center text-gray-500 mb-8 text-sm">Daftarkan akun Anda untuk mulai menggunakan layanan</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Nama</label>
                    <input type="text" name="name"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-green-400 transition"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Email</label>
                    <input type="email" name="email"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-green-400 transition"
                        required>
                </div>

                <!-- Password -->
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Password</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-green-400 transition"
                        required>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-green-400 transition"
                        required>
                </div>

                <!-- Tombol -->
                <button type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition transform hover:scale-[1.02]">
                    Register
                </button>
            </form>

            <p class="text-center text-gray-500 mt-6 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-500 hover:underline font-medium">Login di sini</a>
            </p>
        </div>
    </div>
@endsection
