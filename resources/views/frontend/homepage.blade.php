@extends('layouts.app')
@section('title', 'Beranda - PT Lestari Jaya Bangsa')
    
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-green-50 via-white to-green-50 overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left space-y-8 animate-fade-in-up">
                    <div class="inline-block">
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                            Berdiri Sejak 1992
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Kesehatan dan Rasa,
                        <span class="block text-green-600 mt-2">Dalam Satu Pilihan.</span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Produk herbal dan pangan olahan berkualitas tinggi dengan komitmen mengutamakan kesehatan dan cita rasa untuk keluarga Indonesia.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                            Lihat Produk Kami
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center justify-center bg-white text-green-700 border-2 border-green-700 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-green-50 shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200">
                            Hubungi Kami
                        </a>
                    </div>
                    
                    <!-- Trust Badges -->
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">BPOM Certified</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                            </svg>
                            <span class="font-medium">Halal MUI</span>
                        </div>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div class="relative animate-fade-in-right">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <div class="aspect-[4/3] bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                            <svg class="w-48 h-48 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-xl">
                        <div class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                            <svg class="w-32 h-32 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Tentang Kami</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Komitmen Kualitas Sejak 1992</h2>
                    </div>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        PT Lestari Jaya Bangsa telah berdiri selama lebih dari 30 tahun dengan dedikasi tinggi untuk menyediakan produk herbal dan pangan olahan yang berkualitas. Kami mengutamakan kesehatan dan cita rasa dalam setiap produk yang kami hasilkan.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Dengan proses produksi yang modern dan bahan baku alami terpilih, kami memastikan setiap produk memenuhi standar kualitas tertinggi dan aman untuk dikonsumsi seluruh keluarga.
                    </p>
                    <a href="{{ route('about') }}" 
                       class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                        Pelajari Lebih Lanjut
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Highlights Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Produk Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Produk Unggulan</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Temukan produk herbal dan pangan olahan berkualitas tinggi dengan standar sertifikasi terbaik
                </p>
            </div>
            
            @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredProducts->take(6) as $product)
                        <x-card-product :product="$product" />
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @for($i = 0; $i < 6; $i++)
                        <div class="bg-white rounded-xl shadow-md p-6 animate-pulse">
                            <div class="h-48 bg-gray-200 rounded-lg mb-4"></div>
                            <div class="h-6 bg-gray-200 rounded mb-2"></div>
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center bg-white text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200">
                    Lihat Semua Produk
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Article/News Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Artikel & Berita</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Update Terbaru</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Dapatkan informasi terbaru seputar produk herbal, tips kesehatan, dan berita perusahaan
                </p>
            </div>
            
            @if(isset($latestArticles) && $latestArticles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestArticles->take(3) as $article)
                        <x-card-article :article="$article" />
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @for($i = 0; $i < 3; $i++)
                        <div class="bg-gray-50 rounded-xl shadow-md p-6 animate-pulse">
                            <div class="h-48 bg-gray-200 rounded-lg mb-4"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/3 mb-2"></div>
                            <div class="h-6 bg-gray-200 rounded mb-2"></div>
                            <div class="h-4 bg-gray-200 rounded"></div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="text-center mt-12">
                <a href="{{ route('articles.index') }}" 
                   class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                    Lihat Semua Artikel
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>

@push('styles')
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fade-in-right {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
    }
    
    .animate-fade-in-right {
        animation: fade-in-right 0.8s ease-out 0.2s both;
    }
    
    .bg-grid-pattern {
        background-image: 
            linear-gradient(to right, rgba(0,0,0,0.05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0,0,0,0.05) 1px, transparent 1px);
        background-size: 50px 50px;
    }
</style>
@endpush
