@extends('layouts.app')

@section('title', '- Register')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full"
                 :class="{ 'bg-blue-100': !darkMode, 'bg-blue-900': darkMode }">
                <i class="fas fa-brain text-2xl text-blue-600"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Daftar akun baru
            </h2>
            <p class="mt-2 text-center text-sm transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                Atau
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    masuk ke akun yang sudah ada
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium transition-colors duration-300"
                           :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                        Nama Lengkap
                    </label>
                    <input id="name" name="name" type="text" autocomplete="name" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-300"
                           :class="{ 'border-gray-300 text-gray-900 bg-white': !darkMode, 'border-gray-600 text-white bg-gray-700': darkMode }"
                           placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium transition-colors duration-300"
                           :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                        Email
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-300"
                           :class="{ 'border-gray-300 text-gray-900 bg-white': !darkMode, 'border-gray-600 text-white bg-gray-700': darkMode }"
                           placeholder="Masukkan alamat email" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium transition-colors duration-300"
                           :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                        Password
                    </label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-300"
                           :class="{ 'border-gray-300 text-gray-900 bg-white': !darkMode, 'border-gray-600 text-white bg-gray-700': darkMode }"
                           placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium transition-colors duration-300"
                           :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                        Konfirmasi Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-300"
                           :class="{ 'border-gray-300 text-gray-900 bg-white': !darkMode, 'border-gray-600 text-white bg-gray-700': darkMode }"
                           placeholder="Ulangi password">
                </div>
            </div>

            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="terms" class="ml-2 block text-sm transition-colors duration-300"
                       :class="{ 'text-gray-900': !darkMode, 'text-gray-300': darkMode }">
                    Saya setuju dengan 
                    <a href="{{ route('terms') }}" class="text-blue-600 hover:text-blue-500">Syarat & Ketentuan</a>
                    dan 
                    <a href="{{ route('privacy') }}" class="text-blue-600 hover:text-blue-500">Kebijakan Privasi</a>
                </label>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-user-plus text-blue-500 group-hover:text-blue-400"></i>
                    </span>
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection