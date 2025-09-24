@extends('layouts.app')

@section('title', '- Tentang Kami')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Tentang MindCare
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Platform kesehatan mental terpercaya yang menyediakan layanan komprehensif untuk mendukung kesejahteraan mental Anda
            </p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="rounded-2xl p-8 transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-2xl text-blue-600"></i>
                </div>
                <h2 class="text-2xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Misi Kami
                </h2>
                <p class="transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Memberikan akses mudah dan terjangkau terhadap layanan kesehatan mental berkualitas tinggi melalui teknologi digital, 
                    serta menciptakan lingkungan yang mendukung untuk pemulihan dan pertumbuhan personal.
                </p>
            </div>
            
            <div class="rounded-2xl p-8 transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-2xl text-green-600"></i>
                </div>
                <h2 class="text-2xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Visi Kami
                </h2>
                <p class="transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Menjadi platform kesehatan mental terdepan di Indonesia yang membantu jutaan orang mencapai kesejahteraan mental optimal 
                    dan menghilangkan stigma terhadap masalah kesehatan mental.
                </p>
            </div>
        </div>

        <!-- Our Services -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center mb-12 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Layanan Kami
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:scale-105"
                     :class="{ 'bg-white shadow-lg hover:shadow-xl': !darkMode, 'bg-gray-800 shadow-xl hover:shadow-2xl': darkMode }">
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clipboard-check text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Self-Assessment
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Tes psikologi terstandarisasi (PHQ-9, GAD-7, DASS-21) untuk mengetahui kondisi kesehatan mental Anda
                    </p>
                </div>
                
                <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:scale-105"
                     :class="{ 'bg-white shadow-lg hover:shadow-xl': !darkMode, 'bg-gray-800 shadow-xl hover:shadow-2xl': darkMode }">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-open text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Edukasi
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Artikel, video, dan kuis interaktif untuk meningkatkan pemahaman tentang kesehatan mental
                    </p>
                </div>
                
                <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:scale-105"
                     :class="{ 'bg-white shadow-lg hover:shadow-xl': !darkMode, 'bg-gray-800 shadow-xl hover:shadow-2xl': darkMode }">
                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comments text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Konseling Online
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Chat dengan AI counselor 24/7 atau terhubung dengan konselor profesional bersertifikat
                    </p>
                </div>
                
                <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:scale-105"
                     :class="{ 'bg-white shadow-lg hover:shadow-xl': !darkMode, 'bg-gray-800 shadow-xl hover:shadow-2xl': darkMode }">
                    <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Komunitas
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Bergabung dengan support group di Discord dan Telegram untuk saling mendukung
                    </p>
                </div>
                
                <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:scale-105"
                     :class="{ 'bg-white shadow-lg hover:shadow-xl': !darkMode, 'bg-gray-800 shadow-xl hover:shadow-2xl': darkMode }">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-blog text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Blog
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Artikel terbaru dari para ahli tentang tips, strategi, dan insights kesehatan mental
                    </p>
                </div>
                
                <div class="text-center p-6 rounded-2xl transition-all duration-300 hover:scale-105"
                     :class="{ 'bg-white shadow-lg hover:shadow-xl': !darkMode, 'bg-gray-800 shadow-xl hover:shadow-2xl': darkMode }">
                    <div class="w-16 h-16 rounded-full bg-teal-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-2xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Dashboard Personal
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Pantau progress kesehatan mental Anda dengan grafik dan rekomendasi yang dipersonalisasi
                    </p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="rounded-2xl p-8 mb-16 transition-colors duration-300"
             :class="{ 'bg-gradient-to-r from-blue-50 to-indigo-50': !darkMode, 'bg-gradient-to-r from-blue-900/20 to-indigo-900/20': darkMode }">
            <h2 class="text-3xl font-bold text-center mb-12 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Mengapa Memilih MindCare?
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold mb-2 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Aman & Terpercaya
                    </h3>
                    <p class="text-sm transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Data terenkripsi dan privasi terjamin 100%
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold mb-2 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        24/7 Tersedia
                    </h3>
                    <p class="text-sm transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Akses layanan kapan saja, di mana saja
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-purple-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-md text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold mb-2 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Profesional
                    </h3>
                    <p class="text-sm transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Tim konselor bersertifikat dan berpengalaman
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-orange-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-2xl text-white"></i>
                    </div>
                    <h3 class="font-semibold mb-2 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Peduli
                    </h3>
                    <p class="text-sm transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Pendekatan empati dan tanpa judgment
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="text-center rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-2xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Siap Memulai Perjalanan Kesehatan Mental Anda?
            </h2>
            <p class="text-lg mb-8 transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Bergabunglah dengan ribuan orang yang telah mempercayai MindCare untuk mendukung kesehatan mental mereka
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('assessments.index') }}" 
                   class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl">
                    <i class="fas fa-clipboard-check mr-3"></i>
                    Mulai Assessment
                </a>
                
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 border-2"
                   :class="{ 'border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white': !darkMode, 'border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-gray-900': darkMode }">
                    <i class="fas fa-envelope mr-3"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</div>
@endsection