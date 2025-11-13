<x-frontend-layout>
    <x-slot name="title">PT Lestari Jaya Bangsa - Food & Herbal Products</x-slot>
    <x-slot name="metaDescription">PT Lestari Jaya Bangsa provides high-quality herbal and processed food products, committed to prioritizing both health and taste. Established since 1992.</x-slot>

    <!-- Hero Section -->
    <section class="hero-bg text-white relative py-20 md:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <!-- Decorative pattern background -->
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.1\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 font-heading leading-tight">
                    Kesehatan dan Rasa,<br class="hidden md:block">
                    <span class="text-green-100">Dalam Satu Pilihan.</span>
                </h1>
                <p class="text-xl md:text-2xl mb-4 opacity-90 max-w-3xl mx-auto">
                    Food & Herbal — Health and Flavour, United in One Choice
                </p>
                <p class="text-lg mb-8 max-w-3xl mx-auto opacity-80 leading-relaxed">
                    PT Lestari Jaya Bangsa menyediakan produk herbal dan makanan olahan berkualitas tinggi,
                    berkomitmen memprioritaskan kesehatan dan rasa. Berdiri sejak 1992, kami terus meraih kepercayaan konsumen
                    sambil berkembang menuju pasar global.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <a href="{{ route('products.index') }}" 
                       class="bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Lihat Produk Kami
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition-all duration-200 transform hover:scale-105">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-heading">Sertifikasi Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Kami menjaga standar kualitas dan keamanan tertinggi dalam semua produk kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="certification-badge text-white p-8 rounded-lg text-center reveal card-hover transform transition-all duration-300 hover:scale-105">
                    <div class="text-5xl mb-4">🕌</div>
                    <h3 class="text-xl font-semibold mb-2 font-heading">Halal MUI Certified</h3>
                    <p class="opacity-90">Semua produk kami memenuhi persyaratan makanan halal</p>
                </div>

                <div class="certification-badge text-white p-8 rounded-lg text-center reveal card-hover transform transition-all duration-300 hover:scale-105">
                    <div class="text-5xl mb-4">🏥</div>
                    <h3 class="text-xl font-semibold mb-2 font-heading">BPOM Approved</h3>
                    <p class="opacity-90">Terdaftar dan disetujui oleh Badan Pengawas Obat dan Makanan</p>
                </div>

                <div class="certification-badge text-white p-8 rounded-lg text-center reveal card-hover transform transition-all duration-300 hover:scale-105">
                    <div class="text-5xl mb-4">🌿</div>
                    <h3 class="text-xl font-semibold mb-2 font-heading">100% Natural</h3>
                    <p class="opacity-90">Dibuat dengan bahan-bahan alami saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="reveal">
                    <div class="relative">
                        <div class="w-full h-80 bg-gradient-to-br from-green-100 to-green-200 rounded-lg overflow-hidden shadow-lg">
                            <!-- Placeholder for factory/team image -->
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">🏭</div>
                                    <p class="text-gray-600">Foto Pabrik / Tim</p>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative element -->
                        <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-green-600 rounded-full opacity-20 blur-3xl"></div>
                    </div>
                </div>
                <div class="reveal">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-heading">
                        Tentang PT Lestari Jaya Bangsa
                    </h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p class="text-lg">
                            Berdiri sejak <strong class="text-green-600">1992</strong>, PT Lestari Jaya Bangsa telah menjadi
                            pelopor dalam industri produk herbal dan makanan olahan berkualitas tinggi.
                        </p>
                        <p>
                            Dengan pengalaman lebih dari 30 tahun, kami berkomitmen untuk menyediakan produk yang
                            memprioritaskan kesehatan dan rasa, menggunakan bahan-bahan alami terpilih dan proses produksi
                            yang memenuhi standar internasional.
                        </p>
                        <p>
                            Setiap produk kami telah melalui proses sertifikasi ketat untuk memastikan kualitas, keamanan,
                            dan kepatuhan terhadap standar halal dan BPOM.
                        </p>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('about') }}" 
                           class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                            Selengkapnya
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-heading">Produk Unggulan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Temukan produk herbal dan makanan olahan terpopuler kami
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($featuredProducts->take(6) as $product)
                <div class="reveal">
                    <x-card-product :product="$product" />
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route('products.index') }}" 
                   class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold shadow-md inline-block">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Parallax Banner Section -->
    <section class="parallax-section py-20 bg-gradient-to-r from-green-600 to-green-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"100\" height=\"100\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M0 0h100v100H0z\" fill=\"%23ffffff\" fill-opacity=\"0.05\"/><path d=\"M25 25h50v50H25z\" fill=\"none\" stroke=\"%23ffffff\" stroke-width=\"1\" stroke-opacity=\"0.1\"/></svg>');"></div>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 font-heading">
                Kualitas Terpercaya Sejak 1992
            </h2>
            <p class="text-xl mb-8 opacity-90 leading-relaxed">
                Dengan lebih dari 30 tahun pengalaman, kami terus berinovasi untuk memberikan
                produk herbal dan makanan olahan terbaik bagi kesehatan dan kesejahteraan Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('about') }}" 
                   class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    @if(isset($latestArticles) && $latestArticles->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-heading">Artikel & Berita Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Dapatkan informasi terbaru tentang produk kami, tips kesehatan, dan berita dari perusahaan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @foreach($latestArticles->take(3) as $article)
                <div class="reveal">
                    <x-card-article :article="$article" />
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route('articles.index') }}" 
                   class="border-2 border-green-600 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-600 hover:text-white transition-all duration-200 inline-block">
                    Lihat Semua Artikel
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-heading">
                    Siap Merasakan Kualitas Produk Kami?
                </h2>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Hubungi kami hari ini untuk mempelajari lebih lanjut tentang produk dan layanan kami.
                    Tim kami siap membantu Anda menemukan solusi terbaik untuk kebutuhan kesehatan Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" 
                       class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold shadow-md inline-block transform hover:scale-105 transition-all duration-200">
                        Hubungi Kami
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="border-2 border-green-600 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-600 hover:text-white transition-all duration-200 inline-block">
                        Jelajahi Produk
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
