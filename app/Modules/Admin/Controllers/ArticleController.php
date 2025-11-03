<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $this->authorize('view articles');

        $query = Article::with('category', 'author');

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%')
                  ->orWhere('excerpt', 'like', '%' . $searchTerm . '%');
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = ArticleCategory::where('is_active', true)->get();
        
        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $this->authorize('create articles');

        $categories = ArticleCategory::where('is_active', true)->get();
        $tags = ArticleTag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $article = Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'author_id' => auth()->id(),
            'is_published' => $request->boolean('is_published', false),
            'published_at' => $validated['published_at'] ?? ($request->boolean('is_published') ? now() : null),
            'featured' => $request->boolean('featured', false),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        // Handle tags
        if (!empty($validated['tags'])) {
            $article->tags()->attach($validated['tags']);
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles', 'public');
            $article->update(['featured_image' => $path]);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        $this->authorize('view articles');

        // Marketing can only view their own articles unless Super Admin or Admin
        if (auth()->user()->hasRole('Marketing') && !auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            if ($article->author_id !== auth()->id()) {
                abort(403, 'You can only view your own articles.');
            }
        }

        $article->load('category', 'author', 'tags');
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $this->authorize('edit articles');

        // Marketing can only edit their own articles unless Super Admin or Admin
        if (auth()->user()->hasRole('Marketing') && !auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            if ($article->author_id !== auth()->id()) {
                abort(403, 'You can only edit your own articles.');
            }
        }

        $article->load('tags');
        $categories = ArticleCategory::where('is_active', true)->get();
        $tags = ArticleTag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // Marketing can only update their own articles unless Super Admin or Admin
        if (auth()->user()->hasRole('Marketing') && !auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            if ($article->author_id !== auth()->id()) {
                abort(403, 'You can only update your own articles.');
            }
        }

        $validated = $request->validated();

        $article->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'is_published' => $request->boolean('is_published', false),
            'published_at' => $validated['published_at'] ?? ($request->boolean('is_published') && !$article->published_at ? now() : $article->published_at),
            'featured' => $request->boolean('featured', false),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        // Handle tags
        $article->tags()->sync($validated['tags'] ?? []);

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $path = $request->file('featured_image')->store('articles', 'public');
            $article->update(['featured_image' => $path]);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete articles');

        // Marketing can only delete their own articles unless Super Admin or Admin
        if (auth()->user()->hasRole('Marketing') && !auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            if ($article->author_id !== auth()->id()) {
                abort(403, 'You can only delete your own articles.');
            }
        }

        // Delete featured image
        if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
            Storage::disk('public')->delete($article->featured_image);
        }

        // Detach tags
        $article->tags()->detach();

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
