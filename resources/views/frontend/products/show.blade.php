<x-frontend-layout>
    <x-slot name="title">{{ $product->name }} - Products | PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 160) }}</x-slot>

    <!-- Schema.org Product Markup -->
    <script type="application/ld+json">
    @php
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Product",
            "name" => $product->name,
            "description" => strip_tags($product->description ?? ''),
            "brand" => [
                "@type" => "Brand",
                "name" => "PT Lestari Jaya Bangsa"
            ],
            "url" => route('products.show', $product->slug)
        ];
        
        if ($product->getFirstMediaUrl('images')) {
            $schema["image"] = $product->getFirstMediaUrl('images');
        }
        
        if ($product->price) {
            $schema["offers"] = [
                "@type" => "Offer",
                "price" => (string) $product->price,
                "priceCurrency" => "IDR",
                "availability" => ($product->stock_quantity ?? 0) > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'
            ];
        }
        
        if ($product->category) {
            $schema["category"] = $product->category->name;
        }
        
        if ($product->is_halal_certified ?? false) {
            $schema["additionalProperty"] = [
                [
                    "@type" => "PropertyValue",
                    "name" => "Halal Certification",
                    "value" => "MUI Certified"
                ]
            ];
        }
    @endphp
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 reveal" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 6 10">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-green-600 ml-1 md:ml-2 transition-colors">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 6 10">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-gray-500 ml-1 md:ml-2">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="reveal">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden mb-4 shadow-lg" id="main-image-container">
                    @if($product->getFirstMediaUrl('images'))
                        <img id="main-product-image" 
                             src="{{ $product->getFirstMediaUrl('images') }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center">
                            <span class="text-gray-400 text-lg">Gambar Tidak Tersedia</span>
                        </div>
                    @endif
                </div>

                <!-- Additional Images Gallery -->
                @if($product->getMedia('images')->count() > 1)
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                        @foreach($product->getMedia('images') as $index => $media)
                            <button type="button" 
                                    onclick="changeMainImage('{{ $media->getUrl() }}', this)"
                                    class="focus:outline-none focus:ring-2 focus:ring-green-500 rounded overflow-hidden">
                                <img src="{{ $media->getUrl() }}" 
                                     alt="{{ $product->name }} - Gambar {{ $index + 1 }}" 
                                     class="w-full h-16 sm:h-20 object-cover rounded cursor-pointer hover:opacity-80 border-2 transition-all {{ $index === 0 ? 'border-green-500' : 'border-transparent hover:border-green-300' }}"
                                     loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <script>
                function changeMainImage(imageUrl, thumbElement) {
                    const mainImage = document.getElementById('main-product-image');
                    if (mainImage) {
                        mainImage.src = imageUrl;
                    }
                    // Update border on thumbnails
                    if (thumbElement && thumbElement.querySelector('img')) {
                        document.querySelectorAll('#main-image-container ~ .grid img').forEach(img => {
                            img.classList.remove('border-green-500');
                            img.classList.add('border-transparent');
                        });
                        const thumbImg = thumbElement.querySelector('img');
                        if (thumbImg) {
                            thumbImg.classList.remove('border-transparent');
                            thumbImg.classList.add('border-green-500');
                        }
                    }
                }
            </script>

            <!-- Product Info -->
            <div class="reveal">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-heading">{{ $product->name }}</h1>

                <!-- Certifications -->
                <div class="flex flex-wrap gap-2 mb-6">
                    @if($product->is_halal_certified ?? false)
                        <span class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            🕌 Halal MUI Certified
                        </span>
                    @endif
                    @if($product->is_bpom_certified ?? false)
                        <span class="inline-flex items-center bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            🏥 BPOM Approved
                        </span>
                    @endif
                    @if($product->is_natural ?? false)
                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                            🌿 100% Natural Ingredients
                        </span>
                    @endif
                </div>

                <!-- Price -->
                @if($product->price ?? null)
                <div class="text-3xl font-bold text-green-600 mb-6 font-heading">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
                @else
                <div class="text-lg text-gray-600 mb-6">
                    <a href="{{ route('contact') }}" class="text-green-600 hover:text-green-700 underline font-medium">Hubungi kami untuk harga</a>
                </div>
                @endif

                <!-- Category -->
                @if($product->category ?? null)
                    <div class="mb-6">
                        <span class="text-sm text-gray-600">Kategori:</span>
                        <span class="text-sm font-medium text-gray-900 ml-2">{{ $product->category->name }}</span>
                    </div>
                @endif

                <!-- Description -->
                @if($product->description ?? null)
                <div class="prose prose-gray max-w-none mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 font-heading">Deskripsi Produk</h3>
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($product->benefits ?? null)
                    <div class="bg-green-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3 font-heading">Manfaat</h3>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($product->benefits)) !!}
                        </div>
                    </div>
                @endif

                <!-- Usage Instructions -->
                @if($product->usage_instructions ?? null)
                    <div class="bg-blue-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3 font-heading">Cara Penggunaan</h3>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($product->usage_instructions)) !!}
                        </div>
                    </div>
                @endif

                <!-- Stock Status -->
                <div class="mb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ ($product->stock_quantity ?? 0) > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ($product->stock_quantity ?? 0) > 0 ? 'Tersedia' : 'Tidak Tersedia' }}
                        @if(($product->stock_quantity ?? 0) > 0)
                            ({{ $product->stock_quantity }} tersedia)
                        @endif
                    </span>
                </div>

                <!-- CTA Button -->
                <div class="mt-8">
                    <a href="{{ route('contact') }}" 
                       class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold shadow-md inline-block transform hover:scale-105 transition-all duration-200">
                        Hubungi Kami untuk Pemesanan
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products Slider -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="mt-16 reveal" 
                 x-data="relatedProductsSlider()" 
                 @keydown.window="handleKeydown($event)"
                 aria-label="Related Products Slider">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 font-heading">Produk Serupa</h2>
                    <p class="text-gray-600 text-sm mt-1">Temukan produk lain yang mungkin Anda sukai</p>
                </div>
                
                <!-- Navigation Buttons - Top Right -->
                <div class="hidden md:flex items-center space-x-2">
                    <button 
                        @click="scrollLeft()"
                        :disabled="!canScrollLeft"
                        :class="!canScrollLeft ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700 hover:scale-110'"
                        class="bg-green-600 text-white p-3 rounded-full transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed transform"
                        aria-label="Scroll left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button 
                        @click="scrollRight()"
                        :disabled="!canScrollRight"
                        :class="!canScrollRight ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700 hover:scale-110'"
                        class="bg-green-600 text-white p-3 rounded-full transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed transform"
                        aria-label="Scroll right">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Slider Container -->
            <div class="relative group">
                <!-- Left Arrow Overlay (Desktop) -->
                <button 
                    @click="scrollLeft()"
                    :disabled="!canScrollLeft"
                    :class="!canScrollLeft ? 'opacity-0 invisible' : 'opacity-100 visible'"
                    class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-white hover:bg-green-50 text-green-600 p-4 rounded-full shadow-xl transition-all duration-300 hover:scale-110 transform border-2 border-green-200"
                    aria-label="Scroll left">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Right Arrow Overlay (Desktop) -->
                <button 
                    @click="scrollRight()"
                    :disabled="!canScrollRight"
                    :class="!canScrollRight ? 'opacity-0 invisible' : 'opacity-100 visible'"
                    class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-white hover:bg-green-50 text-green-600 p-4 rounded-full shadow-xl transition-all duration-300 hover:scale-110 transform border-2 border-green-200"
                    aria-label="Scroll right">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Left Gradient Fade -->
                <div 
                    :class="canScrollLeft ? 'opacity-100' : 'opacity-0'"
                    class="hidden md:block absolute left-0 top-0 bottom-4 w-24 bg-gradient-to-r from-white via-white to-transparent pointer-events-none z-10 transition-opacity duration-300"></div>

                <!-- Scrollable Container -->
                <div 
                    x-ref="slider"
                    @scroll="updateScrollButtons()"
                    @touchstart="isDragging = true"
                    @touchend="isDragging = false"
                    @mousedown="isDragging = true"
                    @mouseup="isDragging = false"
                    @mouseleave="isDragging = false"
                    class="flex gap-6 overflow-x-auto scrollbar-hide scroll-smooth pb-4 px-2 md:px-0 cursor-grab active:cursor-grabbing"
                    style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;"
                    x-init="initSlider()">
                    @foreach($relatedProducts as $index => $relatedProduct)
                    <div 
                        class="flex-shrink-0 w-full sm:w-80 lg:w-72 transform transition-all duration-300 hover:scale-105 snap-start product-card-wrapper"
                        :class="{'opacity-100': true}"
                        style="scroll-snap-align: start;"
                        x-data="{ 
                            inView: false,
                            init() {
                                const observer = new IntersectionObserver((entries) => {
                                    entries.forEach(entry => {
                                        this.inView = entry.isIntersecting;
                                    });
                                }, { threshold: 0.3 });
                                observer.observe(this.$el);
                            }
                        }"
                        x-show="inView || true"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 transform translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="relative group/card">
                            <x-card-product :product="$relatedProduct" />
                            <!-- Shine effect on hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity duration-500 pointer-events-none rounded-lg"></div>
                            <!-- Pulse border effect -->
                            <div class="absolute inset-0 border-2 border-green-500 rounded-lg opacity-0 group-hover/card:opacity-100 transition-opacity duration-300 pointer-events-none animate-pulse"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Right Gradient Fade -->
                <div 
                    :class="canScrollRight ? 'opacity-100' : 'opacity-0'"
                    class="hidden md:block absolute right-0 top-0 bottom-4 w-24 bg-gradient-to-l from-white via-white to-transparent pointer-events-none z-10 transition-opacity duration-300"></div>

                <!-- Mobile Gradient Overlay -->
                <div class="md:hidden absolute right-0 top-0 bottom-4 w-20 bg-gradient-to-l from-white to-transparent pointer-events-none z-10"></div>
                <div class="md:hidden absolute left-0 top-0 bottom-4 w-20 bg-gradient-to-r from-white to-transparent pointer-events-none z-10"></div>

                <!-- Progress Bar -->
                <div class="mt-6 mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">
                            <span x-text="currentIndex + 1"></span> / <span x-text="getVisibleItems().length"></span>
                        </span>
                        <span class="text-xs text-gray-500" x-text="'Total: ' + getTotalProducts() + ' produk'"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div 
                            :style="'width: ' + getProgressPercentage() + '%'"
                            class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full transition-all duration-300 shadow-sm"></div>
                    </div>
                </div>

                <!-- Scroll Indicator Dots -->
                <div class="flex justify-center items-center mt-4 space-x-2" x-show="getVisibleItems().length > 1">
                    <template x-for="(item, index) in getVisibleItems()" :key="index">
                        <button
                            @click="scrollToItem(index)"
                            :class="currentIndex === index ? 'bg-green-600 w-8 shadow-md ring-2 ring-green-300 ring-offset-2' : 'bg-gray-300 w-2 hover:bg-green-400 hover:w-6'"
                            class="h-2 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            :aria-label="'Go to slide ' + (index + 1)"
                            :aria-current="currentIndex === index ? 'true' : 'false'">
                        </button>
                    </template>
                </div>

                <!-- View All Products Link -->
                <div class="text-center mt-6">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center text-green-600 hover:text-green-700 font-medium transition-colors group">
                        <span>Lihat Semua Produk</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <script>
            function relatedProductsSlider() {
                return {
                    canScrollLeft: false,
                    canScrollRight: true,
                    currentIndex: 0,
                    cardWidth: 0,
                    visibleCards: 0,
                    isDragging: false,
                    
                    initSlider() {
                        // Wait for DOM to be ready
                        this.$nextTick(() => {
                            this.updateScrollButtons();
                            this.calculateCardWidth();
                            
                            // Debounce resize handler
                            let resizeTimeout;
                            const handleResize = () => {
                                clearTimeout(resizeTimeout);
                                resizeTimeout = setTimeout(() => {
                                    this.calculateCardWidth();
                                    this.updateScrollButtons();
                                }, 250);
                            };
                            window.addEventListener('resize', handleResize);
                            
                            // Store cleanup function
                            this._resizeHandler = handleResize;
                            
                            // Update on scroll with throttling
                            const slider = this.$refs.slider;
                            if (slider) {
                                let scrollTimeout;
                                const handleScroll = () => {
                                    clearTimeout(scrollTimeout);
                                    scrollTimeout = setTimeout(() => {
                                        this.updateScrollButtons();
                                    }, 100);
                                };
                                slider.addEventListener('scroll', handleScroll, { passive: true });
                                
                                // Store cleanup function
                                this._scrollHandler = handleScroll;
                            }
                        });
                    },
                    
                    calculateCardWidth() {
                        const slider = this.$refs.slider;
                        if (!slider) return;
                        
                        const cards = slider.querySelectorAll('.flex-shrink-0');
                        if (cards.length > 0 && cards[0].offsetWidth > 0) {
                            this.cardWidth = cards[0].offsetWidth;
                            const containerWidth = slider.offsetWidth;
                            const gap = 24; // gap-6 = 24px
                            const calculatedVisible = Math.floor(containerWidth / (this.cardWidth + gap));
                            this.visibleCards = Math.max(1, calculatedVisible);
                        }
                    },
                    
                    getVisibleItems() {
                        const slider = this.$refs.slider;
                        if (!slider) return [];
                        const cards = slider.querySelectorAll('.flex-shrink-0');
                        const total = cards.length;
                        if (total === 0) return [];
                        const visible = Math.max(1, this.visibleCards || 1);
                        const pages = Math.ceil(total / visible);
                        return Array.from({ length: pages }, (_, i) => i);
                    },
                    
                    scrollLeft() {
                        const slider = this.$refs.slider;
                        if (!slider) return;
                        
                        const cardWidth = this.cardWidth || 320;
                        const gap = 24;
                        const visibleCards = this.visibleCards || 1;
                        const scrollAmount = (cardWidth + gap) * visibleCards;
                        
                        // Smooth scroll with easing
                        slider.scrollBy({
                            left: -scrollAmount,
                            behavior: 'smooth'
                        });
                        
                        // Haptic feedback on mobile
                        if (navigator.vibrate) {
                            navigator.vibrate(10);
                        }
                        
                        setTimeout(() => this.updateScrollButtons(), 300);
                    },
                    
                    scrollRight() {
                        const slider = this.$refs.slider;
                        if (!slider) return;
                        
                        const cardWidth = this.cardWidth || 320;
                        const gap = 24;
                        const visibleCards = this.visibleCards || 1;
                        const scrollAmount = (cardWidth + gap) * visibleCards;
                        
                        // Smooth scroll with easing
                        slider.scrollBy({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                        
                        // Haptic feedback on mobile
                        if (navigator.vibrate) {
                            navigator.vibrate(10);
                        }
                        
                        setTimeout(() => this.updateScrollButtons(), 300);
                    },
                    
                    scrollToItem(index) {
                        const slider = this.$refs.slider;
                        if (!slider || index < 0) return;
                        
                        const cardWidth = this.cardWidth || 320;
                        const gap = 24;
                        const visibleCards = Math.max(1, this.visibleCards || 1);
                        const scrollAmount = (cardWidth + gap) * visibleCards * index;
                        
                        slider.scrollTo({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                        
                        this.currentIndex = index;
                        setTimeout(() => this.updateScrollButtons(), 300);
                    },
                    
                    updateScrollButtons() {
                        const slider = this.$refs.slider;
                        if (!slider) return;
                        
                        const { scrollLeft, scrollWidth, clientWidth } = slider;
                        const threshold = 5; // Small threshold for edge detection
                        
                        this.canScrollLeft = scrollLeft > threshold;
                        this.canScrollRight = scrollLeft < (scrollWidth - clientWidth - threshold);
                        
                        // Update current index based on scroll position
                        if (this.cardWidth > 0) {
                            const gap = 24;
                            const scrollPosition = scrollLeft / (this.cardWidth + gap);
                            this.currentIndex = Math.max(0, Math.round(scrollPosition));
                        }
                    },
                    
                    getProgressPercentage() {
                        const slider = this.$refs.slider;
                        if (!slider) return 0;
                        
                        const { scrollLeft, scrollWidth, clientWidth } = slider;
                        if (scrollWidth <= clientWidth) return 100;
                        
                        const maxScroll = scrollWidth - clientWidth;
                        const percentage = (scrollLeft / maxScroll) * 100;
                        return Math.min(100, Math.max(0, percentage));
                    },
                    
                    getTotalProducts() {
                        const slider = this.$refs.slider;
                        if (!slider) return 0;
                        return slider.querySelectorAll('.flex-shrink-0').length;
                    },
                    
                    handleKeydown(event) {
                        // Only handle if slider is in viewport and not typing in input
                        if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
                            return;
                        }
                        
                        const slider = this.$refs.slider;
                        if (!slider) return;
                        
                        const rect = slider.getBoundingClientRect();
                        const isInViewport = rect.top < window.innerHeight && rect.bottom > 0;
                        
                        if (!isInViewport) return;
                        
                        // Arrow key navigation
                        if (event.key === 'ArrowLeft' && this.canScrollLeft) {
                            event.preventDefault();
                            this.scrollLeft();
                        } else if (event.key === 'ArrowRight' && this.canScrollRight) {
                            event.preventDefault();
                            this.scrollRight();
                        }
                    },
                    
                    // Cleanup function
                    destroy() {
                        if (this._resizeHandler) {
                            window.removeEventListener('resize', this._resizeHandler);
                        }
                        if (this._scrollHandler && this.$refs.slider) {
                            this.$refs.slider.removeEventListener('scroll', this._scrollHandler);
                        }
                    }
                }
            }
        </script>

        <style>
            /* Hide scrollbar but keep functionality */
            .scrollbar-hide {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
            
            .scrollbar-hide::-webkit-scrollbar {
                display: none;  /* Chrome, Safari and Opera */
            }
            
            /* Smooth scrolling */
            .scrollbar-hide {
                scroll-behavior: smooth;
            }
            
            /* Touch-friendly scrolling on mobile */
            @media (max-width: 768px) {
                .scrollbar-hide {
                    -webkit-overflow-scrolling: touch;
                    scroll-snap-type: x mandatory;
                }
                
                .snap-start {
                    scroll-snap-align: start;
                }
            }
            
            /* Enhanced hover effects */
            .cursor-grab {
                cursor: grab;
            }
            
            .cursor-grab:active {
                cursor: grabbing;
            }
            
            /* Product card wrapper enhancements */
            .product-card-wrapper {
                transition: all 0.3s ease;
            }
            
            .product-card-wrapper:hover {
                z-index: 10;
            }
            
            /* Smooth scroll behavior */
            .scrollbar-hide {
                scroll-padding: 0 1rem;
            }
            
            /* Arrow button hover animation */
            @keyframes pulse {
                0%, 100% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.05);
                }
            }
            
            .group:hover button:not(:disabled) {
                animation: pulse 2s ease-in-out infinite;
            }
            
            /* Enhanced card shadow on hover */
            .product-card-wrapper:hover .card-hover {
                box-shadow: 0 20px 40px -10px rgba(34, 197, 94, 0.3);
            }
            
            /* Stagger animation for cards */
            .product-card-wrapper:nth-child(1) { animation-delay: 0ms; }
            .product-card-wrapper:nth-child(2) { animation-delay: 100ms; }
            .product-card-wrapper:nth-child(3) { animation-delay: 200ms; }
            .product-card-wrapper:nth-child(4) { animation-delay: 300ms; }
            .product-card-wrapper:nth-child(5) { animation-delay: 400ms; }
            .product-card-wrapper:nth-child(6) { animation-delay: 500ms; }
            
            /* Smooth card entrance */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .product-card-wrapper {
                animation: slideInUp 0.6s ease-out forwards;
            }
            
            /* Loading skeleton state */
            .product-card-wrapper.loading {
                opacity: 0.5;
                pointer-events: none;
            }
            
            /* Enhanced focus states for accessibility */
            .product-card-wrapper:focus-within {
                outline: 2px solid #22c55e;
                outline-offset: 4px;
                border-radius: 8px;
            }
            
            /* Mobile touch improvements */
            @media (max-width: 768px) {
                .product-card-wrapper {
                    padding: 0 0.5rem;
                }
                
                .scrollbar-hide {
                    padding: 0 1rem;
                }
                
                /* Better touch targets on mobile */
                button {
                    min-height: 44px;
                    min-width: 44px;
                }
            }
            
            /* Smooth scroll momentum */
            .scrollbar-hide {
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
                overscroll-behavior-x: contain;
            }
            
            /* Prevent text selection during drag */
            .scrollbar-hide:active {
                user-select: none;
                -webkit-user-select: none;
            }
        </style>
    </div>
</x-frontend-layout>
