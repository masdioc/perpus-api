@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-10 px-4">

        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-20"></div>

            {{-- Foto Profil --}}
            <div class="relative flex flex-col items-center -mt-16 px-6">
                <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                    alt="Profile Photo" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">

                {{-- Nama & Email --}}
                <h2 class="mt-4 text-2xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                <p class="text-gray-500">{{ auth()->user()->email }}</p>
            </div>

            {{-- Informasi Detail --}}
            <div class="px-6 py-6 space-y-4">
                <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Nama Lengkap</span>
                        <span class="text-gray-800">{{ auth()->user()->name }}</span>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Email</span>
                        <span class="text-gray-800">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>

            {{-- Tombol Edit --}}
            <div class="px-20 pb-20">
                <a href="#"
                    class="w-full block text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md font-medium">
                    ✏ Edit Profile
                </a>
            </div>
        </div>

    </div>
@endsection
