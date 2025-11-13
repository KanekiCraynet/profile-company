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
    @endif

    <!-- Fonts - Professional Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=Lato:wght@400;700&family=Open+Sans:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        .certification-badge {
            background: linear-gradient(45deg, #22c55e, #16a34a);
            box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.1);
        }
        body {
            font-family: 'Open Sans', 'Roboto', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', 'Inter', 'Lato', sans-serif;
        }
        .font-heading {
            font-family: 'Poppins', 'Inter', 'Lato', sans-serif;
        }
        .parallax-section {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        @media (max-width: 768px) {
            .parallax-section {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Chatbot Widget -->
    <x-chatbot-widget />

    <!-- Alpine.js and Chatbot Script -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sticky header blur effect on scroll
            const mainNav = document.getElementById('main-nav');
            let lastScroll = 0;
            
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 50) {
                    mainNav.classList.add('header-blur');
                    mainNav.classList.add('shadow-xl');
                } else {
                    mainNav.classList.remove('header-blur');
                    mainNav.classList.remove('shadow-xl');
                }
                
                lastScroll = currentScroll;
            });

            // Scroll reveal animation
            const reveals = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, { threshold: 0.1 });
            
            reveals.forEach(reveal => revealObserver.observe(reveal));

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Chatbot functionality is handled by the chatbot-widget component
        });
    </script>
</body>
</html>
