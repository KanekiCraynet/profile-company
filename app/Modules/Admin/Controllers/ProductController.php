<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'benefits' => 'nullable|string',
            'usage_instructions' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_halal_certified' => 'boolean',
            'is_bpom_certified' => 'boolean',
            'is_natural' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'benefits' => $request->benefits,
            'usage_instructions' => $request->usage_instructions,
            'product_category_id' => $request->product_category_id,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'is_halal_certified' => $request->boolean('is_halal_certified'),
            'is_bpom_certified' => $request->boolean('is_bpom_certified'),
            'is_natural' => $request->boolean('is_natural'),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('products');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'benefits' => 'nullable|string',
            'usage_instructions' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_halal_certified' => 'boolean',
            'is_bpom_certified' => 'boolean',
            'is_natural' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'benefits' => $request->benefits,
            'usage_instructions' => $request->usage_instructions,
            'product_category_id' => $request->product_category_id,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'is_halal_certified' => $request->boolean('is_halal_certified'),
            'is_bpom_certified' => $request->boolean('is_bpom_certified'),
            'is_natural' => $request->boolean('is_natural'),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('products');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function removeImage(Product $product, $mediaId)
    {
        $media = $product->getMedia('products')->find($mediaId);
        if ($media) {
            $media->delete();
        }
        return back()->with('success', 'Image removed successfully.');
    }
}