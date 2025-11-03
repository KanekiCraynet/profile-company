<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seoMeta = $seoMeta ?? [];
    @endphp

    <title>{{ $seoMeta['title'] ?? ($title ?? config('app.name', 'PT Lestari Jaya Bangsa')) }}</title>

    <!-- SEO Meta Tags -->
<<<<<<< Current (Your changes)
    <meta name="description" content="{{ $metaDescription ?? 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products, committed to prioritizing both health and taste.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'herbal products, food products, natural ingredients, BPOM certified, Halal MUI' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? config('app.name', 'PT Lestari Jaya Bangsa') }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(isset($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
=======
    <meta name="description" content="{{ $seoMeta['description'] ?? 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products, committed to prioritizing both health and taste.' }}">
    <meta name="keywords" content="{{ $seoMeta['keywords'] ?? 'herbal products, food products, natural ingredients, BPOM certified, Halal MUI' }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $seoMeta['og_title'] ?? ($title ?? config('app.name', 'PT Lestari Jaya Bangsa')) }}">
    <meta property="og:description" content="{{ $seoMeta['og_description'] ?? 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products.' }}">
    <meta property="og:type" content="{{ $seoMeta['og_type'] ?? 'website' }}">
    @if(isset($seoMeta['og_image']))
    <meta property="og:image" content="{{ $seoMeta['og_image'] }}">
    @endif
    @if(isset($seoMeta['article_published_time']))
    <meta property="article:published_time" content="{{ $seoMeta['article_published_time'] }}">
    @endif
    @if(isset($seoMeta['article_author']))
    <meta property="article:author" content="{{ $seoMeta['article_author'] }}">
    @endif

    <!-- JSON-LD Structured Data -->
    @if(isset($seoMeta['json_ld']))
    <script type="application/ld+json">
        {!! json_encode($seoMeta['json_ld']) !!}
    </script>
>>>>>>> Incoming (Background Agent changes)
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }
        .certification-badge {
            background: linear-gradient(45deg, #22c55e, #16a34a);
            box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-green-600">PT Lestari Jaya Bangsa</span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-button" class="text-gray-700 hover:text-green-600 focus:outline-none focus:text-green-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-green-600 font-semibold' : '' }}">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'text-green-600 font-semibold' : '' }}">Products</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-green-600 font-semibold' : '' }}">About</a>
                    <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('articles.*') ? 'text-green-600 font-semibold' : '' }}">Articles</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'text-green-600 font-semibold' : '' }}">Contact</a>
                </div>

                <!-- Desktop Auth Button -->
                <div class="hidden md:flex items-center">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('home') ? 'text-green-600 bg-green-50' : '' }}">Home</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('products.*') ? 'text-green-600 bg-green-50' : '' }}">Products</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('about') ? 'text-green-600 bg-green-50' : '' }}">About</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('articles.*') ? 'text-green-600 bg-green-50' : '' }}">Articles</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('contact') ? 'text-green-600 bg-green-50' : '' }}">Contact</a>
            <div class="border-t border-gray-200 pt-2 mt-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium bg-green-600 text-white hover:bg-green-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold mb-4">PT Lestari Jaya Bangsa</h3>
                    <p class="text-gray-300 mb-4">
                        Food & Herbal — Health and Flavour, United in One Choice
                    </p>
                    <p class="text-gray-300 text-sm">
                        Providing high-quality herbal and processed food products, committed to prioritizing both health and taste.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white">Products</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">About</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-300 hover:text-white">Articles</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <div class="space-y-2 text-gray-300 text-sm">
                        <p>Jl. Raya Buntu - Sampang, Utara Pasar, Kali Minyak, Bangsa, Kec. Kebasen, Kabupaten Banyumas, Jawa Tengah 53282</p>
                        <p>Working Hours: 07:00 - 16:00</p>
                        <p>Phone: (+62) 821-9698-146</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} PT Lestari Jaya Bangsa. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="fixed bottom-6 right-6 z-50">
        <div id="chatbot-button" class="bg-green-600 hover:bg-green-700 text-white rounded-full w-16 h-16 flex items-center justify-center cursor-pointer shadow-lg transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </div>

        <div id="chatbot-window" class="hidden bg-white rounded-lg shadow-xl w-80 h-96 flex flex-col overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                <h3 class="font-semibold">PT Lestari Jaya Bangsa Support</h3>
                <p class="text-sm opacity-90">How can we help you today?</p>
            </div>

            <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3">
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm">Hello! I'm here to help you with information about our products and services. What would you like to know?</p>
                </div>
            </div>

            <div class="border-t p-4">
                <div class="flex space-x-2">
                    <input type="text" id="chat-input" placeholder="Type your message..." class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <button id="send-message" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js and Chatbot Script -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Chatbot functionality
            const chatbotButton = document.getElementById('chatbot-button');
            const chatbotWindow = document.getElementById('chatbot-window');
            const chatInput = document.getElementById('chat-input');
            const sendButton = document.getElementById('send-message');
            const chatMessages = document.getElementById('chat-messages');

            if (chatbotButton) {
                chatbotButton.addEventListener('click', function() {
                    if (chatbotWindow) {
                        chatbotWindow.classList.toggle('hidden');
                    }
                });
            }

            function sendMessage() {
                const message = chatInput.value.trim();
                if (!message) return;

                // Add user message
                addMessage(message, 'user');
                chatInput.value = '';

                // Get or create session ID
                let sessionId = localStorage.getItem('chatbot_session_id');
                if (!sessionId) {
                    sessionId = 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                    localStorage.setItem('chatbot_session_id', sessionId);
                }

                // Send to backend and get response
                fetch('{{ route("chatbot.message") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        message: message,
                        session_id: sessionId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addMessage(data.response, 'bot');
                        // Update session ID if provided
                        if (data.session_id) {
                            localStorage.setItem('chatbot_session_id', data.session_id);
                        }
                    } else {
                        addMessage(data.response || 'Sorry, I encountered an error. Please try again.', 'bot');
                    }
                })
                .catch(error => {
                    addMessage('Sorry, I encountered an error. Please try again.', 'bot');
                });
            }

            if (sendButton) {
                sendButton.addEventListener('click', sendMessage);
            }
            if (chatInput) {
                chatInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
            }

            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = sender === 'user' ? 'bg-green-100 rounded-lg p-3 max-w-xs ml-auto' : 'bg-gray-100 rounded-lg p-3 max-w-xs';
                messageDiv.innerHTML = `<p class="text-sm">${text}</p>`;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</body>
</html>