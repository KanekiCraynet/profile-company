@props(['article'])

<!-- Article Card Component -->
<article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover group border border-gray-100 h-full flex flex-col">
    <div class="relative overflow-hidden">
        @if($article->featured_image ?? null)
            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                 alt="{{ $article->title }}" 
                 class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700" 
                 loading="lazy">
        @else
            <div class="w-full h-56 bg-gradient-to-br from-green-50 via-green-100 to-green-50 flex items-center justify-center relative">
                <span class="text-green-400 text-6xl">📰</span>
                <div class="absolute inset-0 bg-gradient-to-t from-white/50 to-transparent"></div>
            </div>
        @endif
        
        <!-- Gradient Overlay on Hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        @if(isset($article->category) && $article->category)
            <div class="absolute top-4 left-4 z-10">
                <span class="bg-green-600 text-white px-3 py-1.5 rounded-full text-xs font-semibold shadow-lg backdrop-blur-sm">
                    {{ $article->category->name ?? 'News' }}
                </span>
            </div>
        @endif
        
        <!-- Reading Time Estimate -->
        @php
            $content = strip_tags($article->content ?? '');
            $wordCount = str_word_count($content);
            $readingTime = max(1, ceil($wordCount / 200));
        @endphp
        <div class="absolute top-4 right-4 z-10">
            <span class="bg-black/60 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-xs font-medium">
                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $readingTime }} min
            </span>
        </div>
    </div>

    <div class="p-6 flex-1 flex flex-col">
        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-green-600 transition-colors font-heading">
            <a href="{{ route('articles.show', $article->slug ?? $article->id) }}" class="hover:underline">
                {{ $article->title }}
            </a>
        </h2>

        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed flex-grow">
            {{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content ?? ''), 120) }}
        </p>

        <!-- Tags -->
        @if(isset($article->tags) && is_array($article->tags) && count($article->tags) > 0)
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach(array_slice($article->tags, 0, 3) as $tag)
                    <a href="{{ route('articles.index', ['tag' => is_array($tag) ? ($tag['name'] ?? $tag) : ($tag->name ?? $tag)]) }}"
                       class="inline-block bg-green-50 text-green-700 text-xs px-2.5 py-1 rounded-full hover:bg-green-100 transition-colors font-medium border border-green-200">
                        #{{ is_array($tag) ? ($tag['name'] ?? $tag) : ($tag->name ?? $tag) }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="flex items-center justify-between text-sm pt-4 border-t border-gray-100 mt-auto">
            <div class="flex items-center space-x-2 text-gray-500">
                @if(isset($article->author) && $article->author)
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium text-gray-700">{{ $article->author->name ?? 'Admin' }}</span>
                    </div>
                    <span class="text-gray-300">•</span>
                @endif
                <time datetime="{{ ($article->published_at ?? now())->toISOString() }}" class="flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ ($article->published_at ?? now())->format('M d, Y') }}
                </time>
            </div>
            <a href="{{ route('articles.show', $article->slug ?? $article->id) }}" 
               class="text-green-600 hover:text-green-700 font-semibold transition-colors flex items-center group/link">
                <span>Baca</span>
                <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>

