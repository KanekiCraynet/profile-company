<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomepageController extends Controller
{
    public function index()
    {
        // Get featured products with caching (limit to 6)
        $featuredProducts = Cache::remember('homepage.featured_products', 3600, function () {
            return Product::with('media')
                ->where('is_featured', true)
                ->where('is_active', true)
                ->limit(6)
                ->get();
        });

        // Get latest articles with caching (limit to 3)
        $latestArticles = Cache::remember('homepage.latest_articles', 1800, function () {
            return Article::with('category')
                ->where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        // Get homepage content from settings/pages with caching
        $homepageContent = Cache::remember('homepage.content', 3600, function () {
            return \App\Models\Page::where('slug', 'home')->first();
        });

        return view('frontend.homepage', compact('featuredProducts', 'latestArticles', 'homepageContent'));
    }
}