<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        // Get featured products (limit to 6)
        $featuredProducts = Product::with('media')
            ->where('is_featured', true)
            ->where('is_active', true)
            ->limit(6)
            ->get();

        // Get latest articles (limit to 3)
        $latestArticles = Article::with('category')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get homepage content from settings/pages
        $homepageContent = \App\Models\Page::where('slug', 'home')->first();

        return view('frontend.homepage', compact('featuredProducts', 'latestArticles', 'homepageContent'));
    }
}