<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ArticleService
{
    public function __construct(
        protected ArticleRepository $repository
    ) {}

    /**
     * Get published articles with caching.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublishedArticles()
    {
        return Cache::remember('articles.published', 1800, function () {
            return $this->repository->getPublishedArticles();
        });
    }

    /**
     * Get latest articles with caching.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatestArticles(int $limit = 6)
    {
        return Cache::remember("articles.latest.{$limit}", 1800, function () use ($limit) {
            return $this->repository->getLatestArticles($limit);
        });
    }

    /**
     * Get featured articles with caching.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedArticles(int $limit = 3)
    {
        return Cache::remember("articles.featured.{$limit}", 1800, function () use ($limit) {
            return $this->repository->getFeaturedArticles($limit);
        });
    }

    /**
     * Get article by slug.
     *
     * @param string $slug
     * @return \App\Models\Article|null
     */
    public function getBySlug(string $slug)
    {
        return Cache::remember("article.slug.{$slug}", 1800, function () use ($slug) {
            return $this->repository->findBySlug($slug);
        });
    }

    /**
     * Get related articles.
     *
     * @param \App\Models\Article $article
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedArticles(Article $article, int $limit = 4)
    {
        $tagIds = $article->tags ? $article->tags : [];
        
        return $this->repository->getRelatedArticles(
            $article->id,
            $article->category_id,
            $tagIds,
            $limit
        );
    }

    /**
     * Increment article view count.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function incrementViews(Article $article): void
    {
        // View count tracking disabled - column not available in database
        // $article->increment('view_count');
        Cache::forget("article.slug.{$article->slug}");
    }

    /**
     * Create a new article.
     *
     * @param array $data
     * @return \App\Models\Article
     */
    public function create(array $data): Article
    {
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Ensure slug is unique
        $originalSlug = $data['slug'];
        $counter = 1;
        while ($this->repository->findBy('slug', $data['slug'])) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Auto-generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['title'];
        }

        // Auto-generate meta description if not provided
        if (empty($data['meta_description']) && !empty($data['excerpt'])) {
            $data['meta_description'] = Str::limit($data['excerpt'], 160);
        } elseif (empty($data['meta_description'])) {
            $data['meta_description'] = Str::limit(strip_tags($data['content']), 160);
        }

        // Set published_at if not set and is_published is true
        if (empty($data['published_at']) && ($data['is_published'] ?? false)) {
            $data['published_at'] = now();
        }

        $article = $this->repository->create($data);

        // Clear cache
        $this->clearCache();

        return $article;
    }

    /**
     * Update an article.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        // Update slug if title changed
        if (isset($data['title'])) {
            $article = $this->repository->find($id);
            if ($article && $article->title !== $data['title']) {
                $data['slug'] = Str::slug($data['title']);
                // Ensure slug is unique
                $originalSlug = $data['slug'];
                $counter = 1;
                while ($this->repository->findBy('slug', $data['slug']) && 
                       $this->repository->findBy('slug', $data['slug'])->id !== $id) {
                    $data['slug'] = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        }

        // Auto-generate meta fields if not provided
        if (isset($data['title']) && empty($data['meta_title'])) {
            $data['meta_title'] = $data['title'];
        }

        if (isset($data['excerpt']) && empty($data['meta_description'])) {
            $data['meta_description'] = Str::limit($data['excerpt'], 160);
        } elseif (isset($data['content']) && empty($data['meta_description'])) {
            $data['meta_description'] = Str::limit(strip_tags($data['content']), 160);
        }

        // Set published_at if not set and is_published is true
        if (isset($data['is_published']) && $data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $result = $this->repository->update($id, $data);

        // Clear cache
        $article = $this->repository->find($id);
        if ($article) {
            Cache::forget("article.slug.{$article->slug}");
        }
        $this->clearCache();

        return $result;
    }

    /**
     * Delete an article.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $article = $this->repository->find($id);
        
        if ($article) {
            Cache::forget("article.slug.{$article->slug}");
        }

        $result = $this->repository->delete($id);

        // Clear cache
        $this->clearCache();

        return $result;
    }

    /**
     * Clear article cache.
     *
     * @return void
     */
    protected function clearCache(): void
    {
        Cache::forget('articles.published');
        Cache::forget('articles.latest.*');
        Cache::forget('articles.featured.*');
    }
}

