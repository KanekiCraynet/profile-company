<x-frontend-layout>
    <x-slot name="title">PT Lestari Jaya Bangsa - Food & Herbal Products</x-slot>
    <x-slot name="metaDescription">PT Lestari Jaya Bangsa provides high-quality herbal and processed food products, committed to prioritizing both health and taste.</x-slot>

    <!-- Hero Section -->
    <section class="hero-bg text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    PT Lestari Jaya Bangsa
                </h1>
                <p class="text-xl md:text-2xl mb-4 opacity-90">
                    Food & Herbal — Health and Flavour, United in One Choice
                </p>
                <p class="text-lg mb-8 max-w-3xl mx-auto opacity-80">
                    Providing high-quality herbal and processed food products, committed to prioritizing both health and taste.
                    With experience and innovation, the company continues to earn consumer trust while expanding towards the global market.
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

    <!-- Certifications Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Certifications</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We maintain the highest standards of quality and safety in all our products
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="certification-badge text-white p-8 rounded-lg text-center">
                    <div class="text-4xl mb-4">🕌</div>
                    <h3 class="text-xl font-semibold mb-2">Halal MUI Certified</h3>
                    <p class="opacity-90">All our products meet Islamic dietary requirements</p>
                </div>

                <div class="certification-badge text-white p-8 rounded-lg text-center">
                    <div class="text-4xl mb-4">🏥</div>
                    <h3 class="text-xl font-semibold mb-2">BPOM Approved</h3>
                    <p class="opacity-90">Registered and approved by Indonesian FDA</p>
                </div>

                <div class="certification-badge text-white p-8 rounded-lg text-center">
                    <div class="text-4xl mb-4">🌿</div>
                    <h3 class="text-xl font-semibold mb-2">100% Natural</h3>
                    <p class="opacity-90">Made with natural ingredients only</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    @if($featuredProducts->count() > 0)
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
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-green-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700">
                    View All Products
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest Articles Section -->
    @if($latestArticles->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Articles</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Stay informed with our latest news and insights
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                <article class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                    @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover" loading="lazy">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center">
                            <span class="text-green-400 text-4xl">📰</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="text-sm text-green-600 mb-2">{{ $article->category->name ?? 'Uncategorized' }}</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $article->published_at?->format('M d, Y') ?? 'Not published' }}</span>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-green-600 hover:text-green-700 font-medium">
                                Read More →
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="text-center mt-8">
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