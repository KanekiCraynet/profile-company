<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomepageController extends Controller
{
    /**
     * Display the homepage with dynamic content.
     */
    public function index()
    {
        // Get featured products with caching (limit to 6)
        $featuredProducts = Cache::remember('homepage.featured_products', 3600, function () {
            return Product::with(['media', 'category'])
                ->where('is_featured', true)
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        });

        // Get latest articles with caching (limit to 3)
        $latestArticles = Cache::remember('homepage.latest_articles', 1800, function () {
            return Article::with(['category', 'author'])
                ->where('status', 'published')
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        // Get homepage content from pages table with caching
        $homepageContent = Cache::remember('homepage.content', 3600, function () {
            return Page::where('slug', 'home')
                ->where('status', 'active')
                ->first();
        });

        // Get company settings for hero section
        $companyName = Cache::remember('settings.company_name', 3600, function () {
            return Setting::get('company_name', 'PT Lestari Jaya Bangsa');
        });

        $companyTagline = Cache::remember('settings.company_tagline', 3600, function () {
            return Setting::get('company_tagline', 'Food & Herbal — Health and Flavour, United in One Choice');
        });

        $companyDescription = Cache::remember('settings.company_description', 3600, function () {
            return Setting::get('company_description', 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products, committed to prioritising both health and taste. With experience and innovation, the company continues to earn consumer trust while expanding towards the global market.');
        });

        // SEO meta data
        $seoTitle = $homepageContent?->meta_title ?? Setting::get('seo_title', $companyName . ' - Food & Herbal Products');
        $seoDescription = $homepageContent?->meta_description ?? Setting::get('seo_description', $companyDescription);
        $seoKeywords = Setting::get('seo_keywords', 'herbal, food, natural products, halal, BPOM, PT Lestari Jaya Bangsa');

        return view('frontend.homepage', compact(
            'featuredProducts',
            'latestArticles',
            'homepageContent',
            'companyName',
            'companyTagline',
            'companyDescription',
            'seoTitle',
            'seoDescription',
            'seoKeywords'
        ));
    }
}