@extends('layouts.app')

@section('title', '- Hubungi Kami')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Hubungi Kami
            </h1>
            <p class="text-xl max-w-3xl mx-auto transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Kami siap membantu Anda. Jangan ragu untuk menghubungi tim MindCare kapan saja
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="rounded-2xl p-8 transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <h2 class="text-2xl font-bold mb-6 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Kirim Pesan
                </h2>
                
                <form class="space-y-6" data-validate>
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required class="form-input">
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" required class="form-input">
                        </div>
                    </div>
                    
                    <div>
                        <label for="subject" class="form-label">Subjek</label>
                        <select id="subject" name="subject" required class="form-select">
                            <option value="">Pilih subjek</option>
                            <option value="general">Pertanyaan Umum</option>
                            <option value="technical">Bantuan Teknis</option>
                            <option value="feedback">Feedback & Saran</option>
                            <option value="partnership">Kerjasama</option>
                            <option value="emergency">Bantuan Darurat</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="form-label">Pesan</label>
                        <textarea id="message" name="message" rows="6" required class="form-textarea" 
                                  placeholder="Tuliskan pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Emergency Contact -->
                <div class="rounded-2xl p-8 border-2 border-red-200 transition-colors duration-300"
                     :class="{ 'bg-red-50': !darkMode, 'bg-red-900/20 border-red-800': darkMode }">
                    <h3 class="text-xl font-bold mb-4 text-red-600">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Bantuan Darurat
                    </h3>
                    <p class="mb-4 transition-colors duration-300"
                       :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                        Jika Anda mengalami krisis atau membutuhkan bantuan segera:
                    </p>
                    <div class="space-y-3">
                        <a href="tel:119" 
                           class="flex items-center p-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                            <i class="fas fa-phone mr-3"></i>
                            <div>
                                <div class="font-semibold">Hotline 119</div>
                                <div class="text-sm opacity-90">24 jam, gratis</div>
                            </div>
                        </a>
                        <a href="{{ route('counseling.index') }}" 
                           class="flex items-center p-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-comments mr-3"></i>
                            <div>
                                <div class="font-semibold">Chat Konseling</div>
                                <div class="text-sm opacity-90">Tersedia 24/7</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Regular Contact -->
                <div class="rounded-2xl p-8 transition-colors duration-300"
                     :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                    <h3 class="text-xl font-bold mb-6 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Informasi Kontak
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold transition-colors duration-300"
                                     :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    Email
                                </div>
                                <div class="text-sm transition-colors duration-300"
                                     :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                                    support@mindcare.com
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold transition-colors duration-300"
                                     :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    Telepon
                                </div>
                                <div class="text-sm transition-colors duration-300"
                                     :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                                    +62 21 1234 5678
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-purple-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold transition-colors duration-300"
                                     :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    Jam Operasional
                                </div>
                                <div class="text-sm transition-colors duration-300"
                                     :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                                    Senin - Jumat: 08:00 - 17:00 WIB
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-orange-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold transition-colors duration-300"
                                     :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    Alamat
                                </div>
                                <div class="text-sm transition-colors duration-300"
                                     :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                                    Jakarta, Indonesia
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="rounded-2xl p-8 transition-colors duration-300"
                     :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                    <h3 class="text-xl font-bold mb-6 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Ikuti Kami
                    </h3>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white hover:bg-blue-700 transition-colors duration-200">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-sky-500 flex items-center justify-center text-white hover:bg-sky-600 transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-pink-600 flex items-center justify-center text-white hover:bg-pink-700 transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center text-white hover:bg-blue-800 transition-colors duration-200">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!-- FAQ Link -->
                <div class="rounded-2xl p-8 transition-colors duration-300"
                     :class="{ 'bg-gradient-to-r from-blue-50 to-indigo-50': !darkMode, 'bg-gradient-to-r from-blue-900/20 to-indigo-900/20': darkMode }">
                    <h3 class="text-xl font-bold mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        Pertanyaan Umum
                    </h3>
                    <p class="mb-4 transition-colors duration-300"
                       :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                        Temukan jawaban untuk pertanyaan yang sering diajukan
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                        Lihat FAQ
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection