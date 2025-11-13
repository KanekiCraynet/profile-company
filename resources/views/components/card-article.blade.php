@props(['article'])

<a href="{{ route('articles.show', $article->slug) }}" 
   class="group block bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
    <!-- Article Image -->
    <div class="relative h-48 bg-gray-100 overflow-hidden">
        @if($article->featured_image)
            <img src="{{ $article->featured_image }}" 
                 alt="{{ $article->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-green-100">
                <svg class="w-16 h-16 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        @endif
    </div>
    
    <!-- Article Info -->
    <div class="p-6">
        <!-- Date & Author -->
        <div class="flex items-center text-xs text-gray-500 mb-3">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                {{ $article->created_at->format('d M Y') }}
            </time>
            <span class="mx-2">•</span>
            <span>{{ $article->author ?? 'Admin' }}</span>
        </div>
        
        <!-- Title -->
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors line-clamp-2">
            {{ $article->title }}
        </h3>
        
        <!-- Excerpt -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
            {{ Str::limit($article->excerpt ?? strip_tags($article->content), 120) }}
        </p>
        
        <!-- Read More -->
        <div class="flex items-center text-green-600 font-medium text-sm group-hover:text-green-700">
            <span>Baca Selengkapnya</span>
            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>
</a>
