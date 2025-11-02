<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $herbalTeasCategory = ProductCategory::where('slug', 'herbal-teas')->first();
        $spicesCategory = ProductCategory::where('slug', 'spices-seasonings')->first();
        $supplementsCategory = ProductCategory::where('slug', 'health-supplements')->first();

        $products = [
            [
                'name' => 'Premium Ginger Tea Blend',
                'slug' => 'premium-ginger-tea-blend',
                'description' => 'A soothing blend of premium ginger root with natural herbs. Perfect for digestion and immune support.',
                'benefits' => 'Supports digestion, boosts immunity, natural anti-inflammatory properties.',
                'certifications' => ['halal_mui', 'bpom', 'natural'],
                'category_id' => $herbalTeasCategory?->id,
                'price' => 45000,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Organic Turmeric Powder',
                'slug' => 'organic-turmeric-powder',
                'description' => 'Pure organic turmeric powder, rich in curcumin. Sourced from the finest organic farms.',
                'benefits' => 'Powerful antioxidant, supports joint health, anti-inflammatory properties.',
                'certifications' => ['halal_mui', 'bpom', 'natural'],
                'category_id' => $spicesCategory?->id,
                'price' => 35000,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Natural Honey Blend',
                'slug' => 'natural-honey-blend',
                'description' => 'Pure natural honey blended with royal jelly. Rich in vitamins and minerals.',
                'benefits' => 'Boosts energy, supports immune system, natural sweetener.',
                'certifications' => ['halal_mui', 'bpom', 'natural'],
                'category_id' => $supplementsCategory?->id,
                'price' => 55000,
                'status' => 'active',
                'featured' => false,
            ],
        ];

        foreach ($products as $product) {
            $productData = $product;
            $productData['certifications'] = json_encode($product['certifications']);

            Product::firstOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }
    }
}