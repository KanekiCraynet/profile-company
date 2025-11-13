<x-layouts.app>
    @section('title', ($product->name ?? 'Produk') . ' - PT Lestari Jaya Bangsa')
    
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('products.index') }}" class="hover:text-green-600">Produk</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium">{{ $product->name ?? 'Detail Produk' }}</span>
            </nav>
        </div>
    </section>

    <!-- Product Detail Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Images -->
                <div>
                    <div class="sticky top-24">
                        @if($product->getFirstMediaUrl('images'))
                            <div class="rounded-2xl overflow-hidden shadow-xl mb-4">
                                <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-auto object-cover">
                            </div>
                        @else
                            <div class="rounded-2xl overflow-hidden shadow-xl mb-4 aspect-square bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                <svg class="w-32 h-32 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Certification Badges -->
                        <div class="flex flex-wrap gap-3">
                            @if($product->is_halal ?? false)
                                <div class="flex items-center space-x-2 bg-green-50 border border-green-200 px-4 py-2 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                                    </svg>
                                    <span class="font-semibold text-green-700">Halal MUI</span>
                                </div>
                            @endif
                            @if($product->has_bpom ?? false)
                                <div class="flex items-center space-x-2 bg-blue-50 border border-blue-200 px-4 py-2 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-semibold text-blue-700">BPOM Certified</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        @if($product->category ?? null)
                            <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium mb-3">
                                {{ $product->category }}
                            </span>
                        @endif
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name ?? 'Nama Produk' }}</h1>
                    </div>
                    
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {!! $product->description ?? 'Deskripsi produk tidak tersedia.' !!}
                    </div>
                    
                    @if($product->ingredients ?? null)
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Komposisi</h3>
                            <p class="text-gray-600">{{ $product->ingredients }}</p>
                        </div>
                    @endif
                    
                    @if($product->usage ?? null)
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Cara Penggunaan</h3>
                            <p class="text-gray-600 whitespace-pre-line">{{ $product->usage }}</p>
                        </div>
                    @endif
                    
                    <div class="border-t border-gray-200 pt-6">
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                            Hubungi Kami untuk Pemesanan
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Produk Serupa</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedProducts->take(3) as $relatedProduct)
                        <x-card-product :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
