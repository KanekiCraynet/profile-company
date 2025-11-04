<x-frontend-layout>
    <x-slot name="title">Beranda - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">PT Lestari Jaya Bangsa menyediakan produk herbal dan makanan olahan berkualitas tinggi, berkomitmen memprioritaskan kesehatan dan rasa. Berdiri sejak 1992.</x-slot>

    <!-- Hero Section -->
    <section class="relative min-h-[600px] md:min-h-[700px] flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <!-- Background Image Overlay (optional) -->
        <div class="absolute inset-0 bg-black/20"></div>
        
        <div class="container-custom relative z-10 py-20 md:py-32">
            <div class="text-center max-w-4xl mx-auto animate-fade-in-up">
                <div class="inline-block mb-6">
                    <span class="badge badge-primary text-sm px-4 py-2 bg-white/20 text-white border border-white/30">
                        Berdiri Sejak 1992
                    </span>
                </div>
                <h1 class="heading-primary text-white mb-6 text-shadow">
                    Kesehatan dan Rasa,<br>
                    <span class="bg-gradient-to-r from-white to-primary-100 bg-clip-text text-transparent">
                        Dalam Satu Pilihan.
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-4 max-w-2xl mx-auto leading-relaxed">
                    Food & Herbal — Menyediakan produk herbal dan makanan olahan berkualitas tinggi
                </p>
                <p class="text-lg text-white/80 mb-10 max-w-3xl mx-auto leading-relaxed">
                    Berkomitmen memprioritaskan kesehatan dan rasa. Dengan pengalaman dan inovasi, perusahaan terus meraih kepercayaan konsumen sambil memperluas jangkauan ke pasar global.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary bg-white text-primary-700 hover:bg-primary-50 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                        <span>Lihat Produk Kami</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline border-2 border-white text-white hover:bg-white hover:text-primary-700 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="section bg-white dark:bg-neutral-50">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-300"></div>
                    <div class="relative bg-neutral-200 dark:bg-neutral-800 rounded-2xl overflow-hidden aspect-[4/3] shadow-xl">
                        <!-- Placeholder for company image -->
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20">
                            <svg class="w-24 h-24 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="animate-fade-in-right">
                    <div class="inline-block mb-4">
                        <span class="badge badge-primary text-sm">Tentang Kami</span>
                    </div>
                    <h2 class="heading-secondary text-neutral-900 dark:text-neutral-100 mb-6">
                        Profil Perusahaan
                    </h2>
                    <p class="text-body mb-6">
                        PT Lestari Jaya Bangsa adalah perusahaan yang bergerak di bidang Food & Herbal, dengan komitmen untuk menyediakan produk berkualitas tinggi yang memprioritaskan kesehatan dan rasa. Sejak didirikan pada tahun 1992, kami telah mengembangkan berbagai produk herbal dan makanan olahan yang telah mendapatkan kepercayaan dari konsumen.
                    </p>
                    <p class="text-body mb-8">
                        Dengan pengalaman lebih dari 30 tahun, kami terus berinovasi dan meningkatkan kualitas produk sambil memperluas jangkauan pasar, baik nasional maupun internasional.
                    </p>
                    <a href="{{ route('about') }}" class="btn btn-primary">
                        Selengkapnya
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="section bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20">
        <div class="container-custom">
            <div class="text-center mb-12 animate-fade-in-up">
                <h2 class="heading-secondary text-neutral-900 dark:text-neutral-100 mb-4">
                    Sertifikasi & Kepercayaan
                </h2>
                <p class="text-body max-w-2xl mx-auto">
                    Kami menjaga standar kualitas dan keamanan tertinggi dalam semua produk kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Halal Certification -->
                <div class="card-premium text-center p-8 hover-lift animate-fade-in-up float-delay-1">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                        🕌
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-neutral-900 dark:text-neutral-100 mb-3">
                        Halal MUI Certified
                    </h3>
                    <p class="text-neutral-600 dark:text-neutral-400">
                        Semua produk kami memenuhi persyaratan diet Islam
                    </p>
                </div>

                <!-- BPOM Certification -->
                <div class="card-premium text-center p-8 hover-lift animate-fade-in-up float-delay-2">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                        🏥
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-neutral-900 dark:text-neutral-100 mb-3">
                        BPOM Approved
                    </h3>
                    <p class="text-neutral-600 dark:text-neutral-400">
                        Terdaftar dan disetujui oleh Badan Pengawas Obat dan Makanan Indonesia
                    </p>
                </div>

                <!-- Natural Ingredients -->
                <div class="card-premium text-center p-8 hover-lift animate-fade-in-up float-delay-3">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                        🌿
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-neutral-900 dark:text-neutral-100 mb-3">
                        100% Alami
                    </h3>
                    <p class="text-neutral-600 dark:text-neutral-400">
                        Dibuat dengan bahan-bahan alami berkualitas tinggi
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Highlight Section -->
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section class="section bg-white dark:bg-neutral-50">
        <div class="container-custom">
            <div class="text-center mb-12 animate-fade-in-up">
                <h2 class="heading-secondary text-neutral-900 dark:text-neutral-100 mb-4">
                    Produk Unggulan
                </h2>
                <p class="text-body max-w-2xl mx-auto">
                    Temukan produk herbal dan makanan olahan terpopuler kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $index => $product)
                    <div class="animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <x-card-product :product="$product" />
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Lihat Semua Produk
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest Articles Section -->
    @if(isset($latestArticles) && $latestArticles->count() > 0)
    <section class="section bg-neutral-50 dark:bg-neutral-900">
        <div class="container-custom">
            <div class="text-center mb-12 animate-fade-in-up">
                <h2 class="heading-secondary text-neutral-900 dark:text-neutral-100 mb-4">
                    Artikel Terbaru
                </h2>
                <p class="text-body max-w-2xl mx-auto">
                    Tetap terinformasi dengan berita dan insight terbaru kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $index => $article)
                    <div class="animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <x-card-article :article="$article" />
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('articles.index') }}" class="btn btn-outline">
                    Lihat Semua Artikel
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="section bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="container-custom relative z-10 text-center">
            <h2 class="heading-secondary text-white mb-4">
                Siap Merasakan Kualitas?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Hubungi kami hari ini untuk mempelajari lebih lanjut tentang produk dan layanan kami
            </p>
            <a href="{{ route('contact') }}" class="btn bg-white text-primary-700 hover:bg-primary-50 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                Hubungi Kami
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>
</x-frontend-layout>
