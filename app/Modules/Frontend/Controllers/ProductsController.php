<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of products with filtering and search.
     */
    public function index(Request $request)
    {
        $cacheKey = 'products.index.' . md5(json_encode($request->all()));
        
        $data = Cache::remember($cacheKey, 1800, function () use ($request) {
            $query = Product::with(['category', 'media'])
                ->where('is_active', true);

            // Filter by category
            if ($request->filled('category')) {
                $query->where('product_category_id', $request->category);
            }

            // Search functionality
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%');
                });
            }

            // Sort options
            $sortBy = $request->get('sort', 'name');
            $sortDirection = $request->get('direction', 'asc');

            switch ($sortBy) {
                case 'name':
                    $query->orderBy('name', $sortDirection);
                    break;
                case 'price':
                    $query->orderBy('price', $sortDirection);
                    break;
                case 'created':
                    $query->orderBy('created_at', $sortDirection);
                    break;
                default:
                    $query->orderBy('name', 'asc');
            }

            return [
                'products' => $query->paginate(12),
                'categories' => ProductCategory::where('is_active', true)->orderBy('name')->get(),
            ];
        });

        return view('frontend.products.index', $data);
    }

    /**
     * Display the specified product.
     */
    public function show($slug)
    {
        $cacheKey = 'product.show.' . $slug;
        
        $data = Cache::remember($cacheKey, 3600, function () use ($slug) {
            $product = Product::with(['category', 'media'])
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            // Get related products from same category using repository
            $relatedProducts = $this->productRepository->getRelatedProducts(
                $product->id,
                $product->product_category_id,
                4
            );

            return [
                'product' => $product,
                'relatedProducts' => $relatedProducts,
            ];
        });

        return view('frontend.products.show', $data);
    }
}