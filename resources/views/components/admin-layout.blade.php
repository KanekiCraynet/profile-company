<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} - PT Lestari Jaya Bangsa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .sidebar-link.active {
            background-color: rgba(34, 197, 94, 0.2);
            color: #16a34a;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="hidden md:hidden fixed inset-0 bg-black bg-opacity-50 z-40" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-green-800 text-white w-64 py-6 px-4 fixed h-full overflow-y-auto z-50">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold">PT Lestari Jaya Bangsa</h1>
                    <p class="text-green-200 text-sm">Admin Panel</p>
                </div>
                <!-- Mobile close button -->
                <button onclick="toggleSidebar()" class="md:hidden text-white hover:text-green-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="space-y-2 pb-24">
                <!-- Dashboard - All roles -->
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <!-- Products - Super Admin, Admin -->
                @can('view products')
                <a href="{{ route('admin.products.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.products.*') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Products
                </a>
                @endcan

                <!-- Articles - Super Admin, Admin, Marketing -->
                @can('view articles')
                <a href="{{ route('admin.articles.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.articles.*') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Articles
                </a>
                @endcan

                <!-- Contacts - Super Admin, Admin -->
                @can('view contacts')
                <a href="{{ route('admin.contacts.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.contacts.*') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contacts
                    @php
                        $unreadCount = \App\Models\Contact::where('status', 'unread')->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
                @endcan

                <!-- Chatbot - Super Admin, Admin, Marketing (read-only) -->
                @can('view chatbot')
                <div class="space-y-1">
                    <div class="text-green-200 text-sm font-medium px-4 py-2">Chatbot</div>
                    @can('create chatbot')
                    <a href="{{ route('admin.chatbot.index') }}"
                       class="sidebar-link block py-2 px-6 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.chatbot.index') || request()->routeIs('admin.chatbot.create') || request()->routeIs('admin.chatbot.edit') ? 'active bg-green-700' : '' }}">
                        📋 Rules
                    </a>
                    @endcan
                    <a href="{{ route('admin.chatbot.history') }}"
                       class="sidebar-link block py-2 px-6 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.chatbot.history') ? 'active bg-green-700' : '' }}">
                        📊 History
                    </a>
                </div>
                @endcan

                <!-- Users - Super Admin Only -->
                @can('view users')
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.users.*') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    Users
                </a>
                @endcan

                <!-- Roles & Permissions - Super Admin Only -->
                @can('view roles')
                <a href="{{ route('admin.roles.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.roles.*') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Roles & Permissions
                </a>
                @endcan

                <!-- Settings - Super Admin Only -->
                @can('view settings')
                <a href="{{ route('admin.settings.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700 transition-colors {{ request()->routeIs('admin.settings.*') ? 'active bg-green-700' : '' }}">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
                @endcan
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-6 left-4 right-4">
                <div class="bg-green-700 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                            <span class="text-sm font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-green-200 truncate">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('home') }}" target="_blank" class="flex-1 bg-green-600 hover:bg-green-500 text-white text-sm py-2 px-3 rounded text-center transition-colors">
                            View Site
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-sm py-2 px-3 rounded transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 md:ml-64">
            <!-- Top bar -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-600 hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h2>
                        </div>
                        <div class="hidden sm:block text-sm text-gray-600">
                            Welcome back, {{ auth()->user()->name }}!
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when sidebar is open on mobile
            if (sidebar.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        
        // Close sidebar on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                if (sidebar && sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });
    </script>
</body>
</html>
