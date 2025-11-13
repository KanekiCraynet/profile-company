<nav id="navbar"
     x-data="{
         open: false,
         scrolled: false
     }"
     x-init="
         scrolled = window.pageYOffset > 50;
         window.addEventListener('scroll', () => {
             scrolled = window.pageYOffset > 50;
         }, { passive: true });
     "
     :class="scrolled ? 'bg-white/98 shadow-lg' : 'bg-white/80'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-primary-600">
                    PT Lestari Jaya Bangsa
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-neutral-700 hover:text-primary-600 transition">Beranda</a>
                <a href="{{ route('products.index') }}" class="text-neutral-700 hover:text-primary-600 transition">Produk</a>
                <a href="{{ route('about') }}" class="text-neutral-700 hover:text-primary-600 transition">Tentang</a>
                <a href="{{ route('articles.index') }}" class="text-neutral-700 hover:text-primary-600 transition">Artikel</a>
                <a href="{{ route('contact') }}" class="text-neutral-700 hover:text-primary-600 transition">Kontak</a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open"
                    class="lg:hidden p-2 rounded-lg bg-primary-600 text-white"
                    :aria-expanded="open.toString()">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden py-4 border-t">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="text-neutral-700 hover:text-primary-600 transition" @click="open = false">Beranda</a>
                <a href="{{ route('products.index') }}" class="text-neutral-700 hover:text-primary-600 transition" @click="open = false">Produk</a>
                <a href="{{ route('about') }}" class="text-neutral-700 hover:text-primary-600 transition" @click="open = false">Tentang</a>
                <a href="{{ route('articles.index') }}" class="text-neutral-700 hover:text-primary-600 transition" @click="open = false">Artikel</a>
                <a href="{{ route('contact') }}" class="text-neutral-700 hover:text-primary-600 transition" @click="open = false">Kontak</a>
            </div>
        </div>
    </div>
</nav>

<style>
    [x-cloak] { display: none !important; }
</style>