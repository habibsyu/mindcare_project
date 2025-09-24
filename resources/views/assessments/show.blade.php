@extends('layouts.app')

@section('title', "- {$config['name']}")

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                {{ $config['name'] }}
            </h1>
            <p class="text-lg transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                {{ $config['description'] }}
            </p>
        </div>

        <!-- Test Information -->
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Tentang Tes Ini
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Informasi Tes
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li>• Jumlah pertanyaan: {{ count($config['questions']) }}</li>
                        <li>• Waktu estimasi: 5-10 menit</li>
                        <li>• Berdasarkan standar internasional</li>
                        <li>• Hasil langsung tersedia</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-3 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Tingkat Keparahan
                    </h3>
                    <div class="space-y-2">
                        @foreach($config['thresholds'] as $level => $range)
                        <div class="flex items-center justify-between p-2 rounded transition-colors duration-300"
                             :class="{ 'bg-gray-50': !darkMode, 'bg-gray-700': darkMode }">
                            <span class="text-sm font-medium transition-colors duration-300"
                                  :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                                {{ ucfirst(str_replace('_', ' ', $level)) }}
                            </span>
                            <span class="text-xs transition-colors duration-300"
                                  :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                {{ $range['min'] }}-{{ $range['max'] }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Result -->
        @if($latestAssessment)
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-blue-50': !darkMode, 'bg-blue-900/20': darkMode }">
            <h2 class="text-xl font-semibold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Hasil Tes Terakhir
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">
                        {{ $latestAssessment->score }}
                    </div>
                    <div class="text-sm transition-colors duration-300"
                         :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Total Skor
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="text-lg font-semibold mb-2 transition-colors duration-300"
                         :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ ucfirst(str_replace('_', ' ', $latestAssessment->severity_level)) }}
                    </div>
                    <div class="text-sm transition-colors duration-300"
                         :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Tingkat Keparahan
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="text-sm font-medium mb-2 transition-colors duration-300"
                         :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ $latestAssessment->completed_at->format('d M Y') }}
                    </div>
                    <div class="text-sm transition-colors duration-300"
                         :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Tanggal Tes
                    </div>
                </div>
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ route('assessments.result', $latestAssessment->id) }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Lihat Detail Hasil
                </a>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center space-y-4">
            <a href="{{ route('assessments.take', $type) }}" 
               class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl">
                <i class="fas fa-play mr-3"></i>
                {{ $latestAssessment ? 'Tes Ulang' : 'Mulai Tes' }}
            </a>
            
            <div>
                <a href="{{ route('assessments.index') }}" 
                   class="inline-flex items-center px-6 py-3 text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Assessment
                </a>
            </div>
        </div>
    </div>
</div>
@endsection