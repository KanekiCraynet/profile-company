<x-frontend-layout>
    <x-slot name="title">{{ $seoTitle ?? 'PT Lestari Jaya Bangsa' }}</x-slot>
    <x-slot name="metaDescription">{{ $seoDescription ?? 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products.' }}</x-slot>

    <!-- Hero Section -->
    <section class="hero-bg text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    {{ $companyName ?? 'PT Lestari Jaya Bangsa' }}
                </h1>
                <p class="text-xl md:text-2xl mb-4 opacity-90">
                    {{ $companyTagline ?? 'Food & Herbal — Health and Taste in One Choice' }}
                </p>
                <p class="text-lg mb-8 max-w-3xl mx-auto opacity-80">
                    {{ $companyDescription ?? 'PT Lestari Jaya Bangsa delivers premium herbal and processed food products, combining health and taste in every creation.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Explore Products
                    </a>
                    <a href="{{ route('about') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Products</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Discover our most popular herbal and food products
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                        @if($product->getFirstMediaUrl('images'))
                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description ?? '', 100) }}</p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($product->is_halal_certified)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Halal MUI
                            </span>
                            @endif
                            @if($product->is_bpom_certified)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                BPOM
                            </span>
                            @endif
                            @if($product->is_natural)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Natural
                            </span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            @if($product->price)
                            <span class="text-2xl font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @else
                            <span class="text-gray-500">Price on request</span>
                            @endif
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700">
                    View All Products
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest Articles Section -->
    @if(isset($latestArticles) && $latestArticles->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Articles</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Stay informed with our latest news and insights
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    @if($article->featured_image)
                    <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-green-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        <div class="flex items-center text-sm text-gray-500">
                            @if($article->published_at)
                            <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                {{ $article->published_at->format('M j, Y') }}
                            </time>
                            @endif
                            @if($article->author)
                            <span class="mx-2">•</span>
                            <span>{{ $article->author->name }}</span>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('articles.index') }}" class="border-2 border-green-600 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-600 hover:text-white transition-colors">
                    View All Articles
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-green-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Experience Quality?</h2>
            <p class="text-xl mb-8 opacity-90">
                Contact us today to learn more about our products and services
            </p>
            <a href="{{ route('contact') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Get In Touch
            </a>
        </div>
    </section>
</x-frontend-layout>