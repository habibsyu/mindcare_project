@extends('layouts.app')

@section('title', '- Konseling Online')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Konseling Online MindCare
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Dapatkan dukungan dan bimbingan dari AI counselor atau konselor profesional kami
            </p>
        </div>

        <!-- Active Sessions -->
        @if(count($activeSessions) > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Sesi Aktif
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($activeSessions as $session)
                <div class="rounded-2xl p-6 border-2 border-green-200 transition-all duration-300"
                     :class="{ 'bg-green-50': !darkMode, 'bg-green-900/20 border-green-800': darkMode }">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                            <span class="font-semibold transition-colors duration-300"
                                  :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                Sesi {{ $session->isAiMode() ? 'AI Counselor' : 'Human Counselor' }}
                            </span>
                        </div>
                        <span class="text-sm px-3 py-1 bg-green-100 text-green-800 rounded-full">
                            Aktif
                        </span>
                    </div>
                    
                    <p class="text-sm mb-4 transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Dimulai: {{ $session->started_at->format('d M Y, H:i') }}
                    </p>
                    
                    <a href="{{ route('counseling.chat', $session->session_id) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-comments mr-2"></i>
                        Lanjutkan Chat
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Start New Session -->
        <div class="mb-12">
            <div class="rounded-2xl p-8 text-center transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <div class="w-20 h-20 rounded-full mx-auto mb-6 flex items-center justify-center transition-colors duration-300"
                     :class="{ 'bg-blue-100': !darkMode, 'bg-blue-900': darkMode }">
                    <i class="fas fa-comments text-3xl text-blue-600"></i>
                </div>
                
                <h2 class="text-2xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Mulai Sesi Konseling Baru
                </h2>
                
                <p class="text-lg mb-8 max-w-2xl mx-auto transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Kami menyediakan layanan konseling 24/7 dengan AI counselor yang terlatih, 
                    dan opsi untuk terhubung dengan konselor profesional jika diperlukan.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-8">
                    <div class="p-6 rounded-xl transition-colors duration-300"
                         :class="{ 'bg-gray-50': !darkMode, 'bg-gray-700': darkMode }">
                        <i class="fas fa-robot text-3xl text-blue-500 mb-4"></i>
                        <h3 class="font-bold mb-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            AI Counselor
                        </h3>
                        <ul class="text-sm space-y-1 transition-colors duration-300"
                            :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            <li>• Tersedia 24/7</li>
                            <li>• Respons instan</li>
                            <li>• Privasi terjamin</li>
                            <li>• Gratis</li>
                        </ul>
                    </div>
                    
                    <div class="p-6 rounded-xl transition-colors duration-300"
                         :class="{ 'bg-gray-50': !darkMode, 'bg-gray-700': darkMode }">
                        <i class="fas fa-user-md text-3xl text-green-500 mb-4"></i>
                        <h3 class="font-bold mb-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            Human Counselor
                        </h3>
                        <ul class="text-sm space-y-1 transition-colors duration-300"
                            :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            <li>• Konselor bersertifikat</li>
                            <li>• Pendekatan personal</li>
                            <li>• Handover dari AI</li>
                            <li>• Kasus kompleks</li>
                        </ul>
                    </div>
                </div>
                
                <a href="{{ route('counseling.start') }}" 
                   class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl">
                    <i class="fas fa-play mr-3"></i>
                    Mulai Konseling Sekarang
                </a>
            </div>
        </div>

        <!-- Recent Sessions -->
        @if(count($completedSessions) > 0)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Riwayat Konseling
                </h2>
                <a href="{{ route('counseling.history') }}" 
                   class="text-blue-500 hover:text-blue-600 font-medium transition-colors duration-200">
                    Lihat Semua
                </a>
            </div>
            
            <div class="space-y-4">
                @foreach($completedSessions->take(5) as $session)
                <div class="rounded-xl p-6 transition-colors duration-300"
                     :class="{ 'bg-white shadow-md': !darkMode, 'bg-gray-800 shadow-lg': darkMode }">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full mr-4 flex items-center justify-center transition-colors duration-300"
                                 :class="{ 'bg-gray-100': !darkMode, 'bg-gray-700': darkMode }">
                                <i class="fas fa-{{ $session->isAiMode() ? 'robot' : 'user-md' }} text-gray-500"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold transition-colors duration-300"
                                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    {{ $session->isAiMode() ? 'AI Counselor' : 'Human Counselor' }}
                                </h3>
                                <p class="text-sm transition-colors duration-300"
                                   :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                    {{ $session->ended_at->format('d M Y, H:i') }}
                                    @if($session->duration)
                                        • {{ $session->duration }} menit
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            @if($session->rating)
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-sm {{ $i <= $session->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            @endif
                            <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                Selesai
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Information -->
        <div class="rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-gradient-to-r from-purple-50 to-pink-50': !darkMode, 'bg-gradient-to-r from-purple-900/20 to-pink-900/20': darkMode }">
            <h2 class="text-2xl font-bold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Tentang Layanan Konseling Kami
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Keamanan & Privasi
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Semua percakapan terenkripsi end-to-end
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Data tidak dibagikan ke pihak ketiga
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Konselor terikat kode etik profesional
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-1"></i>
                            Akses hanya untuk Anda dan konselor
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Kapan Harus Mencari Bantuan
                    </h3>
                    <ul class="space-y-2 transition-colors duration-300"
                        :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        <li class="flex items-start">
                            <i class="fas fa-heart text-red-500 mr-2 mt-1"></i>
                            Merasa sedih atau cemas berkepanjangan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-heart text-red-500 mr-2 mt-1"></i>
                            Kesulitan mengatasi stres sehari-hari
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-heart text-red-500 mr-2 mt-1"></i>
                            Perubahan pola tidur atau makan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-heart text-red-500 mr-2 mt-1"></i>
                            Butuh seseorang untuk diajak bicara
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection