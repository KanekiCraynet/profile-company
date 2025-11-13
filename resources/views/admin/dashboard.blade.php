<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <!-- Dashboard Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard Overview</h1>
                <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your website today.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <button onclick="refreshDashboard()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                    <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i>
                    Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-8">
        @can('view products')
        <div class="bg-gradient-to-br from-white to-green-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Products</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_products'] ?? 0 }}</p>
                    <p class="text-xs text-green-500 mt-2 font-medium">{{ $stats['active_products'] ?? 0 }} active</p>
                </div>
                <div class="p-4 bg-gradient-to-br from-green-100 to-green-200 rounded-xl shadow-sm">
                    <i data-lucide="package" class="w-6 h-6 text-green-600"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-green-600">
                <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                <span>{{ round((($stats['active_products'] ?? 1) / max($stats['total_products'] ?? 1, 1)) * 100) }}% active rate</span>
            </div>
        </div>
        @endcan

        @can('view articles')
        <div class="bg-gradient-to-br from-white to-blue-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Articles</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_articles'] ?? 0 }}</p>
                    <p class="text-xs text-blue-500 mt-2 font-medium">{{ $stats['published_articles'] ?? 0 }} published</p>
                </div>
                <div class="p-4 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl shadow-sm">
                    <i data-lucide="file-text" class="w-6 h-6 text-blue-600"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-blue-600">
                <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                <span>{{ round((($stats['published_articles'] ?? 1) / max($stats['total_articles'] ?? 1, 1)) * 100) }}% published</span>
            </div>
        </div>
        @endcan

        @can('view contacts')
        <div class="bg-gradient-to-br from-white to-yellow-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-yellow-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">New Contacts</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['unread_contacts'] ?? 0 }}</p>
                    <p class="text-xs text-yellow-500 mt-2 font-medium">{{ $stats['total_contacts'] ?? 0 }} total</p>
                </div>
                <div class="p-4 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl shadow-sm relative">
                    <i data-lucide="mail" class="w-6 h-6 text-yellow-600"></i>
                    @if(($stats['unread_contacts'] ?? 0) > 0)
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                    @endif
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-yellow-600">
                @if(($stats['unread_contacts'] ?? 0) > 0)
                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                    <span>{{ $stats['unread_contacts'] }} new messages</span>
                @else
                    <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                    <span>All messages read</span>
                @endif
            </div>
        </div>
        @endcan

        @can('view chatbot')
        <div class="bg-gradient-to-br from-white to-purple-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Today's Chats</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['today_chats'] ?? 0 }}</p>
                    <p class="text-xs text-purple-500 mt-2 font-medium">Chat sessions</p>
                </div>
                <div class="p-4 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl shadow-sm">
                    <i data-lucide="message-circle" class="w-6 h-6 text-purple-600"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-purple-600">
                <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
                <span>Active conversations</span>
            </div>
        </div>
        @endcan
    </div>

    <!-- Charts Section with Better Spacing -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8 mb-8">
        <div class="bg-white p-6 lg:p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Monthly Overview</h3>
                    <p class="text-sm text-gray-500 mt-1">Track your content performance over time</p>
                </div>
                <button onclick="refreshCharts()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="h-64">
                <canvas id="monthlyChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 lg:p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Content Distribution</h3>
                    <p class="text-sm text-gray-500 mt-1">Breakdown of your content types</p>
                </div>
                <div class="flex items-center text-sm text-green-600 font-medium">
                    <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
                    Live
                </div>
            </div>
            <div class="h-64">
                <canvas id="distributionChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <!-- Enhanced Recent Activity with Better Spacing -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8 mb-8">
        @can('view contacts')
        <!-- Recent Contacts -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Contacts</h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">
                    View All
                </a>
            </div>
            @if(isset($recentContacts) && $recentContacts->count() > 0)
                <div class="space-y-4">
                    @foreach($recentContacts as $contact)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex-1">
                            <div class="flex items-center mb-1">
                                <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                                    <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($contact->subject, 40) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between ml-11">
                                <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $contact->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                       ($contact->status === 'responded' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($contact->status ?? 'unread') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i data-lucide="mail-x" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                    <p class="text-gray-500">No contacts yet</p>
                </div>
            @endif
        </div>
        @endcan

        @can('view articles')
        <!-- Recent Articles -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Articles</h3>
                <a href="{{ route('admin.articles.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">
                    View All
                </a>
            </div>
            @if(isset($recentArticles) && $recentArticles->count() > 0)
                <div class="space-y-4">
                    @foreach($recentArticles as $article)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex-1">
                            <div class="flex items-center mb-1">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3">
                                    <i data-lucide="file-text" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ \Illuminate\Support\Str::limit($article->title, 30) }}</p>
                                    <p class="text-sm text-gray-600">By {{ $article->author->name ?? 'Unknown' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between ml-11">
                                <p class="text-xs text-gray-500">{{ $article->created_at->diffForHumans() }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($article->is_published ?? false) || ($article->status ?? 'draft') === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ($article->is_published ?? false) || ($article->status ?? 'draft') === 'published' ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i data-lucide="file-x" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                    <p class="text-gray-500">No articles yet</p>
                </div>
            @endif
        </div>
        @endcan
    </div>

    <!-- Enhanced Quick Actions with Better Layout -->
    <div class="bg-gradient-to-br from-white to-green-50 p-6 lg:p-8 rounded-2xl shadow-lg border border-green-100">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                <p class="text-sm text-green-600 mt-1">Get started with common tasks</p>
            </div>
            <div class="flex items-center text-sm text-green-600 font-medium">
                <i data-lucide="zap" class="w-4 h-4 mr-1"></i>
                Quick Access
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            @can('create products')
            <a href="{{ route('admin.products.create') }}"
               class="group flex items-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:bg-white/30 transition-colors">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-semibold">Add Product</p>
                    <p class="text-xs text-green-100">Create new product</p>
                </div>
            </a>
            @endcan

            @can('create articles')
            <a href="{{ route('admin.articles.create') }}"
               class="group flex items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:bg-white/30 transition-colors">
                    <i data-lucide="edit" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-semibold">Write Article</p>
                    <p class="text-xs text-blue-100">Create content</p>
                </div>
            </a>
            @endcan

            @can('create chatbot')
            <a href="{{ route('admin.chatbot.create') }}"
               class="group flex items-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:bg-white/30 transition-colors">
                    <i data-lucide="message-square-plus" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-semibold">Chatbot Rule</p>
                    <p class="text-xs text-purple-100">Configure AI</p>
                </div>
            </a>
            @endcan

            @can('view contacts')
            <a href="{{ route('admin.contacts.index') }}"
               class="group flex items-center p-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-xl hover:from-yellow-600 hover:to-orange-600 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                <div class="p-2 bg-white/20 rounded-lg mr-3 group-hover:bg-white/30 transition-colors">
                    <i data-lucide="mail-open" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-semibold">View Contacts</p>
                    <p class="text-xs text-yellow-100">Check messages</p>
                </div>
            </a>
            @endcan
        </div>
    </div>

    <!-- JavaScript for Charts and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Chart data from your Laravel stats
        const stats = @json($stats ?? []);

        // Monthly Overview Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Products',
                    data: [stats.total_products || 0, stats.total_products || 0, stats.total_products || 0,
                           stats.total_products || 0, stats.total_products || 0, stats.total_products || 0,
                           stats.total_products || 0, stats.total_products || 0, stats.total_products || 0,
                           stats.total_products || 0, stats.total_products || 0, stats.total_products || 0],
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Articles',
                    data: [0, 0, 0, 0, 0, 0, 0, stats.total_articles || 0, stats.total_articles || 0,
                           stats.total_articles || 0, stats.total_articles || 0, stats.total_articles || 0],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Content Distribution Chart
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        const distributionChart = new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Products', 'Articles', 'Contacts', 'Chat Sessions'],
                datasets: [{
                    data: [
                        stats.total_products || 0,
                        stats.total_articles || 0,
                        stats.total_contacts || 0,
                        stats.today_chats || 0
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(250, 204, 21, 0.8)',
                        'rgba(168, 85, 247, 0.8)'
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)',
                        'rgb(250, 204, 21)',
                        'rgb(168, 85, 247)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Refresh charts function
        function refreshCharts() {
            const button = event.target.closest('button');
            button.classList.add('animate-spin');
            button.disabled = true;

            // Simulate data refresh (in real app, you'd fetch new data)
            setTimeout(() => {
                monthlyChart.update();
                distributionChart.update();
                button.classList.remove('animate-spin');
                button.disabled = false;
            }, 1000);
        }

        // Refresh entire dashboard
        function refreshDashboard() {
            const button = event.target.closest('button');
            const originalContent = button.innerHTML;

            button.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 mr-2 animate-spin"></i> Refreshing...';
            button.disabled = true;

            // Re-initialize Lucide icons
            setTimeout(() => lucide.createIcons(), 100);

            setTimeout(() => {
                // Refresh charts
                monthlyChart.update();
                distributionChart.update();

                // Restore button
                button.innerHTML = originalContent;
                button.disabled = false;

                // Re-initialize icons again
                setTimeout(() => lucide.createIcons(), 100);
            }, 2000);
        }

        // Re-initialize Lucide icons when content updates
        setInterval(() => {
            lucide.createIcons();
        }, 1000);
    </script>
</x-admin-layout>