<x-layouts.app>
    @section('title', ($article->title ?? 'Artikel') . ' - PT Lestari Jaya Bangsa')
    
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('articles.index') }}" class="hover:text-green-600">Artikel</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium line-clamp-1">{{ $article->title ?? 'Detail Artikel' }}</span>
            </nav>
        </div>
    </section>

    <!-- Article Content -->
    <article class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <header class="mb-8">
                @if($article->featured_image ?? null)
                    <div class="rounded-2xl overflow-hidden shadow-xl mb-8">
                        <img src="{{ $article->featured_image }}" 
                             alt="{{ $article->title }}"
                             class="w-full h-auto object-cover">
                    </div>
                @endif
                
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                        {{ $article->created_at->format('d F Y') }}
                    </time>
                    <span class="mx-2">•</span>
                    <span>{{ $article->author ?? 'Admin' }}</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ $article->title ?? 'Judul Artikel' }}
                </h1>
                
                @if($article->excerpt ?? null)
                    <p class="text-xl text-gray-600 leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                @endif
            </header>
            
            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                <div class="text-gray-700 leading-relaxed">
                    {!! $article->content ?? 'Konten artikel tidak tersedia.' !!}
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <a href="{{ route('articles.index') }}" 
                   class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Berita
                </a>
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Artikel Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles->take(3) as $relatedArticle)
                        <x-card-article :article="$relatedArticle" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
