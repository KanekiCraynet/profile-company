<!-- Professional Footer Component -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-xl font-bold mb-4 font-heading">PT Lestari Jaya Bangsa</h3>
                <p class="text-gray-300 mb-4 text-lg">
                    Food & Herbal — Health and Flavour, United in One Choice
                </p>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Providing high-quality herbal and processed food products, committed to prioritizing both health and taste.
                    Established since 1992, we continue to earn consumer trust while expanding towards the global market.
                </p>
                
                <!-- Certifications -->
                <div class="flex flex-wrap gap-3 mt-6">
                    <div class="flex items-center bg-green-800/50 px-3 py-1.5 rounded-full">
                        <span class="text-sm mr-2">🕌</span>
                        <span class="text-xs">Halal MUI</span>
                    </div>
                    <div class="flex items-center bg-green-800/50 px-3 py-1.5 rounded-full">
                        <span class="text-sm mr-2">🏥</span>
                        <span class="text-xs">BPOM</span>
                    </div>
                    <div class="flex items-center bg-green-800/50 px-3 py-1.5 rounded-full">
                        <span class="text-sm mr-2">🌿</span>
                        <span class="text-xs">100% Natural</span>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4 font-heading">Quick Links</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" 
                           class="text-gray-300 hover:text-white transition-colors duration-200">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" 
                           class="text-gray-300 hover:text-white transition-colors duration-200">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" 
                           class="text-gray-300 hover:text-white transition-colors duration-200">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}" 
                           class="text-gray-300 hover:text-white transition-colors duration-200">
                            Articles & News
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" 
                           class="text-gray-300 hover:text-white transition-colors duration-200">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4 font-heading">Contact Info</h4>
                <div class="space-y-3 text-gray-300 text-sm">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="leading-relaxed">
                            Jl. Raya Buntu - Sampang, Utara Pasar,<br>
                            Kali Minyak, Bangsa, Kec. Kebasen,<br>
                            Kabupaten Banyumas, Jawa Tengah 53282
                        </p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>Working Hours: 07:00 - 16:00 WIB</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+628219698146" class="hover:text-white transition-colors">
                            (+62) 821-9698-146
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} PT Lestari Jaya Bangsa. All rights reserved.
            </p>
            <p class="text-gray-500 text-xs mt-2">
                Established since 1992 | Providing Quality Herbal & Food Products
            </p>
        </div>
    </div>
</footer>

