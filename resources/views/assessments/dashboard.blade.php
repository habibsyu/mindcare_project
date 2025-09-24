@extends('layouts.app')

@section('title', '- Dashboard Personal')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Dashboard Personal
            </h1>
            <p class="text-lg transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Pantau progress kesehatan mental Anda
            </p>
        </div>

        <!-- Latest Assessments -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach(['phq-9', 'gad-7', 'dass-21'] as $testType)
            @php
                $latest = $latestAssessments[$testType] ?? null;
                $config = config("assessments.{$testType}");
            @endphp
            
            <div class="rounded-2xl p-6 transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ $config['name'] }}
                    </h3>
                    <div class="w-3 h-3 rounded-full {{ $latest ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                </div>
                
                @if($latest)
                <div class="mb-4">
                    <div class="text-2xl font-bold text-blue-600 mb-1">
                        {{ $latest->score }}
                    </div>
                    <div class="text-sm transition-colors duration-300"
                         :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        {{ ucfirst(str_replace('_', ' ', $latest->severity_level)) }}
                    </div>
                    <div class="text-xs transition-colors duration-300"
                         :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                        {{ $latest->completed_at->format('d M Y') }}
                    </div>
                </div>
                
                <div class="space-y-2">
                    <a href="{{ route('assessments.result', $latest->id) }}" 
                       class="block w-full text-center px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Lihat Detail
                    </a>
                    <a href="{{ route('assessments.take', $testType) }}" 
                       class="block w-full text-center px-4 py-2 text-sm border rounded-lg transition-colors duration-200"
                       :class="{ 'border-gray-300 text-gray-700 hover:bg-gray-50': !darkMode, 'border-gray-600 text-gray-300 hover:bg-gray-700': darkMode }">
                        Tes Ulang
                    </a>
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-sm mb-4 transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                        Belum ada tes
                    </p>
                    <a href="{{ route('assessments.take', $testType) }}" 
                       class="inline-flex items-center px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-play mr-2"></i>
                        Mulai Tes
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Progress Chart -->
        @if(count($assessmentHistory) > 0)
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Progress Assessment
            </h2>
            
            <div class="space-y-6">
                @foreach($assessmentHistory as $testType => $history)
                @if(count($history) > 1)
                <div>
                    <h3 class="font-medium mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ config("assessments.{$testType}.name") }}
                    </h3>
                    <div class="flex items-end space-x-2 h-32">
                        @foreach($history->take(10) as $assessment)
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-full bg-blue-600 rounded-t transition-all duration-300 hover:bg-blue-700"
                                 style="height: {{ ($assessment->score / 27) * 100 }}%"
                                 title="Skor: {{ $assessment->score }} ({{ $assessment->completed_at->format('d/m') }})">
                            </div>
                            <div class="text-xs mt-1 transition-colors duration-300"
                                 :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ $assessment->completed_at->format('d/m') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recommended Content -->
        @if(count($recommendedContent) > 0)
        <div class="rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Konten Rekomendasi
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recommendedContent as $content)
                <a href="{{ route('content.show', $content) }}" 
                   class="block rounded-lg overflow-hidden transition-all duration-300 hover:scale-105"
                   :class="{ 'bg-gray-50 hover:shadow-md': !darkMode, 'bg-gray-700 hover:bg-gray-600': darkMode }">
                    @if($content->thumbnail)
                    <img src="{{ $content->thumbnail }}" alt="{{ $content->title }}" class="w-full h-32 object-cover">
                    @else
                    <div class="w-full h-32 flex items-center justify-center transition-colors duration-300"
                         :class="{ 'bg-gray-200': !darkMode, 'bg-gray-600': darkMode }">
                        <i class="fas fa-{{ $content->type === 'article' ? 'newspaper' : ($content->type === 'video' ? 'play' : 'question-circle') }} text-2xl transition-colors duration-300"
                           :class="{ 'text-gray-400': !darkMode, 'text-gray-500': darkMode }"></i>
                    </div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="font-medium mb-2 line-clamp-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            {{ $content->title }}
                        </h3>
                        <p class="text-sm line-clamp-2 transition-colors duration-300"
                           :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            {{ $content->excerpt }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection