@props(['article'])

<article class="card card-hover group overflow-hidden h-full flex flex-col">
    <!-- Article Image -->
    <div class="relative overflow-hidden bg-neutral-100 dark:bg-neutral-800 aspect-video">
        @if($article->featured_image)
            <img 
                src="{{ asset('storage/' . $article->featured_image) }}" 
                alt="{{ $article->title }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20">
                <svg class="w-16 h-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        @endif
        
        <!-- Category Badge -->
        @if($article->category)
            <div class="absolute top-3 left-3">
                <span class="badge badge-primary text-xs px-3 py-1">
                    {{ $article->category->name }}
                </span>
            </div>
        @endif
        
        <!-- Date Badge -->
        @if($article->published_at)
            <div class="absolute top-3 right-3">
                <span class="badge bg-white/90 dark:bg-neutral-800/90 text-neutral-700 dark:text-neutral-300 text-xs px-3 py-1">
                    {{ $article->published_at->format('d M Y') }}
                </span>
            </div>
        @endif
    </div>
    
    <!-- Article Content -->
    <div class="p-6 flex-grow flex flex-col">
        <h3 class="text-xl font-heading font-semibold text-neutral-900 dark:text-neutral-100 mb-3 line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
            <a href="{{ route('articles.show', $article->slug) }}">
                {{ $article->title }}
            </a>
        </h3>
        
        @if($article->excerpt || $article->content)
            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-4 line-clamp-3 flex-grow">
                {{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
            </p>
        @endif
        
        <div class="flex items-center justify-between mt-auto pt-4 border-t border-neutral-200 dark:border-neutral-700">
            <div class="flex items-center space-x-2 text-xs text-neutral-500 dark:text-neutral-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <span>{{ $article->view_count ?? 0 }} views</span>
            </div>
            
            <a href="{{ route('articles.show', $article->slug) }}" 
               class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium text-sm flex items-center group/link">
                Baca Selengkapnya
                <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</article>

