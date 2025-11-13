<x-layouts.app>
    @section('title', 'Produk - PT Lestari Jaya Bangsa')
    
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Produk Kami</h1>
            <p class="text-xl text-green-50 max-w-3xl">
                Temukan produk herbal dan pangan olahan berkualitas tinggi dengan standar sertifikasi terbaik
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar -->
            <div x-data="{ category: 'all' }" class="mb-8">
                <div class="flex flex-wrap gap-3 justify-center">
                    <button @click="category = 'all'" 
                            :class="category === 'all' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-50'"
                            class="px-6 py-2 rounded-full font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        Semua Produk
                    </button>
                    @if(isset($categories) && $categories->count() > 0)
                        @foreach($categories as $cat)
                            <button @click="category = '{{ $cat }}'" 
                                    :class="category === '{{ $cat }}' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-50'"
                                    class="px-6 py-2 rounded-full font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                                {{ $cat }}
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            @if(isset($products) && $products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div x-show="category === 'all' || category === '{{ $product->category ?? 'other' }}'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100">
                            <x-card-product :product="$product" />
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if(method_exists($products, 'links'))
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500">Produk akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
