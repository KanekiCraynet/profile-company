<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $query = Article::with('category', 'author');

        // Apply search filter
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        // Apply status filter
        if (request('status')) {
            if (request('status') === 'published') {
                $query->where('is_published', true);
            } elseif (request('status') === 'draft') {
                $query->where('is_published', false);
            }
        }

        // Apply category filter
        if (request('category')) {
            $query->where('article_category_id', request('category'));
        }

        $articles = $query->paginate(15);
        $categories = ArticleCategory::orderBy('name')->get();
        
        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'article_category_id' => 'required|exists:article_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:article_tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'article_category_id' => $request->article_category_id,
            'author_id' => auth()->id(),
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->published_at ?? ($request->boolean('is_published') ? now() : null),
        ]);

        // Handle tags
        if ($request->tags) {
            $article->tags()->attach($request->tags);
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $filename = time() . '.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('uploads'), $filename);
            $article->update(['featured_image' => $filename]);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'article_category_id' => 'required|exists:article_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:article_tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'article_category_id' => $request->article_category_id,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->published_at ?? ($request->boolean('is_published') ? now() : null),
        ]);

        // Handle tags
        $article->tags()->sync($request->tags ?? []);

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image && file_exists(public_path('uploads/' . $article->featured_image))) {
                unlink(public_path('uploads/' . $article->featured_image));
            }

            $filename = time() . '.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('uploads'), $filename);
            $article->update(['featured_image' => $filename]);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Delete featured image
        if ($article->featured_image && file_exists(public_path('uploads/' . $article->featured_image))) {
            unlink(public_path('uploads/' . $article->featured_image));
        }

        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}