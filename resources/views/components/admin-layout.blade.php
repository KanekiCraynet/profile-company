<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} - PT Lestari Jaya Bangsa</title>

    <!-- Fonts - Professional Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=Lato:wght@400;700&family=Open+Sans:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Open Sans', 'Roboto', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', 'Inter', 'Lato', sans-serif;
        }
        .sidebar-link {
            transition: all 0.2s ease-in-out;
            position: relative;
        }
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-left: 3px solid #ffffff;
        }
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #ffffff;
        }
        
        /* Role Badge Colors */
        .role-super-admin {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .role-admin {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        .role-marketing {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
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
        
        /* Scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" 
             class="hidden md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300" 
             onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" 
               class="sidebar bg-gradient-to-b from-green-800 to-green-900 text-white w-64 py-6 px-4 fixed h-full overflow-y-auto z-50 shadow-2xl">
            <!-- Logo & Brand -->
            <div class="mb-8 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <span class="text-xl font-bold">LJB</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold font-heading">PT Lestari Jaya Bangsa</h1>
                        <p class="text-green-200 text-xs">Admin Panel</p>
                    </div>
                </div>
                <!-- Mobile close button -->
                <button onclick="toggleSidebar()" 
                        class="md:hidden text-white hover:text-green-200 transition-colors p-1 rounded-lg hover:bg-white/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="space-y-1 pb-24">
                <!-- Dashboard - All roles -->
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </div>
                </a>

                <!-- Products - Super Admin, Admin -->
                @can('view products')
                <a href="{{ route('admin.products.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span class="font-medium">Products</span>
                        </div>
                    </div>
                </a>
                @endcan

                <!-- Articles - Super Admin, Admin, Marketing -->
                @can('view articles')
                <a href="{{ route('admin.articles.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Articles</span>
                    </div>
                </a>
                @endcan

                <!-- Contacts - Super Admin, Admin -->
                @can('view contacts')
                <a href="{{ route('admin.contacts.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">Contacts</span>
                        </div>
                        @php
                            $unreadCount = \App\Models\Contact::where('status', 'unread')->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse">
                                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                            </span>
                        @endif
                    </div>
                </a>
                @endcan

                <!-- Chatbot - Super Admin, Admin, Marketing (read-only) -->
                @can('view chatbot')
                <div class="space-y-1 mt-4 pt-4 border-t border-green-700/50">
                    <div class="text-green-200 text-xs font-semibold px-4 py-2 uppercase tracking-wider">Chatbot</div>
                    @can('create chatbot')
                    <a href="{{ route('admin.chatbot.index') }}"
                       class="sidebar-link block py-2 px-6 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.chatbot.index') || request()->routeIs('admin.chatbot.create') || request()->routeIs('admin.chatbot.edit') ? 'active' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm">Rules</span>
                        </div>
                    </a>
                    @endcan
                    <a href="{{ route('admin.chatbot.history') }}"
                       class="sidebar-link block py-2 px-6 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.chatbot.history') ? 'active' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <span class="text-sm">History</span>
                        </div>
                    </a>
                </div>
                @endcan

                <!-- Divider for Super Admin Only -->
                @canany(['view users', 'view roles', 'view settings'])
                <div class="mt-4 pt-4 border-t border-green-700/50">
                    <div class="text-green-200 text-xs font-semibold px-4 py-2 uppercase tracking-wider">System</div>
                </div>
                @endcanany

                <!-- Users - Super Admin Only -->
                @can('view users')
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        <span class="font-medium">Users</span>
                    </div>
                </a>
                @endcan

                <!-- Roles & Permissions - Super Admin Only -->
                @can('view roles')
                <a href="{{ route('admin.roles.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="font-medium">Roles & Permissions</span>
                    </div>
                </a>
                @endcan

                <!-- Settings - Super Admin Only -->
                @can('view settings')
                <a href="{{ route('admin.settings.index') }}"
                   class="sidebar-link block py-3 px-4 rounded-lg hover:bg-green-700/50 transition-all {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </div>
                </a>
                @endcan
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-green-900/50 backdrop-blur-sm border-t border-green-700/50">
                <div class="bg-green-800/50 rounded-xl p-4 backdrop-blur-sm">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-700 rounded-full flex items-center justify-center mr-3 flex-shrink-0 shadow-lg ring-2 ring-white/20">
                            <span class="text-lg font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate font-heading">{{ auth()->user()->name }}</p>
                            @php
                                $roleName = auth()->user()->getRoleNames()->first() ?? 'User';
                                $roleClass = match($roleName) {
                                    'Super Admin' => 'role-super-admin',
                                    'Admin' => 'role-admin',
                                    'Marketing' => 'role-marketing',
                                    default => 'bg-gray-600'
                                };
                            @endphp
                            <span class="inline-block mt-1 px-2 py-0.5 {{ $roleClass }} text-white text-xs font-semibold rounded-full">
                                {{ $roleName }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('home') }}" 
                           target="_blank" 
                           class="flex-1 bg-white/10 hover:bg-white/20 text-white text-sm py-2 px-3 rounded-lg text-center transition-all duration-200 transform hover:scale-105 backdrop-blur-sm border border-white/20">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                View Site
                            </span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-red-600/80 hover:bg-red-700 text-white text-sm py-2 px-3 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 md:ml-64">
            <!-- Top bar -->
            <header class="bg-white shadow-md sticky top-0 z-30 border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button onclick="toggleSidebar()" 
                                    class="md:hidden mr-4 text-gray-600 hover:text-gray-900 transition-colors p-2 rounded-lg hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 font-heading">{{ $title ?? 'Dashboard' }}</h2>
                                @if(isset($breadcrumbs))
                                <nav class="text-sm text-gray-500 mt-1">
                                    {{ $breadcrumbs }}
                                </nav>
                                @endif
                            </div>
                        </div>
                        <div class="hidden sm:flex items-center space-x-4">
                            <!-- Notifications (if needed) -->
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">Welcome back,</span>
                                <span class="text-gray-900 font-semibold">{{ auth()->user()->name }}</span>
                            </div>
                            <!-- Current Time -->
                            <div class="text-xs text-gray-500 border-l border-gray-300 pl-4">
                                <div id="current-time" class="font-mono"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-4 sm:p-6 lg:p-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" 
                                class="text-green-700 hover:text-green-900 transition-colors ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" 
                                class="text-red-700 hover:text-red-900 transition-colors ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-md animate-fade-in">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <strong class="font-semibold">Please fix the following errors:</strong>
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-sm">
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
        // Sidebar Toggle Function
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
        
        // Update current time
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    second: '2-digit'
                });
                timeElement.textContent = timeString;
            }
        }
        
        // Update time every second
        setInterval(updateTime, 1000);
        updateTime(); // Initial call
        
        // Auto-close notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.bg-green-50, .bg-red-50');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.3s ease-out';
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            });
        });
    </script>
</body>
</html>
