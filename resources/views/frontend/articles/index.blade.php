<x-frontend-layout>
    <x-slot name="title">Articles & News - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">Stay updated with the latest news, insights, and articles about herbal products, health, and natural wellness from PT Lestari Jaya Bangsa.</x-slot>

    <!-- Page Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.1\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 font-heading animate-fade-in-up">Artikel & Berita</h1>
            <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto leading-relaxed">
                Dapatkan informasi terbaru, wawasan, dan konten edukatif tentang produk herbal,
                kesehatan, dan kesejahteraan alami dari PT Lestari Jaya Bangsa.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters and Search -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-10 reveal border border-gray-100">
            <form method="GET" action="{{ route('articles.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari Artikel
                            </span>
                        </label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari artikel berdasarkan judul, konten, atau tag..."
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all shadow-sm">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Kategori
                            </span>
                        </label>
                        <select id="category" 
                                name="category" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all shadow-sm bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                            class="flex-1 sm:flex-none btn-gradient text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Terapkan Filter
                        </span>
                    </button>

                    @if(request()->hasAny(['search', 'category']))
                        <a href="{{ route('articles.index') }}" 
                           class="flex-1 sm:flex-none bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition-colors font-semibold text-center shadow-md">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Hapus Filter
                            </span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Articles Grid -->
        @if(isset($articles) && $articles->count() > 0)
            <!-- Featured Article (First Article - Large) -->
            @if($articles->count() > 0)
            <div class="mb-12 reveal">
                @php $featuredArticle = $articles->first(); @endphp
                <article class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover group border border-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        <!-- Featured Image -->
                        <div class="relative overflow-hidden bg-gradient-to-br from-green-50 to-green-100 h-64 lg:h-auto">
                            @if($featuredArticle->featured_image ?? null)
                                <img src="{{ asset('storage/' . $featuredArticle->featured_image) }}" 
                                     alt="{{ $featuredArticle->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                     loading="eager">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-green-400 text-8xl">📰</span>
                                </div>
                            @endif
                            
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            
                            <!-- Category Badge -->
                            @if(isset($featuredArticle->category) && $featuredArticle->category)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        {{ $featuredArticle->category->name ?? 'News' }}
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Featured Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    ⭐ Featured
                                </span>
                            </div>
                        </div>

                        <!-- Featured Content -->
                        <div class="p-8 lg:p-10 flex flex-col justify-center">
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                @if(isset($featuredArticle->author) && $featuredArticle->author)
                                    <span class="font-medium text-gray-700">{{ $featuredArticle->author->name ?? 'Admin' }}</span>
                                    <span class="mx-2">•</span>
                                @endif
                                <time datetime="{{ ($featuredArticle->published_at ?? now())->toISOString() }}">
                                    {{ ($featuredArticle->published_at ?? now())->format('F d, Y') }}
                                </time>
                            </div>

                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 font-heading line-clamp-3 group-hover:text-green-600 transition-colors">
                                <a href="{{ route('articles.show', $featuredArticle->slug ?? $featuredArticle->id) }}">
                                    {{ $featuredArticle->title }}
                                </a>
                            </h2>

                            <p class="text-gray-600 text-lg mb-6 line-clamp-3 leading-relaxed">
                                {{ $featuredArticle->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($featuredArticle->content ?? ''), 200) }}
                            </p>

                            <!-- Tags -->
                            @if(isset($featuredArticle->tags) && is_array($featuredArticle->tags) && count($featuredArticle->tags) > 0)
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach(array_slice($featuredArticle->tags, 0, 4) as $tag)
                                        <a href="{{ route('articles.index', ['tag' => is_array($tag) ? ($tag['name'] ?? $tag) : ($tag->name ?? $tag)]) }}"
                                           class="inline-block bg-green-50 text-green-700 text-xs px-3 py-1.5 rounded-full hover:bg-green-100 transition-colors font-medium border border-green-200">
                                            #{{ is_array($tag) ? ($tag['name'] ?? $tag) : ($tag->name ?? $tag) }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('articles.show', $featuredArticle->slug ?? $featuredArticle->id) }}" 
                               class="inline-flex items-center btn-gradient text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105 w-fit">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @endif

            <!-- Regular Articles Grid -->
            @if($articles->count() > 1)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-8">
                @foreach($articles->skip(1) as $index => $article)
                <div class="reveal" 
                     style="animation-delay: {{ ($index % 6) * 100 }}ms;">
                    <x-card-article :article="$article" />
                </div>
                @endforeach
            </div>
            @endif

            <!-- Pagination -->
            @if(method_exists($articles, 'links'))
            <div class="flex justify-center mt-12 reveal">
                <div class="bg-white rounded-lg shadow-md p-4">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20 reveal">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-3 font-heading">Artikel Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto text-lg">
                    Coba sesuaikan kriteria pencarian Anda atau kembali lagi nanti untuk konten baru.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('articles.index') }}" 
                       class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold shadow-md inline-block transform hover:scale-105 transition-all duration-200">
                        Lihat Semua Artikel
                    </a>
                    <a href="{{ route('home') }}" 
                       class="border-2 border-green-600 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition-all duration-200 inline-block">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif

        <!-- Newsletter CTA -->
        <div class="mt-16 reveal">
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 md:p-12 text-center text-white shadow-xl">
                <h3 class="text-2xl md:text-3xl font-bold mb-4 font-heading">Dapatkan Update Terbaru</h3>
                <p class="text-lg mb-6 opacity-90 max-w-2xl mx-auto">
                    Berlangganan untuk mendapatkan artikel terbaru tentang kesehatan, produk herbal, dan tips kesejahteraan langsung ke inbox Anda.
                </p>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</x-frontend-layout>
