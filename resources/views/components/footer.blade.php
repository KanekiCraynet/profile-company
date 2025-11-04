<footer class="bg-gradient-to-br from-primary-800 via-primary-900 to-primary-950 text-white">
    <div class="container-custom section-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-bold">PT Lestari Jaya Bangsa</h3>
                </div>
                <p class="text-primary-100 mb-4 leading-relaxed">
                    Food & Herbal — Kesehatan dan Rasa, Dalam Satu Pilihan.
                </p>
                <p class="text-primary-200 text-sm leading-relaxed">
                    Menyediakan produk herbal dan makanan olahan berkualitas tinggi, berkomitmen memprioritaskan kesehatan dan rasa.
                </p>
                <div class="flex items-center space-x-4 mt-6">
                    <span class="text-xs font-semibold text-primary-200">Berdiri Sejak</span>
                    <span class="text-2xl font-bold text-white">1992</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-heading font-semibold mb-4">Navigasi Cepat</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-primary-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-heading font-semibold mb-4">Informasi Kontak</h4>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-primary-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div class="text-primary-200 text-sm leading-relaxed">
                            <p>Jl. Raya Buntu - Sampang, Utara Pasar, Kali Minyak, Bangsa, Kec. Kebasen, Kabupaten Banyumas, Jawa Tengah 53282</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-primary-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <a href="tel:+628219698146" class="text-primary-200 hover:text-white transition-colors text-sm">
                            (+62) 821-9698-146
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-primary-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-primary-200 text-sm">
                            <p>Jam Operasional:</p>
                            <p class="font-semibold text-white">07:00 - 16:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certifications -->
            <div>
                <h4 class="text-lg font-heading font-semibold mb-4">Sertifikasi</h4>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-2xl">🕌</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Halal MUI</p>
                            <p class="text-xs text-primary-200">Bersertifikat</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-2xl">🏥</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">BPOM</p>
                            <p class="text-xs text-primary-200">Terdaftar & Disetujui</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-primary-700/50 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-primary-300 text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} PT Lestari Jaya Bangsa. All rights reserved.
                </p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-primary-300 hover:text-white transition-colors text-sm">
                        Kebijakan Privasi
                    </a>
                    <a href="#" class="text-primary-300 hover:text-white transition-colors text-sm">
                        Syarat & Ketentuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

