<x-frontend-layout>
    <x-slot name="title">Articles & News - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">Stay updated with the latest news, insights, and articles about herbal products, health, and natural wellness from PT Lestari Jaya Bangsa.</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Articles & News</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Stay informed with our latest insights, news, and educational content
                about herbal products, health, and natural wellness.
            </p>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('articles.index') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search articles..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>

                <!-- Category Filter -->
                <div class="md:w-48">
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'category']))
                    <a href="{{ route('articles.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Articles Grid -->
        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($articles as $article)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    @if($article->featured_image)
                        <img src="{{ asset('uploads/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif

                    <div class="p-6">
                        @if($article->category)
                            <div class="text-sm text-green-600 font-medium mb-2">{{ $article->category->name }}</div>
                        @endif

                        <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                            <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-green-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center">
                                @if($article->author)
                                    <span>By {{ $article->author->name }}</span>
                                @endif
                                <span class="mx-2">•</span>
                                <span>{{ $article->published_at->format('M d, Y') }}</span>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-green-600 hover:text-green-700 font-medium">
                                Read More →
                            </a>
                        </div>

                        <!-- Tags -->
                        @if($article->tags->count() > 0)
                            <div class="flex flex-wrap gap-1 mt-3">
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('articles.index', ['tag' => $tag->name]) }}"
                                       class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full hover:bg-gray-200 transition-colors">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No articles found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your search criteria or check back later for new content.</p>
                <a href="{{ route('articles.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    View All Articles
                </a>
            </div>
        @endif
    </div>
</x-frontend-layout>