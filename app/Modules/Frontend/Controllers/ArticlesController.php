<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'tags', 'author'])
            ->where('is_published', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('article_category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
        }

        // Filter by tag
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        $articles = $query->orderBy('published_at', 'desc')->paginate(9);
        $categories = ArticleCategory::where('is_active', true)->get();

        return view('frontend.articles.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'tags', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Get related articles
        $relatedArticles = Article::with('category')
            ->where('article_category_id', $article->article_category_id)
            ->where('id', '!=', $article->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.articles.show', compact('article', 'relatedArticles'));
    }
}