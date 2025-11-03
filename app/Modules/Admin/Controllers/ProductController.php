<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $this->authorize('view products');

        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $this->authorize('create products');

        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'benefits' => $validated['benefits'] ?? null,
            'usage_instructions' => $validated['usage_instructions'] ?? null,
            'product_category_id' => $validated['product_category_id'],
            'price' => $validated['price'] ?? null,
            'stock_quantity' => $validated['stock_quantity'] ?? 0,
            'is_halal_certified' => $request->boolean('is_halal_certified'),
            'is_bpom_certified' => $request->boolean('is_bpom_certified'),
            'is_natural' => $request->boolean('is_natural'),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $this->authorize('view products');

        $product->load('category', 'media');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $this->authorize('edit products');

        $product->load('media');
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'benefits' => $validated['benefits'] ?? null,
            'usage_instructions' => $validated['usage_instructions'] ?? null,
            'product_category_id' => $validated['product_category_id'],
            'price' => $validated['price'] ?? null,
            'stock_quantity' => $validated['stock_quantity'] ?? 0,
            'is_halal_certified' => $request->boolean('is_halal_certified'),
            'is_bpom_certified' => $request->boolean('is_bpom_certified'),
            'is_natural' => $request->boolean('is_natural'),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete products');

        // Delete associated media
        $product->clearMediaCollection('images');

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Remove a specific image from the product.
     */
    public function removeImage(Product $product, $mediaId)
    {
        $this->authorize('edit products');

        $media = $product->getMedia('images')->find($mediaId);
        
        if (!$media) {
            return back()->with('error', 'Image not found.');
        }

        $media->delete();

        return back()->with('success', 'Image removed successfully.');
    }
}
