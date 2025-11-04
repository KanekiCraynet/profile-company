@props(['product'])

<div class="card card-hover group overflow-hidden">
    <!-- Product Image -->
    <div class="relative overflow-hidden bg-neutral-100 dark:bg-neutral-800 aspect-[4/3]">
        @if($product->getFirstMediaUrl('images'))
            <img 
                src="{{ $product->getFirstMediaUrl('images') }}" 
                alt="{{ $product->name }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20">
                <svg class="w-16 h-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        @endif
        
        <!-- Badges -->
        <div class="absolute top-3 left-3 flex flex-col gap-2">
            @if($product->is_halal)
                <span class="badge badge-success text-xs px-2 py-1">
                    🕌 Halal
                </span>
            @endif
            @if($product->bpom_number)
                <span class="badge badge-primary text-xs px-2 py-1">
                    🏥 BPOM
                </span>
            @endif
        </div>
        
        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
            <a href="{{ route('products.show', $product->slug) }}" class="w-full">
                <span class="block text-white font-semibold text-sm">Lihat Detail</span>
            </a>
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="p-5">
        <h3 class="text-lg font-heading font-semibold text-neutral-900 dark:text-neutral-100 mb-2 line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>
        
        @if($product->description)
            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-4 line-clamp-2">
                {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}
            </p>
        @endif
        
        <div class="flex items-center justify-between">
            @if($product->price)
                <span class="text-lg font-bold text-primary-600 dark:text-primary-400">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            @else
                <span class="text-sm text-neutral-500 dark:text-neutral-400">
                    Hubungi untuk harga
                </span>
            @endif
            
            <a href="{{ route('products.show', $product->slug) }}" 
               class="btn btn-primary text-sm py-2 px-4">
                Detail
            </a>
        </div>
        
        @if($product->category)
            <div class="mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                <span class="text-xs text-neutral-500 dark:text-neutral-400">
                    {{ $product->category->name }}
                </span>
            </div>
        @endif
    </div>
</div>

