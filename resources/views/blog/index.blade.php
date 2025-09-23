@extends('layouts.app')

@section('title', '- Blog')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Blog MindCare
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Artikel terbaru seputar kesehatan mental, tips praktis, dan insights dari para ahli
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Search and Filter -->
                <div class="mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
                    <form method="GET" class="flex-1 max-w-md">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari artikel..."
                                   class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   :class="{ 'border-gray-300 bg-white text-gray-900': !darkMode, 'border-gray-600 bg-gray-700 text-white': darkMode }">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search transition-colors duration-300"
                                   :class="{ 'text-gray-400': !darkMode, 'text-gray-500': darkMode }"></i>
                            </div>
                        </div>
                    </form>
                    
                    <select onchange="window.location.href = this.value" 
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                            :class="{ 'border-gray-300 bg-white text-gray-900': !darkMode, 'border-gray-600 bg-gray-700 text-white': darkMode }">
                        <option value="{{ route('blog.index', array_merge(request()->query(), ['sort' => 'latest'])) }}" 
                                {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>
                            Terbaru
                        </option>
                        <option value="{{ route('blog.index', array_merge(request()->query(), ['sort' => 'popular'])) }}" 
                                {{ request('sort') === 'popular' ? 'selected' : '' }}>
                            Terpopuler
                        </option>
                        <option value="{{ route('blog.index', array_merge(request()->query(), ['sort' => 'oldest'])) }}" 
                                {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                            Terlama
                        </option>
                    </select>
                </div>

                <!-- Blog Posts -->
                <div class="space-y-8">
                    @forelse($blogs as $blog)
                    <article class="rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl"
                             :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }">
                        <div class="md:flex">
                            @if($blog->featured_image)
                            <div class="md:w-1/3">
                                <div class="h-48 md:h-full relative overflow-hidden">
                                    <img src="{{ $blog->featured_image }}" 
                                         alt="{{ $blog->title }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            </div>
                            @endif
                            
                            <div class="{{ $blog->featured_image ? 'md:w-2/3' : 'w-full' }} p-8">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $blog->category }}
                                    </span>
                                    <span class="text-sm transition-colors duration-300"
                                          :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                        {{ $blog->published_at->format('d M Y') }}
                                    </span>
                                </div>

                                <h2 class="text-2xl font-bold mb-3 transition-colors duration-300"
                                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    <a href="{{ route('blog.show', $blog) }}" class="hover:text-blue-600 transition-colors duration-200">
                                        {{ $blog->title }}
                                    </a>
                                </h2>
                                
                                <p class="text-base mb-4 line-clamp-3 transition-colors duration-300"
                                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                                    {{ $blog->excerpt }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm transition-colors duration-300"
                                         :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                        <span class="mr-4">
                                            <i class="fas fa-eye mr-1"></i>
                                            {{ number_format($blog->views) }}
                                        </span>
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $blog->reading_time }} min baca
                                        </span>
                                    </div>

                                    <a href="{{ route('blog.show', $blog) }}" 
                                       class="inline-flex items-center text-blue-500 hover:text-blue-600 font-medium transition-colors duration-200">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="text-center py-12">
                        <i class="fas fa-blog text-6xl mb-4 transition-colors duration-300"
                           :class="{ 'text-gray-300': !darkMode, 'text-gray-600': darkMode }"></i>
                        <h3 class="text-xl font-semibold mb-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            Tidak ada artikel ditemukan
                        </h3>
                        <p class="transition-colors duration-300"
                           :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                            Coba ubah kata kunci pencarian Anda
                        </p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($blogs->hasPages())
                <div class="mt-12">
                    {{ $blogs->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Featured Posts -->
                @if(count($featuredBlogs) > 0)
                <div class="sidebar mb-8">
                    <h3 class="sidebar-title">Artikel Pilihan</h3>
                    <div class="space-y-4">
                        @foreach($featuredBlogs as $featured)
                        <article class="group">
                            <h4 class="font-semibold text-sm mb-2 line-clamp-2 transition-colors duration-300"
                                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                <a href="{{ route('blog.show', $featured) }}" 
                                   class="hover:text-blue-600 transition-colors duration-200">
                                    {{ $featured->title }}
                                </a>
                            </h4>
                            <p class="text-xs transition-colors duration-300"
                               :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ $featured->published_at->format('d M Y') }}
                            </p>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Categories -->
                @if(count($categories) > 0)
                <div class="sidebar mb-8">
                    <h3 class="sidebar-title">Kategori</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                        <a href="{{ route('blog.category', $category->category) }}" 
                           class="flex items-center justify-between py-2 px-3 rounded-lg transition-colors duration-200"
                           :class="{ 'hover:bg-gray-100': !darkMode, 'hover:bg-gray-700': darkMode }">
                            <span class="text-sm transition-colors duration-300"
                                  :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                                {{ $category->category }}
                            </span>
                            <span class="text-xs px-2 py-1 rounded-full transition-colors duration-300"
                                  :class="{ 'bg-gray-200 text-gray-600': !darkMode, 'bg-gray-600 text-gray-300': darkMode }">
                                {{ $category->count }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Popular Tags -->
                @if(count($popularTags) > 0)
                <div class="sidebar">
                    <h3 class="sidebar-title">Tag Populer</h3>
                    <div class="tag-cloud">
                        @foreach($popularTags->take(15) as $tag => $count)
                        <a href="{{ route('blog.tag', $tag) }}" class="tag-item">
                            {{ $tag }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection