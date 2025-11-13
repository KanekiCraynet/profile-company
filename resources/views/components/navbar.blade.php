<nav 
    x-data="{ scrolled: false, mobileMenuOpen: false }"
    @scroll.window="scrolled = window.scrollY > 20"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-white'"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <span class="text-xl md:text-2xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">
                        PT Lestari Jaya Bangsa
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }}">
                    Home
                </a>
                <a href="{{ route('products.index') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('products.*') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }}">
                    Products
                </a>
                <a href="{{ route('about') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }}">
                    About
                </a>
                <a href="{{ route('articles.index') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('articles.*') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }}">
                    Articles
                </a>
                <a href="{{ route('contact') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }}">
                    Contact
                </a>
            </div>

            <!-- Desktop Auth Button -->
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg text-sm font-semibold hover:from-green-700 hover:to-green-800 shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-5 py-2.5 border-2 border-green-600 text-green-600 rounded-lg text-sm font-semibold hover:bg-green-600 hover:text-white transition-all duration-200">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center space-x-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 bg-green-600 text-white rounded-lg text-xs font-semibold hover:bg-green-700 transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-3 py-2 border border-green-600 text-green-600 rounded-lg text-xs font-semibold hover:bg-green-50 transition-colors">
                        Login
                    </a>
                @endauth
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button" 
                    class="p-2 rounded-lg text-gray-700 hover:text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors"
                    aria-label="Toggle menu"
                >
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div 
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t border-gray-200 bg-white"
        style="display: none;"
    >
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'text-green-600 bg-green-50' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }} transition-colors">
                Home
            </a>
            <a href="{{ route('products.index') }}" 
               class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('products.*') ? 'text-green-600 bg-green-50' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }} transition-colors">
                Products
            </a>
            <a href="{{ route('about') }}" 
               class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('about') ? 'text-green-600 bg-green-50' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }} transition-colors">
                About
            </a>
            <a href="{{ route('articles.index') }}" 
               class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('articles.*') ? 'text-green-600 bg-green-50' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }} transition-colors">
                Articles
            </a>
            <a href="{{ route('contact') }}" 
               class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('contact') ? 'text-green-600 bg-green-50' : 'text-gray-700 hover:text-green-600 hover:bg-green-50' }} transition-colors">
                Contact
            </a>
        </div>
    </div>
</nav>
