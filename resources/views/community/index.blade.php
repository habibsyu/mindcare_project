@extends('layouts.app')

@section('title', '- Komunitas')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Komunitas MindCare
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Bergabunglah dengan komunitas support group untuk saling berbagi dan mendukung dalam perjalanan kesehatan mental
            </p>
        </div>

        <!-- Community Guidelines -->
        <div class="mb-12 rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-2xl font-bold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                <i class="fas fa-heart text-red-500 mr-3"></i>
                Pedoman Komunitas
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-green-600">
                        <i class="fas fa-check-circle mr-2"></i>
                        Yang Dianjurkan
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li class="flex items-start">
                            <i class="fas fa-plus text-green-500 mr-2 mt-1 text-sm"></i>
                            Berbagi pengalaman dan dukungan positif
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-plus text-green-500 mr-2 mt-1 text-sm"></i>
                            Menghormati privasi dan kerahasiaan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-plus text-green-500 mr-2 mt-1 text-sm"></i>
                            Menggunakan bahasa yang sopan dan mendukung
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-plus text-green-500 mr-2 mt-1 text-sm"></i>
                            Memberikan sumber informasi yang valid
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-red-600">
                        <i class="fas fa-times-circle mr-2"></i>
                        Yang Tidak Diperbolehkan
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li class="flex items-start">
                            <i class="fas fa-minus text-red-500 mr-2 mt-1 text-sm"></i>
                            Memberikan diagnosis atau saran medis
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-minus text-red-500 mr-2 mt-1 text-sm"></i>
                            Spam, promosi, atau konten tidak relevan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-minus text-red-500 mr-2 mt-1 text-sm"></i>
                            Bullying, harassment, atau diskriminasi
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-minus text-red-500 mr-2 mt-1 text-sm"></i>
                            Membagikan informasi pribadi orang lain
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Discord Communities -->
        @if(count($discordLinks) > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-8 text-center transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                <i class="fab fa-discord text-indigo-600 mr-3"></i>
                Komunitas Discord
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($discordLinks as $link)
                <div class="rounded-2xl p-6 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                     :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                            <i class="fab fa-discord text-2xl text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold transition-colors duration-300"
                                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                {{ $link->name }}
                            </h3>
                            @if($link->member_count)
                            <p class="text-sm transition-colors duration-300"
                               :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ number_format($link->member_count) }} members
                            </p>
                            @endif
                        </div>
                    </div>
                    
                    <p class="text-sm mb-6 transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        {{ $link->description }}
                    </p>
                    
                    <a href="{{ route('community.redirect', $link) }}" 
                       target="_blank"
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors duration-200">
                        <i class="fab fa-discord mr-2"></i>
                        Bergabung di Discord
                        <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Telegram Communities -->
        @if(count($telegramLinks) > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-8 text-center transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                <i class="fab fa-telegram text-blue-600 mr-3"></i>
                Komunitas Telegram
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($telegramLinks as $link)
                <div class="rounded-2xl p-6 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                     :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                            <i class="fab fa-telegram text-2xl text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold transition-colors duration-300"
                                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                {{ $link->name }}
                            </h3>
                            @if($link->member_count)
                            <p class="text-sm transition-colors duration-300"
                               :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ number_format($link->member_count) }} members
                            </p>
                            @endif
                        </div>
                    </div>
                    
                    <p class="text-sm mb-6 transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        {{ $link->description }}
                    </p>
                    
                    <a href="{{ route('community.redirect', $link) }}" 
                       target="_blank"
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                        <i class="fab fa-telegram mr-2"></i>
                        Bergabung di Telegram
                        <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Support Information -->
        <div class="rounded-2xl p-8 text-center transition-colors duration-300"
             :class="{ 'bg-gradient-to-r from-blue-50 to-indigo-50': !darkMode, 'bg-gradient-to-r from-blue-900/20 to-indigo-900/20': darkMode }">
            <h2 class="text-2xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Butuh Bantuan Segera?
            </h2>
            <p class="text-lg mb-6 transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Jika Anda mengalami krisis atau membutuhkan bantuan profesional segera
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('counseling.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-comments mr-2"></i>
                    Chat Konseling
                </a>
                
                <a href="tel:119" 
                   class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors duration-200">
                    <i class="fas fa-phone mr-2"></i>
                    Hotline 119
                </a>
            </div>
        </div>
    </div>
</div>
@endsection