<x-frontend-layout>
    <x-slot name="title">Products - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">Explore our range of high-quality herbal and processed food products. All products are BPOM certified and Halal MUI approved.</x-slot>
    <x-slot name="metaKeywords">herbal products, food products, natural ingredients, BPOM certified, Halal MUI, PT Lestari Jaya Bangsa</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Products</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover our comprehensive range of herbal and processed food products,
                all made with natural ingredients and certified for quality and safety.
            </p>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search products..."
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

                <!-- Sort -->
                <div class="md:w-48">
                    <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="name" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                        @if($product->getFirstMediaUrl('images'))
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover" loading="lazy">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>

                        <!-- Certifications -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            @if($product->is_halal_certified)
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Halal MUI</span>
                            @endif
                            @if($product->is_bpom_certified)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">BPOM</span>
                            @endif
                            @if($product->is_natural)
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">100% Natural</span>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            @if($product->price)
                                <span class="text-green-600 font-semibold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-gray-500 text-sm">Contact for price</span>
                            @endif
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No products found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your search criteria or browse all products.</p>
                <a href="{{ route('products.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    View All Products
                </a>
            </div>
        @endif
    </div>
</x-frontend-layout>