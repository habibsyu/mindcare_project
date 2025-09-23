@extends('layouts.app')

@section('title', '- Konten Edukasi')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Konten Edukasi Kesehatan Mental
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Pelajari berbagai topik kesehatan mental melalui artikel, video, dan kuis interaktif
            </p>
        </div>

        <!-- Filters -->
        <div class="mb-8 flex flex-wrap gap-4 justify-center">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('content.index') }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 {{ !request('type') ? 'bg-blue-600 text-white' : '' }}"
                   :class="!{{ request('type') ? 'true' : 'false' }} ? 'bg-blue-600 text-white' : (darkMode ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' : 'bg-white text-gray-700 hover:bg-gray-100')">
                    Semua
                </a>
                <a href="{{ route('content.index', ['type' => 'article']) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 {{ request('type') === 'article' ? 'bg-green-600 text-white' : '' }}"
                   :class="{{ request('type') === 'article' ? 'true' : 'false' }} ? 'bg-green-600 text-white' : (darkMode ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' : 'bg-white text-gray-700 hover:bg-gray-100')">
                    <i class="fas fa-newspaper mr-1"></i>
                    Artikel
                </a>
                <a href="{{ route('content.index', ['type' => 'video']) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 {{ request('type') === 'video' ? 'bg-red-600 text-white' : '' }}"
                   :class="{{ request('type') === 'video' ? 'true' : 'false' }} ? 'bg-red-600 text-white' : (darkMode ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' : 'bg-white text-gray-700 hover:bg-gray-100')">
                    <i class="fas fa-play mr-1"></i>
                    Video
                </a>
                <a href="{{ route('content.index', ['type' => 'quiz']) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 {{ request('type') === 'quiz' ? 'bg-purple-600 text-white' : '' }}"
                   :class="{{ request('type') === 'quiz' ? 'true' : 'false' }} ? 'bg-purple-600 text-white' : (darkMode ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' : 'bg-white text-gray-700 hover:bg-gray-100')">
                    <i class="fas fa-question-circle mr-1"></i>
                    Kuis
                </a>
            </div>
        </div>

        <!-- Search and Sort -->
        <div class="mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
            <form method="GET" class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari konten..."
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                           :class="{ 'border-gray-300 bg-white text-gray-900': !darkMode, 'border-gray-600 bg-gray-700 text-white': darkMode }">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search transition-colors duration-300"
                           :class="{ 'text-gray-400': !darkMode, 'text-gray-500': darkMode }"></i>
                    </div>
                </div>
            </form>
            
            <div class="flex gap-2">
                <select onchange="window.location.href = this.value" 
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                        :class="{ 'border-gray-300 bg-white text-gray-900': !darkMode, 'border-gray-600 bg-gray-700 text-white': darkMode }">
                    <option value="{{ route('content.index', array_merge(request()->query(), ['sort' => 'latest'])) }}" 
                            {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>
                        Terbaru
                    </option>
                    <option value="{{ route('content.index', array_merge(request()->query(), ['sort' => 'popular'])) }}" 
                            {{ request('sort') === 'popular' ? 'selected' : '' }}>
                        Terpopuler
                    </option>
                    <option value="{{ route('content.index', array_merge(request()->query(), ['sort' => 'liked'])) }}" 
                            {{ request('sort') === 'liked' ? 'selected' : '' }}>
                        Paling Disukai
                    </option>
                </select>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($contents as $content)
            <article class="content-card group">
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

                    <div class="flex items-center justify-between text-xs mb-4 transition-colors duration-300"
                         :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                        <span>
                            <i class="fas fa-eye mr-1"></i>
                            {{ number_format($content->views) }} views
                        </span>
                        <span>
                            <i class="fas fa-heart mr-1"></i>
                            {{ number_format($content->likes) }} likes
                        </span>
                        @if($content->reading_time)
                        <span>
                            <i class="fas fa-clock mr-1"></i>
                            {{ $content->reading_time }} min
                        </span>
                        @endif
                    </div>

                    <a href="{{ route('content.show', $content) }}" 
                       class="inline-flex items-center text-blue-500 hover:text-blue-600 font-medium transition-colors duration-200">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-search text-6xl mb-4 transition-colors duration-300"
                   :class="{ 'text-gray-300': !darkMode, 'text-gray-600': darkMode }"></i>
                <h3 class="text-xl font-semibold mb-2 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Tidak ada konten ditemukan
                </h3>
                <p class="transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                    Coba ubah filter atau kata kunci pencarian Anda
                </p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($contents->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $contents->links() }}
        </div>
        @endif
    </div>
</div>
@endsection