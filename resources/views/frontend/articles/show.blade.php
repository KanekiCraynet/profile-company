<x-frontend-layout>
    <x-slot name="title">{{ $article->title }} - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">{{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 160) }}</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-green-600 ml-1 md:ml-2">Articles</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-gray-500 ml-1 md:ml-2">{{ \Illuminate\Support\Str::limit($article->title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Article Header -->
        <header class="mb-8">
            @if($article->category)
                <div class="text-green-600 font-medium mb-2">{{ $article->category->name }}</div>
            @endif

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

            @if($article->excerpt)
                <p class="text-xl text-gray-600 mb-6">{{ $article->excerpt }}</p>
            @endif

            <div class="flex items-center text-sm text-gray-500 border-b border-gray-200 pb-6">
                @if($article->author)
                    <span class="font-medium text-gray-900">{{ $article->author->name }}</span>
                    <span class="mx-2">•</span>
                @endif
                <time datetime="{{ $article->published_at->toISOString() }}">
                    {{ $article->published_at->format('F d, Y') }}
                </time>
                @if($article->tags && count($article->tags) > 0)
                    <span class="mx-2">•</span>
                    <div class="flex gap-1 flex-wrap">
                        @foreach($article->tags as $tag)
                            <a href="{{ route('articles.index', ['tag' => is_array($tag) ? $tag['name'] : $tag->name ?? $tag]) }}"
                               class="text-green-600 hover:text-green-700">#{{ is_array($tag) ? $tag['name'] : $tag->name ?? $tag }}</a>
                            @if(!$loop->last)
                                <span>,</span>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </header>

        <!-- Featured Image -->
        @if($article->featured_image)
            <div class="mb-8">
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full rounded-lg shadow-md" loading="lazy">
            </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg prose-gray max-w-none mb-12">
            {!! $article->content !!}
        </div>

        <!-- Share Buttons -->
        <div class="border-t border-gray-200 pt-6 mb-12">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h3>
            <div class="flex gap-4">
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(route('articles.show', $article->slug)) }}"
                   target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                    Twitter
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article->slug)) }}"
                   target="_blank" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors">
                    Facebook
                </a>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . route('articles.show', $article->slug)) }}"
                   target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                    WhatsApp
                </a>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
        <div class="border-t border-gray-200 pt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $relatedArticle)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    @if($relatedArticle->featured_image)
                        <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}" alt="{{ $relatedArticle->title }}" class="w-full h-32 object-cover" loading="lazy">
                    @else
                        <div class="w-full h-32 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center">
                            <span class="text-green-400 text-2xl">📰</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2">
                            <a href="{{ route('articles.show', $relatedArticle->slug) }}" class="hover:text-green-600 transition-colors">
                                {{ $relatedArticle->title }}
                            </a>
                        </h4>
                        <div class="text-xs text-gray-500">
                            {{ $relatedArticle->published_at->format('M d, Y') }}
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back to Articles -->
        <div class="text-center mt-12">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Articles
            </a>
        </div>
    </div>
</x-frontend-layout>