<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MindCare') }} @yield('title')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'MindCare - Platform kesehatan mental dengan self-assessment, edukasi, dan konseling online.')">
    <meta name="keywords" content="@yield('keywords', 'kesehatan mental, self-assessment, PHQ-9, GAD-7, DASS-21, konseling online')">
    <meta name="author" content="MindCare">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og-title', config('app.name'))">
    <meta property="og:description" content="@yield('og-description', 'Platform kesehatan mental terpercaya')">
    <meta property="og:image" content="@yield('og-image', asset('images/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter-title', config('app.name'))">
    <meta name="twitter:description" content="@yield('twitter-description', 'Platform kesehatan mental terpercaya')">
    <meta name="twitter:image" content="@yield('twitter-image', asset('images/og-image.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased transition-colors duration-300" 
      :class="{ 'bg-gray-50 text-gray-900': !darkMode, 'bg-gray-900 text-gray-100': darkMode }">
    
    <!-- Navigation -->
    <nav class="shadow-lg transition-colors duration-300"
         :class="{ 'bg-white border-gray-200': !darkMode, 'bg-gray-800 border-gray-700': darkMode }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <i class="fas fa-brain text-2xl mr-2" 
                               :class="{ 'text-blue-600': !darkMode, 'text-blue-400': darkMode }"></i>
                            <span class="text-xl font-bold" 
                                  :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                MindCare
                            </span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'border-b-2 border-blue-500 text-blue-600' : '' }}"
                           :class="{ 
                               'text-gray-900 hover:text-blue-600': !darkMode && !{{ request()->routeIs('home') ? 'true' : 'false' }}, 
                               'text-gray-300 hover:text-blue-400': darkMode && !{{ request()->routeIs('home') ? 'true' : 'false' }}
                           }">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                        
                        <a href="{{ route('assessments.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('assessments.*') ? 'border-b-2 border-blue-500 text-blue-600' : '' }}"
                           :class="{ 
                               'text-gray-900 hover:text-blue-600': !darkMode && !{{ request()->routeIs('assessments.*') ? 'true' : 'false' }}, 
                               'text-gray-300 hover:text-blue-400': darkMode && !{{ request()->routeIs('assessments.*') ? 'true' : 'false' }}
                           }">
                            <i class="fas fa-clipboard-check mr-2"></i>
                            Self-Assessment
                        </a>
                        
                        <a href="{{ route('content.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('content.*') ? 'border-b-2 border-blue-500 text-blue-600' : '' }}"
                           :class="{ 
                               'text-gray-900 hover:text-blue-600': !darkMode && !{{ request()->routeIs('content.*') ? 'true' : 'false' }}, 
                               'text-gray-300 hover:text-blue-400': darkMode && !{{ request()->routeIs('content.*') ? 'true' : 'false' }}
                           }">
                            <i class="fas fa-book-open mr-2"></i>
                            Edukasi
                        </a>
                        
                        <a href="{{ route('blog.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('blog.*') ? 'border-b-2 border-blue-500 text-blue-600' : '' }}"
                           :class="{ 
                               'text-gray-900 hover:text-blue-600': !darkMode && !{{ request()->routeIs('blog.*') ? 'true' : 'false' }}, 
                               'text-gray-300 hover:text-blue-400': darkMode && !{{ request()->routeIs('blog.*') ? 'true' : 'false' }}
                           }">
                            <i class="fas fa-blog mr-2"></i>
                            Blog
                        </a>
                        
                        <a href="{{ route('community.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('community.*') ? 'border-b-2 border-blue-500 text-blue-600' : '' }}"
                           :class="{ 
                               'text-gray-900 hover:text-blue-600': !darkMode && !{{ request()->routeIs('community.*') ? 'true' : 'false' }}, 
                               'text-gray-300 hover:text-blue-400': darkMode && !{{ request()->routeIs('community.*') ? 'true' : 'false' }}
                           }">
                            <i class="fas fa-users mr-2"></i>
                            Komunitas
                        </a>
                        
                        <a href="{{ route('counseling.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('counseling.*') ? 'border-b-2 border-blue-500 text-blue-600' : '' }}"
                           :class="{ 
                               'text-gray-900 hover:text-blue-600': !darkMode && !{{ request()->routeIs('counseling.*') ? 'true' : 'false' }}, 
                               'text-gray-300 hover:text-blue-400': darkMode && !{{ request()->routeIs('counseling.*') ? 'true' : 'false' }}
                           }">
                            <i class="fas fa-comments mr-2"></i>
                            Konseling
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                            class="p-2 rounded-lg transition-colors duration-200"
                            :class="{ 'bg-gray-100 hover:bg-gray-200': !darkMode, 'bg-gray-700 hover:bg-gray-600': darkMode }">
                        <i class="fas fa-moon" x-show="!darkMode"></i>
                        <i class="fas fa-sun text-yellow-400" x-show="darkMode" x-cloak></i>
                    </button>

                    @auth
                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200"
                                    :class="{ 'bg-gray-100 hover:bg-gray-200': !darkMode, 'bg-gray-700 hover:bg-gray-600': darkMode }">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">
                                            {{ substr(Auth::user()->display_name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                                <span class="text-sm font-medium" 
                                      :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    {{ Auth::user()->display_name }}
                                </span>
                                <i class="fas fa-chevron-down text-xs" 
                                   :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg z-50"
                                 :class="{ 'bg-white border border-gray-200': !darkMode, 'bg-gray-800 border border-gray-700': darkMode }"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100">
                                
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center px-4 py-2 text-sm transition-colors duration-200"
                                   :class="{ 'text-gray-700 hover:bg-gray-100': !darkMode, 'text-gray-300 hover:bg-gray-700': darkMode }">
                                    <i class="fas fa-user mr-3"></i>
                                    Profile
                                </a>
                                
                                <a href="{{ route('assessments.dashboard') }}" 
                                   class="flex items-center px-4 py-2 text-sm transition-colors duration-200"
                                   :class="{ 'text-gray-700 hover:bg-gray-100': !darkMode, 'text-gray-300 hover:bg-gray-700': darkMode }">
                                    <i class="fas fa-chart-line mr-3"></i>
                                    Dashboard
                                </a>

                                @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                                    <hr :class="{ 'border-gray-200': !darkMode, 'border-gray-700': darkMode }">
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="flex items-center px-4 py-2 text-sm transition-colors duration-200"
                                       :class="{ 'text-gray-700 hover:bg-gray-100': !darkMode, 'text-gray-300 hover:bg-gray-700': darkMode }">
                                        <i class="fas fa-cog mr-3"></i>
                                        Admin Panel
                                    </a>
                                @endif
                                
                                <hr :class="{ 'border-gray-200': !darkMode, 'border-gray-700': darkMode }">
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center w-full px-4 py-2 text-sm transition-colors duration-200"
                                            :class="{ 'text-red-600 hover:bg-red-50': !darkMode, 'text-red-400 hover:bg-red-900/20': darkMode }">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" 
                               class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200"
                               :class="{ 'text-blue-600 hover:text-blue-700': !darkMode, 'text-blue-400 hover:text-blue-300': darkMode }">
                                Login
                            </a>
                            <a href="{{ route('register') }}" 
                               class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200"
                               :class="{ 'bg-blue-600 text-white hover:bg-blue-700': !darkMode, 'bg-blue-500 text-white hover:bg-blue-600': darkMode }">
                                Register
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button x-data="{ mobileOpen: false }" @click="mobileOpen = !mobileOpen" 
                                class="p-2 rounded-lg transition-colors duration-200"
                                :class="{ 'bg-gray-100 hover:bg-gray-200': !darkMode, 'bg-gray-700 hover:bg-gray-600': darkMode }">
                            <i class="fas fa-bars" :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-cloak
             class="fixed top-20 right-4 z-50 max-w-sm w-full">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak
             class="fixed top-20 right-4 z-50 max-w-sm w-full">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="transition-colors duration-300"
            :class="{ 'bg-gray-900 text-white': !darkMode, 'bg-gray-950 text-gray-200': darkMode }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-brain text-2xl mr-2 text-blue-400"></i>
                        <span class="text-xl font-bold">MindCare</span>
                    </div>
                    <p class="mb-4" :class="{ 'text-gray-400': !darkMode, 'text-gray-300': darkMode }">
                        Platform kesehatan mental yang menyediakan self-assessment, edukasi, dan konseling online 
                        untuk membantu Anda mengelola kesehatan mental dengan lebih baik.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Layanan</h3>
                    <ul class="space-y-2" :class="{ 'text-gray-400': !darkMode, 'text-gray-300': darkMode }">
                        <li><a href="{{ route('assessments.index') }}" class="hover:text-blue-400 transition-colors duration-200">Self-Assessment</a></li>
                        <li><a href="{{ route('content.index') }}" class="hover:text-blue-400 transition-colors duration-200">Edukasi</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-blue-400 transition-colors duration-200">Blog</a></li>
                        <li><a href="{{ route('community.index') }}" class="hover:text-blue-400 transition-colors duration-200">Komunitas</a></li>
                        <li><a href="{{ route('counseling.index') }}" class="hover:text-blue-400 transition-colors duration-200">Konseling</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Informasi</h3>
                    <ul class="space-y-2" :class="{ 'text-gray-400': !darkMode, 'text-gray-300': darkMode }">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors duration-200">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition-colors duration-200">Kontak</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-blue-400 transition-colors duration-200">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-blue-400 transition-colors duration-200">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t mt-8 pt-8" :class="{ 'border-gray-800': !darkMode, 'border-gray-700': darkMode }">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p :class="{ 'text-gray-400': !darkMode, 'text-gray-300': darkMode }">
                        © {{ date('Y') }} MindCare. Semua hak cipta dilindungi.
                    </p>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        <span class="text-sm" :class="{ 'text-gray-400': !darkMode, 'text-gray-300': darkMode }">
                            <i class="fas fa-shield-alt mr-1 text-green-400"></i>
                            Data Anda Aman
                        </span>
                        <span class="text-sm" :class="{ 'text-gray-400': !darkMode, 'text-gray-300': darkMode }">
                            <i class="fas fa-lock mr-1 text-blue-400"></i>
                            SSL Terenkripsi
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>
</html>