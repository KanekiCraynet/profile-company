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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Navigation Component -->
    <x-navbar />
    
    <!-- Spacer for fixed navbar -->
    <div class="h-16 md:h-20"></div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Chatbot Widget -->
    <x-chatbot-widget />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
