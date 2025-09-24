@extends('layouts.app')

@section('title', '- Hasil Assessment')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Hasil {{ $config['name'] }}
            </h1>
            <p class="text-lg transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Tes diselesaikan pada {{ $assessment->completed_at->format('d M Y, H:i') }}
            </p>
        </div>

        <!-- Score Card -->
        <div class="rounded-2xl p-8 mb-8 text-center transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <div class="w-32 h-32 rounded-full mx-auto mb-6 flex items-center justify-center text-4xl font-bold text-white
                {{ $assessment->severity_level === 'minimal' || $assessment->severity_level === 'normal' ? 'bg-green-500' : 
                   ($assessment->severity_level === 'mild' ? 'bg-yellow-500' : 
                   ($assessment->severity_level === 'moderate' ? 'bg-orange-500' : 'bg-red-500')) }}">
                {{ $assessment->score }}
            </div>
            
            <h2 class="text-2xl font-bold mb-2 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Skor Total: {{ $assessment->score }}
            </h2>
            
            <p class="text-xl mb-4 transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Tingkat: {{ ucfirst(str_replace('_', ' ', $assessment->severity_level)) }}
            </p>
            
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                {{ $assessment->severity_level === 'minimal' || $assessment->severity_level === 'normal' ? 'bg-green-100 text-green-800' : 
                   ($assessment->severity_level === 'mild' ? 'bg-yellow-100 text-yellow-800' : 
                   ($assessment->severity_level === 'moderate' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800')) }}">
                <i class="fas fa-info-circle mr-2"></i>
                {{ $config['recommendations'][$assessment->severity_level] ?? 'Konsultasikan dengan profesional.' }}
            </div>
        </div>

        <!-- DASS-21 Subscales -->
        @if($assessment->test_type === 'dass-21' && isset($assessment->result['subscales']))
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h3 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Detail Subscales
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($assessment->result['subscales'] as $subscale => $data)
                <div class="text-center p-4 rounded-lg transition-colors duration-300"
                     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-700': darkMode }">
                    <h4 class="font-semibold mb-2 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ ucfirst($subscale) }}
                    </h4>
                    <div class="text-2xl font-bold text-blue-600 mb-1">
                        {{ $data['score'] }}
                    </div>
                    <div class="text-sm transition-colors duration-300"
                         :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        {{ ucfirst(str_replace('_', ' ', $data['level'])) }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recommendations -->
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-blue-50': !darkMode, 'bg-blue-900/20': darkMode }">
            <h3 class="text-xl font-semibold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Rekomendasi
            </h3>
            <p class="text-lg mb-6 transition-colors duration-300"
               :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                {{ $assessment->recommendations }}
            </p>
            
            @if(count($recommendedContent) > 0)
            <h4 class="font-semibold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Konten yang Direkomendasikan:
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recommendedContent as $content)
                <a href="{{ route('content.show', $content) }}" 
                   class="block p-4 rounded-lg transition-all duration-200 hover:scale-105"
                   :class="{ 'bg-white hover:shadow-md': !darkMode, 'bg-gray-800 hover:bg-gray-700': darkMode }">
                    <h5 class="font-medium mb-2 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ $content->title }}
                    </h5>
                    <p class="text-sm transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                        {{ Str::limit($content->excerpt, 100) }}
                    </p>
                </a>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('assessments.take', $assessment->test_type) }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-redo mr-2"></i>
                    Tes Ulang
                </a>
                
                <a href="{{ route('assessments.dashboard') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-chart-line mr-2"></i>
                    Lihat Dashboard
                </a>
                
                <a href="{{ route('counseling.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition-colors duration-200">
                    <i class="fas fa-comments mr-2"></i>
                    Konseling
                </a>
            </div>
            
            <div>
                <a href="{{ route('assessments.index') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Assessment
                </a>
            </div>
        </div>
    </div>
</div>
@endsection