@extends('layouts.app')

@section('title', "- {$blog->title}")
@section('description', $blog->excerpt)

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $blog->category }}
                </span>
                <span class="ml-2 text-sm transition-colors duration-300"
                      :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                    {{ $blog->published_at->format('d M Y') }}
                </span>
            </div>
            
            <h1 class="text-3xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                {{ $blog->title }}
            </h1>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 text-sm transition-colors duration-300"
                     :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                    <span>
                        <i class="fas fa-user mr-1"></i>
                        {{ $blog->author->name }}
                    </span>
                    <span>
                        <i class="fas fa-eye mr-1"></i>
                        {{ number_format($blog->views) }} views
                    </span>
                    <span>
                        <i class="fas fa-clock mr-1"></i>
                        {{ $blog->reading_time }} min baca
                    </span>
                </div>
            </div>
        </div>

        <!-- Featured Image -->
        @if($blog->featured_image)
        <div class="rounded-2xl overflow-hidden mb-8">
            <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-64 md:h-96 object-cover">
        </div>
        @endif

        <!-- Content -->
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            
            <div class="text-lg mb-6 transition-colors duration-300"
                 :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                {{ $blog->excerpt }}
            </div>
            
            <div class="prose max-w-none transition-colors duration-300"
                 :class="{ 'prose-gray': !darkMode, 'prose-invert': darkMode }">
                {!! $blog->body !!}
            </div>
        </div>

        <!-- Tags -->
        @if($blog->tags && count($blog->tags) > 0)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Tags
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach($blog->tags as $tag)
                <a href="{{ route('blog.tag', $tag) }}" 
                   class="px-3 py-1 rounded-full text-sm transition-colors duration-200"
                   :class="{ 'bg-gray-100 text-gray-700 hover:bg-gray-200': !darkMode, 'bg-gray-700 text-gray-300 hover:bg-gray-600': darkMode }">
                    #{{ $tag }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Share Buttons -->
        <div class="mb-8 text-center">
            <h3 class="text-lg font-semibold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Bagikan Artikel
            </h3>
            <div class="flex justify-center space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fab fa-facebook mr-2"></i>
                    Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" 
                   target="_blank"
                   class="flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors duration-200">
                    <i class="fab fa-twitter mr-2"></i>
                    Twitter
                </a>
                <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . request()->url()) }}" 
                   target="_blank"
                   class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fab fa-whatsapp mr-2"></i>
                    WhatsApp
                </a>
                <button onclick="copyToClipboard('{{ request()->url() }}')" 
                        class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200"
                        :class="{ 'bg-gray-100 text-gray-700 hover:bg-gray-200': !darkMode, 'bg-gray-700 text-gray-300 hover:bg-gray-600': darkMode }">
                    <i class="fas fa-link mr-2"></i>
                    Copy Link
                </button>
            </div>
        </div>

        <!-- Related Blogs -->
        @if(count($relatedBlogs) > 0)
        <div class="rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Artikel Terkait
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedBlogs as $related)
                <a href="{{ route('blog.show', $related) }}" 
                   class="block rounded-lg overflow-hidden transition-all duration-300 hover:scale-105"
                   :class="{ 'bg-gray-50 hover:shadow-md': !darkMode, 'bg-gray-700 hover:bg-gray-600': darkMode }">
                    @if($related->featured_image)
                    <img src="{{ $related->featured_image }}" alt="{{ $related->title }}" class="w-full h-32 object-cover">
                    @else
                    <div class="w-full h-32 flex items-center justify-center transition-colors duration-300"
                         :class="{ 'bg-gray-200': !darkMode, 'bg-gray-600': darkMode }">
                        <i class="fas fa-blog text-2xl transition-colors duration-300"
                           :class="{ 'text-gray-400': !darkMode, 'text-gray-500': darkMode }"></i>
                    </div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="font-medium mb-2 line-clamp-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            {{ $related->title }}
                        </h3>
                        <p class="text-sm line-clamp-2 transition-colors duration-300"
                           :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            {{ $related->excerpt }}
                        </p>
                        <div class="text-xs mt-2 transition-colors duration-300"
                             :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                            {{ $related->published_at->format('d M Y') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showNotification('Link berhasil disalin!', 'success');
    }, function(err) {
        console.error('Could not copy text: ', err);
        showNotification('Gagal menyalin link', 'error');
    });
}
</script>
@endsection