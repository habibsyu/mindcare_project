@extends('layouts.app')

@section('title', '- Self Assessment')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Self-Assessment Kesehatan Mental
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Kenali kondisi kesehatan mental Anda dengan tes yang telah terstandarisasi secara internasional
            </p>
        </div>

        <!-- Assessment Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($availableTests as $testType => $testName)
            @php
                $latestTest = $userAssessments->get($testType)?->first();
                $config = config("assessments.{$testType}");
            @endphp
            
            <div class="rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl"
                 :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }">
                <div class="p-8">
                    <!-- Test Icon -->
                    <div class="w-16 h-16 rounded-full mb-6 flex items-center justify-center
                        {{ $testType === 'phq-9' ? 'bg-blue-100 text-blue-600' : ($testType === 'gad-7' ? 'bg-green-100 text-green-600' : 'bg-purple-100 text-purple-600') }}">
                        <i class="fas fa-{{ $testType === 'phq-9' ? 'heart' : ($testType === 'gad-7' ? 'brain' : 'chart-line') }} text-2xl"></i>
                    </div>

                    <!-- Test Info -->
                    <h3 class="text-xl font-bold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ $testName }}
                    </h3>
                    <p class="text-sm mb-6 transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        {{ $config['description'] }}
                    </p>

                    <!-- Last Result -->
                    @if($latestTest)
                    <div class="mb-6 p-4 rounded-lg transition-colors duration-300"
                         :class="{ 'bg-gray-50': !darkMode, 'bg-gray-700': darkMode }">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium transition-colors duration-300"
                                  :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                                Tes Terakhir:
                            </span>
                            <span class="text-xs transition-colors duration-300"
                                  :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ $latestTest->completed_at->format('d M Y') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold transition-colors duration-300"
                                  :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                Skor: {{ $latestTest->score }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $latestTest->severity_level === 'minimal' || $latestTest->severity_level === 'normal' ? 'bg-green-100 text-green-800' : 
                                   ($latestTest->severity_level === 'mild' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($latestTest->severity_level === 'moderate' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst(str_replace('_', ' ', $latestTest->severity_level)) }}
                            </span>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <a href="{{ route('assessments.take', $testType) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white transition-colors duration-200
                           {{ $testType === 'phq-9' ? 'bg-blue-600 hover:bg-blue-700' : ($testType === 'gad-7' ? 'bg-green-600 hover:bg-green-700' : 'bg-purple-600 hover:bg-purple-700') }}">
                            <i class="fas fa-play mr-2"></i>
                            {{ $latestTest ? 'Tes Ulang' : 'Mulai Tes' }}
                        </a>
                        
                        @if($latestTest)
                        <a href="{{ route('assessments.result', $latestTest->id) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 border rounded-lg text-sm font-medium transition-colors duration-200"
                           :class="{ 'border-gray-300 text-gray-700 hover:bg-gray-50': !darkMode, 'border-gray-600 text-gray-300 hover:bg-gray-700': darkMode }">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Lihat Hasil
                        </a>
                        @endif
                        
                        <a href="{{ route('assessments.show', $testType) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors duration-200"
                           :class="{ 'text-gray-600 hover:text-gray-800': !darkMode, 'text-gray-400 hover:text-gray-200': darkMode }">
                            <i class="fas fa-info-circle mr-2"></i>
                            Info Lengkap
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Dashboard Link -->
        <div class="text-center">
            <a href="{{ route('assessments.dashboard') }}" 
               class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105"
               :class="{ 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl': !darkMode, 'bg-blue-500 text-white hover:bg-blue-600 shadow-lg hover:shadow-xl': darkMode }">
                <i class="fas fa-chart-line mr-3"></i>
                Lihat Dashboard Personal
            </a>
        </div>

        <!-- Information Section -->
        <div class="mt-16 rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-2xl font-bold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Tentang Self-Assessment
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Mengapa Penting?
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Deteksi dini masalah kesehatan mental
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Membantu memahami kondisi emosional
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Panduan untuk mencari bantuan profesional
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Tracking progress kesehatan mental
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Keamanan Data
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Data terenkripsi dan aman
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Privasi terjamin 100%
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Tidak dibagikan ke pihak ketiga
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Akses hanya untuk Anda
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection