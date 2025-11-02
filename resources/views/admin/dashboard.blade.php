<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @can('view products')
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Total Products</h3>
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\Product::count() }}</p>
                </div>
            </div>
        </div>
        @endcan

        @can('view articles')
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Total Articles</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Article::count() }}</p>
                </div>
            </div>
        </div>
        @endcan

        @can('view contacts')
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">New Contacts</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ \App\Models\Contact::where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
        @endcan

        @can('view chatbot')
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Chat Sessions</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ \App\Models\ChatHistory::whereDate('created_at', today())->count() }}</p>
                </div>
            </div>
        </div>
        @endcan
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @can('view contacts')
        <!-- Recent Contacts -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Contacts</h3>
            </div>
            <div class="p-6">
                @php
                    $recentContacts = \App\Models\Contact::orderBy('created_at', 'desc')->limit(5)->get();
                @endphp

                @if($recentContacts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentContacts as $contact)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-600">{{ $contact->subject }}</p>
                                <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $contact->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($contact->status === 'responded' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.contacts.index') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            View all contacts →
                        </a>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No contacts yet</p>
                @endif
            </div>
        </div>
        @endcan

        @can('view articles')
        <!-- Recent Articles -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Articles</h3>
            </div>
            <div class="p-6">
                @php
                    $recentArticles = \App\Models\Article::with('author')->orderBy('created_at', 'desc')->limit(5)->get();
                @endphp

                @if($recentArticles->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentArticles as $article)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ Str::limit($article->title, 30) }}</p>
                                <p class="text-sm text-gray-600">By {{ $article->author->name ?? 'Unknown' }}</p>
                                <p class="text-xs text-gray-500">{{ $article->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $article->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.articles.index') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            View all articles →
                        </a>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No articles yet</p>
                @endif
            </div>
        </div>
        @endcan
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="flex flex-wrap gap-4">
            @can('create products')
                <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Add Product
                </a>
            @endcan
            @can('create articles')
                <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Add Article
                </a>
            @endcan
            @can('create chatbot')
                <a href="{{ route('admin.chatbot.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                    Add Chatbot Rule
                </a>
            @endcan
            @can('view analytics')
                <a href="#" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    View Analytics
                </a>
            @endcan
        </div>
    </div>
</x-admin-layout>