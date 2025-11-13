<x-frontend-layout>
    <x-slot name="title">Products - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">Explore our range of high-quality herbal and processed food products. All products are BPOM certified and Halal MUI approved.</x-slot>
    <x-slot name="metaKeywords">herbal products, food products, natural ingredients, BPOM certified, Halal MUI, PT Lestari Jaya Bangsa</x-slot>

    <!-- Page Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-heading">Produk Kami</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto">
                Temukan rangkaian lengkap produk herbal dan makanan olahan kami,
                semuanya dibuat dengan bahan alami dan bersertifikat untuk kualitas dan keamanan.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-8 reveal">
            <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari produk..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="category" 
                                name="category" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort -->
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select id="sort" 
                                name="sort" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="name" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                            <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <button type="submit" 
                            class="flex-1 sm:flex-none btn-gradient text-white px-6 py-2 rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200">
                        Terapkan Filter
                    </button>

                    @if(request()->hasAny(['search', 'category', 'sort']))
                        <a href="{{ route('products.index') }}" 
                           class="flex-1 sm:flex-none bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-medium text-center">
                            Hapus Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        @if(isset($products) && $products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($products as $product)
                <div class="reveal">
                    <x-card-product :product="$product" />
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if(method_exists($products, 'links'))
            <div class="flex justify-center reveal">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @endif
        @else
            <div class="text-center py-16 reveal">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2 font-heading">Produk Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Coba sesuaikan kriteria pencarian Anda atau jelajahi semua produk.
                </p>
                <a href="{{ route('products.index') }}" 
                   class="btn-gradient text-white px-6 py-3 rounded-lg font-semibold shadow-md inline-block">
                    Lihat Semua Produk
                </a>
            </div>
        @endif
    </div>
</x-frontend-layout>
