<!-- Professional Navbar Component -->
<nav id="main-nav" class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <span class="text-2xl font-bold text-green-600 group-hover:text-green-700 transition-colors">
                        PT Lestari Jaya Bangsa
                    </span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" id="mobile-menu-button" 
                        class="text-gray-700 hover:text-green-600 focus:outline-none focus:text-green-600 transition-colors"
                        aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" 
                   class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'text-green-600 font-semibold border-b-2 border-green-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('products.index') }}" 
                   class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request()->routeIs('products.*') ? 'text-green-600 font-semibold border-b-2 border-green-600' : '' }}">
                    Products
                </a>
                <a href="{{ route('about') }}" 
                   class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'text-green-600 font-semibold border-b-2 border-green-600' : '' }}">
                    About
                </a>
                <a href="{{ route('articles.index') }}" 
                   class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request()->routeIs('articles.*') ? 'text-green-600 font-semibold border-b-2 border-green-600' : '' }}">
                    Articles
                </a>
                <a href="{{ route('contact') }}" 
                   class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'text-green-600 font-semibold border-b-2 border-green-600' : '' }}">
                    Contact
                </a>
            </div>

            <!-- Desktop Auth Button -->
            <div class="hidden md:flex items-center">
                @auth
                <a href="{{ route('admin.dashboard') }}" 
                   class="btn-gradient text-white px-4 py-2 rounded-md text-sm font-medium shadow-md">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" 
                   class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Login
                </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 animate-fade-in">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 transition-colors {{ request()->routeIs('home') ? 'text-green-600 bg-green-50' : '' }}">
                Home
            </a>
            <a href="{{ route('products.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 transition-colors {{ request()->routeIs('products.*') ? 'text-green-600 bg-green-50' : '' }}">
                Products
            </a>
            <a href="{{ route('about') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 transition-colors {{ request()->routeIs('about') ? 'text-green-600 bg-green-50' : '' }}">
                About
            </a>
            <a href="{{ route('articles.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 transition-colors {{ request()->routeIs('articles.*') ? 'text-green-600 bg-green-50' : '' }}">
                Articles
            </a>
            <a href="{{ route('contact') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 transition-colors {{ request()->routeIs('contact') ? 'text-green-600 bg-green-50' : '' }}">
                Contact
            </a>
            <div class="border-t border-gray-200 pt-2 mt-2">
                @auth
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium btn-gradient text-white text-center shadow-md">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 transition-colors">
                    Login
                </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

