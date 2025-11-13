@props(['product'])

<a href="{{ route('products.show', $product->slug) }}" 
   class="group block bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
    <!-- Product Image -->
    <div class="relative h-64 bg-gray-100 overflow-hidden">
        @if($product->getFirstMediaUrl('images'))
            <img src="{{ $product->getFirstMediaUrl('images') }}" 
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-green-100">
                <svg class="w-20 h-20 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        @endif
        
        <!-- Certification Badges -->
        <div class="absolute top-3 left-3 flex flex-col space-y-2">
            @if($product->is_halal)
                <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                    Halal
                </span>
            @endif
            @if($product->has_bpom)
                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                    BPOM
                </span>
            @endif
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors line-clamp-2">
            {{ $product->name }}
        </h3>
        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
            {{ Str::limit($product->description ?? 'Produk herbal berkualitas tinggi dengan komposisi alami.', 100) }}
        </p>
        
        <!-- Product Meta -->
        @if($product->category)
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span>{{ $product->category }}</span>
            </div>
        @endif
        
        <!-- View Details Button -->
        <div class="flex items-center text-green-600 font-medium text-sm group-hover:text-green-700">
            <span>Lihat Detail</span>
            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>
</a>
