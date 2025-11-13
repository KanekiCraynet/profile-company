<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <!-- Welcome Section -->
    <div class="mb-8 reveal">
        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-2 font-heading">
                        Welcome back, {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-green-100 text-lg">
                        @php
                            $roleName = auth()->user()->getRoleNames()->first() ?? 'User';
                        @endphp
                        You're logged in as <strong>{{ $roleName }}</strong>
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        @can('view products')
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 reveal card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 rounded-xl">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-green-600 font-heading">{{ $stats['total_products'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $stats['active_products'] ?? 0 }} active</p>
                </div>
            </div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">Total Products</h3>
            <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span>All products</span>
            </div>
            <a href="{{ route('admin.products.index') }}" 
               class="mt-4 inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium transition-colors">
                Manage Products →
            </a>
        </div>
        @endcan

        @can('view articles')
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 reveal card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-blue-600 font-heading">{{ $stats['total_articles'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $stats['published_articles'] ?? 0 }} published</p>
                </div>
            </div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">Total Articles</h3>
            <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span>All articles</span>
            </div>
            <a href="{{ route('admin.articles.index') }}" 
               class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
                Manage Articles →
            </a>
        </div>
        @endcan

        @can('view contacts')
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 reveal card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-100 rounded-xl">
                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-yellow-600 font-heading">{{ $stats['unread_contacts'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $stats['total_contacts'] ?? 0 }} total</p>
                </div>
            </div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">New Contacts</h3>
            <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Requires attention</span>
            </div>
            <a href="{{ route('admin.contacts.index') }}" 
               class="mt-4 inline-flex items-center text-yellow-600 hover:text-yellow-700 text-sm font-medium transition-colors">
                View Contacts →
            </a>
        </div>
        @endcan

        @can('view chatbot')
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 reveal card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-100 rounded-xl">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-purple-600 font-heading">{{ $stats['today_chats'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Chat sessions</p>
                </div>
            </div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">Today's Chats</h3>
            <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Today</span>
            </div>
            <a href="{{ route('admin.chatbot.history') }}" 
               class="mt-4 inline-flex items-center text-purple-600 hover:text-purple-700 text-sm font-medium transition-colors">
                View History →
            </a>
        </div>
        @endcan
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 mb-8">
        @can('view contacts')
        <!-- Recent Contacts -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 reveal">
            <div class="px-6 py-4 bg-gradient-to-r from-yellow-50 to-yellow-100 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 font-heading flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Recent Contacts
                    </h3>
                    <span class="text-xs text-gray-500">{{ $stats['total_contacts'] ?? 0 }} total</span>
                </div>
            </div>
            <div class="p-6">
                @if(isset($recentContacts) && $recentContacts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentContacts->take(5) as $contact)
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors border border-gray-100">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    <p class="font-semibold text-gray-900 truncate">{{ $contact->name }}</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $contact->status === 'unread' ? 'bg-yellow-100 text-yellow-800 animate-pulse' :
                                           ($contact->status === 'responded' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($contact->status ?? 'unread') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 truncate">{{ $contact->subject }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $contact->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                               class="ml-4 text-yellow-600 hover:text-yellow-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.contacts.index') }}" 
                           class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold transition-colors">
                            <span>View all contacts</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">No contacts yet</p>
                        <p class="text-sm text-gray-400 mt-1">New contact messages will appear here</p>
                    </div>
                @endif
            </div>
        </div>
        @endcan

        @can('view articles')
        <!-- Recent Articles -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 reveal">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 font-heading flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Recent Articles
                    </h3>
                    <span class="text-xs text-gray-500">{{ $stats['total_articles'] ?? 0 }} total</span>
                </div>
            </div>
            <div class="p-6">
                @if(isset($recentArticles) && $recentArticles->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentArticles->take(5) as $article)
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors border border-gray-100">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    <p class="font-semibold text-gray-900 truncate">{{ \Illuminate\Support\Str::limit($article->title, 40) }}</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ ($article->is_published ?? false) || ($article->status ?? 'draft') === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ($article->is_published ?? false) || ($article->status ?? 'draft') === 'published' ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">
                                    By <span class="font-medium">{{ $article->author->name ?? 'Unknown' }}</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $article->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('admin.articles.show', $article->id) }}" 
                               class="ml-4 text-blue-600 hover:text-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.articles.index') }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                            <span>View all articles</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">No articles yet</p>
                        <p class="text-sm text-gray-400 mt-1">Create your first article to get started</p>
                    </div>
                @endif
            </div>
        </div>
        @endcan
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 reveal">
        <h3 class="text-lg font-bold text-gray-900 mb-6 font-heading flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Quick Actions
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @can('create products')
                <a href="{{ route('admin.products.create') }}" 
                   class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 text-green-700 px-6 py-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg border border-green-200">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-600 text-white rounded-lg mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Add Product</p>
                            <p class="text-xs text-green-600 opacity-75">Create new product</p>
                        </div>
                    </div>
                </a>
            @endcan
            @can('create articles')
                <a href="{{ route('admin.articles.create') }}" 
                   class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-700 px-6 py-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg border border-blue-200">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-600 text-white rounded-lg mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Add Article</p>
                            <p class="text-xs text-blue-600 opacity-75">Create new article</p>
                        </div>
                    </div>
                </a>
            @endcan
            @can('create chatbot')
                <a href="{{ route('admin.chatbot.create') }}" 
                   class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 text-purple-700 px-6 py-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg border border-purple-200">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-600 text-white rounded-lg mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Add Rule</p>
                            <p class="text-xs text-purple-600 opacity-75">Chatbot rule</p>
                        </div>
                    </div>
                </a>
            @endcan
            @can('view analytics')
                <a href="#" 
                   class="group bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-100 hover:to-gray-200 text-gray-700 px-6 py-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-2 bg-gray-600 text-white rounded-lg mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Analytics</p>
                            <p class="text-xs text-gray-600 opacity-75">View statistics</p>
                        </div>
                    </div>
                </a>
            @endcan
        </div>
    </div>
</x-admin-layout>

