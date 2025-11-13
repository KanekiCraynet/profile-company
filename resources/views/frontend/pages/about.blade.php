<x-layouts.app>
    @section('title', 'Tentang Kami - PT Lestari Jaya Bangsa')
    
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang Kami</h1>
            <p class="text-xl text-green-50 max-w-3xl">
                Komitmen Kualitas dan Kesehatan Sejak 1992
            </p>
        </div>
    </section>

    <!-- Company Story -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-xl">
                        <div class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                            <svg class="w-40 h-40 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                        Berdiri Sejak 1992
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Visi & Misi Perusahaan</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        PT Lestari Jaya Bangsa adalah perusahaan yang bergerak di bidang produksi dan distribusi produk herbal serta pangan olahan berkualitas tinggi. Sejak didirikan pada tahun 1992, kami telah berkomitmen untuk menyediakan produk yang mengutamakan kesehatan dan cita rasa.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Dengan pengalaman lebih dari 30 tahun di industri ini, kami memahami pentingnya kualitas, keamanan, dan konsistensi dalam setiap produk yang kami hasilkan. Kami menggunakan bahan baku alami terpilih dan proses produksi modern yang memenuhi standar nasional dan internasional.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Company History Timeline -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Sejarah Perusahaan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Perjalanan panjang kami dalam menghadirkan produk berkualitas untuk masyarakat Indonesia
                </p>
            </div>
            
            <div class="relative">
                <div class="absolute left-8 md:left-1/2 md:transform md:-translate-x-1/2 w-1 h-full bg-green-200"></div>
                
                <div class="space-y-12">
                    <div class="relative flex items-center" x-data="{ inView: false }" x-intersect="inView = true">
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl z-10"
                             :class="{ 'animate-fade-in': inView }">
                            1992
                        </div>
                        <div class="md:hidden absolute left-8 w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            1992
                        </div>
                        <div class="ml-24 md:ml-0 md:w-1/2 md:pl-16 md:pr-8" :class="{ 'md:ml-auto md:pr-0 md:pl-8': false }">
                            <div class="bg-white rounded-xl shadow-lg p-6" :class="{ 'animate-slide-in-right': inView }">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Pendirian Perusahaan</h3>
                                <p class="text-gray-600">PT Lestari Jaya Bangsa didirikan dengan visi untuk menjadi penyedia produk herbal dan pangan olahan terpercaya di Indonesia.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative flex items-center" x-data="{ inView: false }" x-intersect="inView = true">
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl z-10"
                             :class="{ 'animate-fade-in': inView }">
                            2000
                        </div>
                        <div class="md:hidden absolute left-8 w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            2000
                        </div>
                        <div class="ml-24 md:ml-0 md:w-1/2 md:pl-16 md:pr-8 md:ml-auto md:pr-0 md:pl-8">
                            <div class="bg-white rounded-xl shadow-lg p-6" :class="{ 'animate-slide-in-left': inView }">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Ekspansi Produk</h3>
                                <p class="text-gray-600">Memperluas lini produk dengan fokus pada inovasi dan kualitas, serta mendapatkan berbagai sertifikasi nasional.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative flex items-center" x-data="{ inView: false }" x-intersect="inView = true">
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl z-10"
                             :class="{ 'animate-fade-in': inView }">
                            2020
                        </div>
                        <div class="md:hidden absolute left-8 w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            2020
                        </div>
                        <div class="ml-24 md:ml-0 md:w-1/2 md:pl-16 md:pr-8">
                            <div class="bg-white rounded-xl shadow-lg p-6" :class="{ 'animate-slide-in-right': inView }">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Modernisasi Produksi</h3>
                                <p class="text-gray-600">Mengadopsi teknologi produksi modern dan meningkatkan standar kualitas untuk memenuhi permintaan pasar yang terus berkembang.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values & Certifications -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nilai & Sertifikasi</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="text-center p-8 bg-green-50 rounded-xl">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kualitas</h3>
                    <p class="text-gray-600">Standar kualitas tertinggi dalam setiap produk</p>
                </div>
                
                <div class="text-center p-8 bg-green-50 rounded-xl">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Keamanan</h3>
                    <p class="text-gray-600">Produk aman dan terjamin untuk konsumsi</p>
                </div>
                
                <div class="text-center p-8 bg-green-50 rounded-xl">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Inovasi</h3>
                    <p class="text-gray-600">Terus berinovasi untuk produk terbaik</p>
                </div>
            </div>
            
            <!-- Certifications -->
            <div class="flex flex-wrap justify-center gap-6">
                <div class="bg-white border-2 border-green-200 rounded-xl p-6 shadow-md">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Sertifikasi BPOM</h4>
                            <p class="text-sm text-gray-600">Produk terdaftar BPOM</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-green-200 rounded-xl p-6 shadow-md">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Sertifikasi Halal MUI</h4>
                            <p class="text-sm text-gray-600">Produk halal bersertifikat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

@push('styles')
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }
    
    @keyframes slide-in-right {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes slide-in-left {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.6s ease-out;
    }
    
    .animate-slide-in-right {
        animation: slide-in-right 0.6s ease-out;
    }
    
    .animate-slide-in-left {
        animation: slide-in-left 0.6s ease-out;
    }
</style>
@endpush
