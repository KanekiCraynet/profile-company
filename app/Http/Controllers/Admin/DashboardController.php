<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use App\Models\Contact;
use App\Models\ChatHistory;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index()
    {
        $user = auth()->user();

        // Determine dashboard view based on role
        if ($user->hasRole('Super Admin')) {
            return $this->superAdminDashboard();
        } elseif ($user->hasRole('Admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('Marketing')) {
            return $this->marketingDashboard();
        }

        // Default fallback
        return $this->adminDashboard();
    }

    /**
     * Super Admin Dashboard
     */
    protected function superAdminDashboard()
    {
        $stats = Cache::remember('superadmin_dashboard_stats', 3600, function () {
            return [
                'total_users' => User::count(),
                'total_products' => Product::count(),
                'active_products' => Product::where('is_active', true)->count(),
                'total_articles' => Article::count(),
                'published_articles' => Article::where('status', 'published')->count(),
                'total_contacts' => Contact::count(),
                'unread_contacts' => Contact::where('status', 'unread')->count(),
                'today_chats' => ChatHistory::whereDate('created_at', today())->count(),
                'total_chats' => ChatHistory::count(),
            ];
        });

        $recentContacts = Contact::orderBy('created_at', 'desc')->limit(5)->get();
        $recentArticles = Article::with('author')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();

        return view('superadmin.dashboard', compact('stats', 'recentContacts', 'recentArticles', 'recentUsers'));
    }

    /**
     * Admin Dashboard
     */
    protected function adminDashboard()
    {
        $stats = Cache::remember('admin_dashboard_stats', 3600, function () {
            return [
                'total_products' => Product::count(),
                'active_products' => Product::where('is_active', true)->count(),
                'featured_products' => Product::where('is_featured', true)->where('is_active', true)->count(),
                'total_articles' => Article::count(),
                'published_articles' => Article::where('status', 'published')->count(),
                'total_contacts' => Contact::count(),
                'unread_contacts' => Contact::where('status', 'unread')->count(),
                'today_chats' => ChatHistory::whereDate('created_at', today())->count(),
            ];
        });

        $recentContacts = Contact::orderBy('created_at', 'desc')->limit(5)->get();
        $recentArticles = Article::with('author')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentArticles'));
    }

    /**
     * Marketing Dashboard
     */
    protected function marketingDashboard()
    {
        $user = auth()->user();
        
        $stats = Cache::remember("marketing_dashboard_stats_{$user->id}", 3600, function () use ($user) {
            return [
                'my_articles' => Article::where('author_id', $user->id)->count(),
                'published_articles' => Article::where('author_id', $user->id)
                    ->where('status', 'published')->count(),
                'draft_articles' => Article::where('author_id', $user->id)
                    ->where('status', 'draft')->count(),
                'today_chats' => ChatHistory::whereDate('created_at', today())->count(),
                'total_chats' => ChatHistory::count(),
            ];
        });

        $myRecentArticles = Article::where('author_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $recentChats = ChatHistory::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('marketing.dashboard', compact('stats', 'myRecentArticles', 'recentChats'));
    }
}
