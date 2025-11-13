<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PT Lestari Jaya Bangsa - Kesehatan dan Rasa, Dalam Satu Pilihan')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('metaDescription', 'PT Lestari Jaya Bangsa menyediakan produk herbal dan pangan olahan berkualitas tinggi, berkomitmen untuk mengutamakan kesehatan dan cita rasa. Berdiri sejak 1992.')">                                           
    <meta name="keywords" content="@yield('keywords', 'produk herbal, pangan olahan, bahan alami, sertifikasi BPOM, Halal MUI, PT Lestari Jaya Bangsa')">                                             

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'PT Lestari Jaya Bangsa')">                                                           
    <meta property="og:description" content="@yield('metaDescription', 'Produk herbal dan pangan olahan berkualitas tinggi')">     
    <meta property="og:type" content="website">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <x-navbar />

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Chatbot Widget -->
    <x-chatbot-widget />

    @stack('scripts')
</body>
</html>
