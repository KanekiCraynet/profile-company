@props(['product'])

<!-- Product Card Component -->
<div class="bg-white rounded-lg shadow-md overflow-hidden card-hover group">
    <div class="aspect-w-1 aspect-h-1 bg-gray-200 overflow-hidden">
        @if($product->getFirstMediaUrl('images'))
            <img src="{{ $product->getFirstMediaUrl('images') }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500" 
                 loading="lazy">
        @else
            <div class="w-full h-48 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center">
                <svg class="w-16 h-16 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        @endif
    </div>
    
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-green-600 transition-colors line-clamp-2">
            {{ $product->name }}
        </h3>
        
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 100) }}
        </p>

        <!-- Certifications Badges -->
        <div class="flex flex-wrap gap-1 mb-4">
            @if($product->is_halal_certified ?? false)
                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">
                    🕌 Halal MUI
                </span>
            @endif
            @if($product->is_bpom_certified ?? false)
                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">
                    🏥 BPOM
                </span>
            @endif
            @if($product->is_natural ?? false)
                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-medium">
                    🌿 Natural
                </span>
            @endif
        </div>

        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
            @if(isset($product->price) && $product->price)
                <span class="text-green-600 font-bold text-lg">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            @else
                <span class="text-gray-500 text-sm">Contact for price</span>
            @endif
            
            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" 
               class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700 transition-all duration-200 transform hover:scale-105">
                View Details
            </a>
        </div>
    </div>
</div>

