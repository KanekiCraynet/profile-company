<nav id="navbar" 
     x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 50"
     :class="scrolled ? 'navbar-scrolled shadow-lg' : ''"
     class="fixed top-0 left-0 right-0 bg-white/95 dark:bg-neutral-900/95 backdrop-blur-lg border-b border-neutral-200/50 dark:border-neutral-800/50 z-50 transition-all duration-300">
    <div class="container-custom">
        <div class="flex justify-between items-center h-16 md:h-20 transition-all duration-300">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group" aria-label="PT Lestari Jaya Bangsa Home">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300 shadow-lg group-hover:shadow-primary-500/50">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <span class="text-lg md:text-xl font-heading font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent hidden sm:block">
                        PT Lestari Jaya Bangsa
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}">
                    Beranda
                </a>
                <a href="{{ route('products.index') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}">
                    Produk
                </a>
                <a href="{{ route('about') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}">
                    Tentang
                </a>
                <a href="{{ route('articles.index') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('articles.*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}">
                    Artikel
                </a>
                <a href="{{ route('contact') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}">
                    Kontak
                </a>
            </div>

            <!-- Auth & Mobile Menu Button -->
            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="hidden md:block btn btn-primary text-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="hidden md:block btn btn-outline text-sm">
                        Login
                    </a>
                @endauth

                <!-- Mobile menu button -->
                <button @click="open = !open" 
                        class="lg:hidden p-2 rounded-lg text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        aria-label="Toggle menu"
                        aria-expanded="false"
                        :aria-expanded="open">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="lg:hidden py-4 border-t border-neutral-200 dark:border-neutral-800">
            <div class="flex flex-col space-y-1">
                <a href="{{ route('home') }}" 
                   class="px-4 py-3 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}"
                   @click="open = false">
                    Beranda
                </a>
                <a href="{{ route('products.index') }}" 
                   class="px-4 py-3 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}"
                   @click="open = false">
                    Produk
                </a>
                <a href="{{ route('about') }}" 
                   class="px-4 py-3 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}"
                   @click="open = false">
                    Tentang
                </a>
                <a href="{{ route('articles.index') }}" 
                   class="px-4 py-3 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('articles.*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}"
                   @click="open = false">
                    Artikel
                </a>
                <a href="{{ route('contact') }}" 
                   class="px-4 py-3 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/20 dark:text-primary-400 font-semibold' : 'text-neutral-700 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400' }}"
                   @click="open = false">
                    Kontak
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-4 py-3 rounded-lg text-base font-medium btn-primary text-center mt-2"
                       @click="open = false">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-4 py-3 rounded-lg text-base font-medium btn-outline text-center mt-2"
                       @click="open = false">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    [x-cloak] { display: none !important; }
</style>
