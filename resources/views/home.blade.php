@extends('layouts.app')

@section('title', '- Platform Kesehatan Mental Terpercaya')
@section('description', 'MindCare menyediakan self-assessment PHQ-9, GAD-7, DASS-21, edukasi kesehatan mental, konseling online, dan komunitas support.')

@section('content')
<div class="transition-colors duration-300" 
     :class="{ 'bg-gradient-to-br from-blue-50 via-white to-indigo-50': !darkMode, 'bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800': darkMode }">

    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Jaga <span class="text-blue-600">Kesehatan Mental</span> Anda
                    </h1>
                    <p class="text-xl mb-8 leading-relaxed transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Platform terpercaya untuk self-assessment, edukasi, dan konseling kesehatan mental. 
                        Mulai perjalanan menuju kesejahteraan mental yang lebih baik.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('assessments.index') }}" 
                           class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl">
                            <i class="fas fa-clipboard-check mr-3"></i>
                            Mulai Tes Sekarang
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-400 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        
                        <a href="{{ route('content.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 border-2 hover:scale-105"
                           :class="{ 'border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white': !darkMode, 'border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-gray-900': darkMode }">
                            <i class="fas fa-book-open mr-3"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['total_assessments']) }}+</div>
                            <div class="text-sm transition-colors duration-300" 
                                 :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                Assessment Selesai
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ number_format($stats['total_articles']) }}+</div>
                            <div class="text-sm transition-colors duration-300" 
                                 :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                Artikel Edukasi
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ number_format($stats['total_videos']) }}+</div>
                            <div class="text-sm transition-colors duration-300" 
                                 :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                Video Edukasi
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-orange-600">{{ number_format($stats['total_blogs']) }}+</div>
                            <div class="text-sm transition-colors duration-300" 
                                 :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                Blog Posts
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Illustration -->
                <div class="flex justify-center lg:justify-end">
                    <div class="relative">
                        <!-- Main illustration container -->
                        <div class="w-96 h-96 rounded-full transition-colors duration-300"
                             :class="{ 'bg-gradient-to-br from-blue-100 to-indigo-200': !darkMode, 'bg-gradient-to-br from-blue-900/30 to-indigo-900/30': darkMode }">
                            
                            <!-- Floating icons -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-6xl text-blue-500 animate-pulse">
                                    <i class="fas fa-brain"></i>
                                </div>
                            </div>
                            
                            <!-- Orbiting elements -->
                            <div class="absolute top-8 left-8 w-16 h-16 rounded-full bg-green-500 flex items-center justify-center text-white text-xl animate-bounce">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="absolute top-8 right-8 w-16 h-16 rounded-full bg-purple-500 flex items-center justify-center text-white text-xl animate-bounce" style="animation-delay: 0.5s;">
                                <i class="fas fa-smile"></i>
                            </div>
                            <div class="absolute bottom-8 left-8 w-16 h-16 rounded-full bg-orange-500 flex items-center justify-center text-white text-xl animate-bounce" style="animation-delay: 1s;">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="absolute bottom-8 right-8 w-16 h-16 rounded-full bg-pink-500 flex items-center justify-center text-white text-xl animate-bounce" style="animation-delay: 1.5s;">
                                <i class="fas fa-sun"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background decorations -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full opacity-10 transition-colors duration-300"
                 :class="{ 'bg-blue-300': !darkMode, 'bg-blue-600': darkMode }" 
                 style="animation: float 6s ease-in-out infinite;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full opacity-10 transition-colors duration-300"
                 :class="{ 'bg-purple-300': !darkMode, 'bg-purple-600': darkMode }" 
                 style="animation: float 6s ease-in-out infinite reverse;"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 transition-colors duration-300"
             :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Fitur Lengkap untuk Kesehatan Mental Anda
                </h2>
                <p class="text-xl transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Temukan berbagai alat dan sumber daya untuk mendukung perjalanan kesehatan mental Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Self-Assessment -->
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:scale-105 cursor-pointer"
                     :class="{ 'bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-xl': !darkMode, 'bg-gradient-to-br from-blue-900/20 to-blue-800/20 hover:shadow-2xl': darkMode }"
                     onclick="window.location.href='{{ route('assessments.index') }}'">
                    <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center mb-6 group-hover:animate-pulse">
                        <i class="fas fa-clipboard-check text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Self-Assessment
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Tes PHQ-9, GAD-7, dan DASS-21 untuk mengetahui kondisi kesehatan mental Anda dengan akurat dan terstandar.
                    </p>
                    <div class="mt-4 flex items-center text-blue-500 group-hover:text-blue-600">
                        <span class="text-sm font-medium">Mulai Tes</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </div>
                </div>

                <!-- Education -->
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:scale-105 cursor-pointer"
                     :class="{ 'bg-gradient-to-br from-green-50 to-green-100 hover:shadow-xl': !darkMode, 'bg-gradient-to-br from-green-900/20 to-green-800/20 hover:shadow-2xl': darkMode }"
                     onclick="window.location.href='{{ route('content.index') }}'">
                    <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mb-6 group-hover:animate-pulse">
                        <i class="fas fa-book-open text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Edukasi
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Artikel, video, dan kuis interaktif untuk meningkatkan pemahaman tentang kesehatan mental dan teknik coping.
                    </p>
                    <div class="mt-4 flex items-center text-green-500 group-hover:text-green-600">
                        <span class="text-sm font-medium">Jelajahi Konten</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </div>
                </div>

                <!-- Blog -->
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:scale-105 cursor-pointer"
                     :class="{ 'bg-gradient-to-br from-purple-50 to-purple-100 hover:shadow-xl': !darkMode, 'bg-gradient-to-br from-purple-900/20 to-purple-800/20 hover:shadow-2xl': darkMode }"
                     onclick="window.location.href='{{ route('blog.index') }}'">
                    <div class="w-16 h-16 rounded-full bg-purple-500 flex items-center justify-center mb-6 group-hover:animate-pulse">
                        <i class="fas fa-blog text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Blog
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Artikel SEO-friendly dengan tips praktis, pengalaman nyata, dan insights terbaru seputar kesehatan mental.
                    </p>
                    <div class="mt-4 flex items-center text-purple-500 group-hover:text-purple-600">
                        <span class="text-sm font-medium">Baca Blog</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </div>
                </div>

                <!-- Community -->
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:scale-105 cursor-pointer"
                     :class="{ 'bg-gradient-to-br from-orange-50 to-orange-100 hover:shadow-xl': !darkMode, 'bg-gradient-to-br from-orange-900/20 to-orange-800/20 hover:shadow-2xl': darkMode }"
                     onclick="window.location.href='{{ route('community.index') }}'">
                    <div class="w-16 h-16 rounded-full bg-orange-500 flex items-center justify-center mb-6 group-hover:animate-pulse">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Komunitas
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Bergabung dengan support group di Discord dan Telegram untuk saling mendukung dalam perjalanan recovery.
                    </p>
                    <div class="mt-4 flex items-center text-orange-500 group-hover:text-orange-600">
                        <span class="text-sm font-medium">Join Komunitas</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </div>
                </div>

                <!-- Counseling -->
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:scale-105 cursor-pointer"
                     :class="{ 'bg-gradient-to-br from-pink-50 to-pink-100 hover:shadow-xl': !darkMode, 'bg-gradient-to-br from-pink-900/20 to-pink-800/20 hover:shadow-2xl': darkMode }"
                     onclick="window.location.href='{{ route('counseling.index') }}'">
                    <div class="w-16 h-16 rounded-full bg-pink-500 flex items-center justify-center mb-6 group-hover:animate-pulse">
                        <i class="fas fa-comments text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Konseling Online
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Chat dengan AI counselor 24/7 atau terhubung dengan konselor profesional untuk dukungan yang lebih personal.
                    </p>
                    <div class="mt-4 flex items-center text-pink-500 group-hover:text-pink-600">
                        <span class="text-sm font-medium">Mulai Konseling</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </div>
                </div>

                <!-- Dashboard -->
                @auth
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:scale-105 cursor-pointer"
                     :class="{ 'bg-gradient-to-br from-teal-50 to-teal-100 hover:shadow-xl': !darkMode, 'bg-gradient-to-br from-teal-900/20 to-teal-800/20 hover:shadow-2xl': darkMode }"
                     onclick="window.location.href='{{ route('assessments.dashboard') }}'">
                    <div class="w-16 h-16 rounded-full bg-teal-500 flex items-center justify-center mb-6 group-hover:animate-pulse">
                        <i class="fas fa-chart-line text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Dashboard Personal
                    </h3>
                    <p class="transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Pantau progress kesehatan mental Anda dengan grafik dan rekomendasi konten yang dipersonalisasi.
                    </p>
                    <div class="mt-4 flex items-center text-teal-500 group-hover:text-teal-600">
                        <span class="text-sm font-medium">Lihat Dashboard</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </section>

    @if(count($featured_content) > 0)
    <!-- Featured Content -->
    <section class="py-20 transition-colors duration-300"
             :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Konten Pilihan
                </h2>
                <p class="text-xl transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Belajar dari konten edukasi terbaik kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featured_content as $content)
                <article class="group rounded-2xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-xl"
                         :class="{ 'bg-white shadow-md': !darkMode, 'bg-gray-800 shadow-lg': darkMode }">
                    <div class="relative h-48 overflow-hidden">
                        @if($content->type === 'video' && $content->youtube_thumbnail)
                            <img src="{{ $content->youtube_thumbnail }}" 
                                 alt="{{ $content->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                                <div class="w-16 h-16 rounded-full bg-red-500 flex items-center justify-center">
                                    <i class="fas fa-play text-white text-xl"></i>
                                </div>
                            </div>
                        @elseif($content->thumbnail)
                            <img src="{{ $content->thumbnail }}" 
                                 alt="{{ $content->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full transition-colors duration-300 flex items-center justify-center"
                                 :class="{ 'bg-gradient-to-br from-blue-100 to-blue-200': !darkMode, 'bg-gradient-to-br from-blue-900 to-blue-800': darkMode }">
                                <i class="fas fa-{{ $content->type === 'article' ? 'newspaper' : ($content->type === 'video' ? 'play' : 'question-circle') }} text-4xl text-blue-500"></i>
                            </div>
                        @endif
                        
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $content->type === 'article' ? 'bg-green-100 text-green-800' : ($content->type === 'video' ? 'bg-red-100 text-red-800' : 'bg-purple-100 text-purple-800') }}">
                                {{ ucfirst($content->type) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-2 line-clamp-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            {{ $content->title }}
                        </h3>
                        
                        @if($content->excerpt)
                        <p class="text-sm mb-4 line-clamp-3 transition-colors duration-300"
                           :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            {{ $content->excerpt }}
                        </p>
                        @endif

                        <div class="flex items-center justify-between text-xs transition-colors duration-300"
                             :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                            <span>
                                <i class="fas fa-eye mr-1"></i>
                                {{ number_format($content->views) }} views
                            </span>
                            @if($content->reading_time)
                            <span>
                                <i class="fas fa-clock mr-1"></i>
                                {{ $content->reading_time }} min
                            </span>
                            @endif
                        </div>

                        <a href="{{ route('content.show', $content) }}" 
                           class="mt-4 inline-flex items-center text-blue-500 hover:text-blue-600 font-medium transition-colors duration-200">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('content.index') }}" 
                   class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105"
                   :class="{ 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl': !darkMode, 'bg-blue-500 text-white hover:bg-blue-600 shadow-lg hover:shadow-xl': darkMode }">
                    Lihat Semua Konten
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    @if(count($latest_blogs) > 0)
    <!-- Latest Blogs -->
    <section class="py-20 transition-colors duration-300"
             :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Blog Terbaru
                </h2>
                <p class="text-xl transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Baca artikel terbaru dari tim MindCare
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latest_blogs as $blog)
                <article class="group rounded-2xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-xl"
                         :class="{ 'bg-white shadow-md': !darkMode, 'bg-gray-800 shadow-lg': darkMode }">
                    @if($blog->featured_image)
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $blog->featured_image }}" 
                             alt="{{ $blog->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $blog->category }}
                            </span>
                            <span class="text-xs transition-colors duration-300"
                                  :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ $blog->published_at->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold mb-3 line-clamp-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            {{ $blog->title }}
                        </h3>
                        
                        <p class="text-sm mb-4 line-clamp-3 transition-colors duration-300"
                           :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            {{ $blog->excerpt }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-xs transition-colors duration-300"
                                 :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                <span class="mr-4">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ number_format($blog->views) }}
                                </span>
                                <span>
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $blog->reading_time }} min
                                </span>
                            </div>

                            <a href="{{ route('blog.show', $blog) }}" 
                               class="inline-flex items-center text-blue-500 hover:text-blue-600 font-medium transition-colors duration-200">
                                Baca
                                <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('blog.index') }}" 
                   class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105"
                   :class="{ 'bg-purple-600 text-white hover:bg-purple-700 shadow-lg hover:shadow-xl': !darkMode, 'bg-purple-500 text-white hover:bg-purple-600 shadow-lg hover:shadow-xl': darkMode }">
                    Lihat Semua Blog
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 transition-colors duration-300"
             :class="{ 'bg-gradient-to-r from-blue-600 to-purple-600': !darkMode, 'bg-gradient-to-r from-blue-800 to-purple-800': darkMode }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Kesehatan Mental Anda?
            </h2>
            <p class="text-xl text-white opacity-90 mb-8">
                Bergabunglah dengan ribuan orang yang telah mempercayai MindCare untuk mendukung kesehatan mental mereka.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 bg-white text-blue-600 hover:bg-gray-50 shadow-lg hover:shadow-xl">
                    <i class="fas fa-user-plus mr-3"></i>
                    Daftar Sekarang
                </a>
                @endguest
                
                <a href="{{ route('assessments.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 border-2 border-white text-white hover:bg-white hover:text-blue-600">
                    <i class="fas fa-clipboard-check mr-3"></i>
                    Mulai Assessment
                </a>
            </div>
        </div>
    </section>

</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection