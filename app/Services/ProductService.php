<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository
    ) {}

    /**
     * Get featured products with caching.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedProducts(int $limit = 6)
    {
        return Cache::remember("products.featured.{$limit}", 3600, function () use ($limit) {
            return $this->repository->getFeaturedProducts($limit);
        });
    }

    /**
     * Get active products with caching.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveProducts()
    {
        return Cache::remember('products.active', 3600, function () {
            return $this->repository->getActiveProducts();
        });
    }

    /**
     * Get product by slug.
     *
     * @param string $slug
     * @return \App\Models\Product|null
     */
    public function getBySlug(string $slug)
    {
        return Cache::remember("product.slug.{$slug}", 3600, function () use ($slug) {
            return $this->repository->findBySlug($slug);
        });
    }

    /**
     * Get related products.
     *
     * @param \App\Models\Product $product
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedProducts(Product $product, int $limit = 4)
    {
        return $this->repository->getRelatedProducts(
            $product->id,
            $product->product_category_id,
            $limit
        );
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function create(array $data): Product
    {
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Ensure slug is unique
        $originalSlug = $data['slug'];
        $counter = 1;
        while ($this->repository->findBy('slug', $data['slug'])) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        $product = $this->repository->create($data);

        // Clear cache
        Cache::forget('products.featured.*');
        Cache::forget('products.active');

        return $product;
    }

    /**
     * Update a product.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        // Update slug if name changed
        if (isset($data['name'])) {
            $product = $this->repository->find($id);
            if ($product && $product->name !== $data['name']) {
                $data['slug'] = Str::slug($data['name']);
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

        $result = $this->repository->update($id, $data);

        // Clear cache
        Cache::forget('products.featured.*');
        Cache::forget('products.active');
        if ($product = $this->repository->find($id)) {
            Cache::forget("product.slug.{$product->slug}");
        }

        return $result;
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = $this->repository->find($id);
        
        if ($product) {
            // Clear media cache
            $product->clearMediaCollection('images');
            Cache::forget("product.slug.{$product->slug}");
        }

        $result = $this->repository->delete($id);

        // Clear cache
        Cache::forget('products.featured.*');
        Cache::forget('products.active');

        return $result;
    }
}

