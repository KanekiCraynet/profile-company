<x-frontend-layout>
    <x-slot name="title">{{ $product->name }} - Products | PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">{{ Str::limit(strip_tags($product->description ?? ''), 160) }}</x-slot>

    <!-- Schema.org Product Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "{{ $product->name }}",
        "description": "{{ strip_tags($product->description ?? '') }}",
        @if($product->getFirstMediaUrl('images'))
        "image": "{{ $product->getFirstMediaUrl('images') }}",
        @endif
        @if($product->price)
        "offers": {
            "@type": "Offer",
            "price": "{{ $product->price }}",
            "priceCurrency": "IDR",
            "availability": "{{ $product->stock_quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
        },
        @endif
        "brand": {
            "@type": "Brand",
            "name": "PT Lestari Jaya Bangsa"
        },
        @if($product->category)
        "category": "{{ $product->category->name }}",
        @endif
        @if($product->is_halal_certified)
        "additionalProperty": [
            {
                "@type": "PropertyValue",
                "name": "Halal Certification",
                "value": "MUI Certified"
            }
        ],
        @endif
        "url": "{{ route('products.show', $product->slug) }}"
    }
    </script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-green-600 ml-1 md:ml-2">Products</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-gray-500 ml-1 md:ml-2">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div>
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden mb-4" id="main-image-container">
                    @if($product->getFirstMediaUrl('images'))
                        <img id="main-product-image" src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400 text-lg">No Image Available</span>
                        </div>
                    @endif
                </div>

                <!-- Additional Images Gallery -->
                @if($product->getMedia('images')->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->getMedia('images') as $index => $media)
                            <img src="{{ $media->getUrl() }}" 
                                 alt="{{ $product->name }} - Image {{ $index + 1 }}" 
                                 class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-80 border-2 {{ $index === 0 ? 'border-green-500' : 'border-transparent' }}"
                                 onclick="changeMainImage('{{ $media->getUrl() }}', this)"
                                 onmouseover="this.style.borderColor='#22c55e'"
                                 onmouseout="if(this !== document.querySelector('.border-green-500')) this.style.borderColor='transparent'">
                        @endforeach
                    </div>
                @endif
            </div>

            <script>
                function changeMainImage(imageUrl, thumbElement) {
                    document.getElementById('main-product-image').src = imageUrl;
                    // Update border on thumbnails
                    document.querySelectorAll('.grid img').forEach(img => {
                        img.classList.remove('border-green-500');
                        img.classList.add('border-transparent');
                    });
                    thumbElement.classList.remove('border-transparent');
                    thumbElement.classList.add('border-green-500');
                }
            </script>

            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                <!-- Certifications -->
                <div class="flex flex-wrap gap-2 mb-6">
                    @if($product->is_halal_certified)
                        <span class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            🕌 Halal MUI Certified
                        </span>
                    @endif
                    @if($product->is_bpom_certified)
                        <span class="inline-flex items-center bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            🏥 BPOM Approved
                        </span>
                    @endif
                    @if($product->is_natural)
                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                            🌿 100% Natural Ingredients
                        </span>
                    @endif
                </div>

                <!-- Price -->
                @if($product->price)
                <div class="text-3xl font-bold text-green-600 mb-6">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
                @else
                <div class="text-lg text-gray-600 mb-6">
                    <a href="{{ route('contact') }}" class="text-green-600 hover:text-green-700 underline">Contact us for pricing</a>
                </div>
                @endif

                <!-- Category -->
                @if($product->category)
                    <div class="mb-6">
                        <span class="text-sm text-gray-600">Category:</span>
                        <span class="text-sm font-medium text-gray-900 ml-2">{{ $product->category->name }}</span>
                    </div>
                @endif

                <!-- Description -->
                @if($product->description)
                <div class="prose prose-gray max-w-none mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Product Description</h3>
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($product->benefits)
                    <div class="bg-green-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Benefits</h3>
                        <div class="text-gray-700">
                            {!! nl2br(e($product->benefits)) !!}
                        </div>
                    </div>
                @endif

                <!-- Usage Instructions -->
                @if($product->usage_instructions)
                    <div class="bg-blue-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Usage Instructions</h3>
                        <div class="text-gray-700">
                            {!! nl2br(e($product->usage_instructions)) !!}
                        </div>
                    </div>
                @endif

                <!-- Stock Status -->
                <div class="mb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $product->stock_quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                        @if($product->stock_quantity > 0)
                            ({{ $product->stock_quantity }} available)
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                        @if($relatedProduct->getFirstMediaUrl('images'))
                            <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}" alt="{{ $relatedProduct->name }}" class="w-full h-32 object-cover" loading="lazy">
                        @else
                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-sm">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $relatedProduct->name }}</h3>
                        @if($relatedProduct->price)
                            <p class="text-green-600 font-semibold text-sm mb-2">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                        @else
                            <p class="text-gray-500 text-xs mb-2">Contact for price</p>
                        @endif
                        <div class="flex flex-wrap gap-1 mb-2">
                            @if($relatedProduct->is_halal_certified)
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-1.5 py-0.5 rounded">Halal</span>
                            @endif
                            @if($relatedProduct->is_bpom_certified)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-1.5 py-0.5 rounded">BPOM</span>
                            @endif
                        </div>
                        <a href="{{ route('products.show', $relatedProduct->slug) }}" class="text-green-600 text-sm hover:text-green-700 font-medium">
                            View Details →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-frontend-layout>
