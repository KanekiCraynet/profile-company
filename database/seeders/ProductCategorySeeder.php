<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Herbal Teas',
                'slug' => 'herbal-teas',
                'description' => 'Traditional herbal tea blends for health and wellness',
                'status' => 'active',
            ],
            [
                'name' => 'Spices & Seasonings',
                'slug' => 'spices-seasonings',
                'description' => 'Natural spices and seasonings for cooking',
                'status' => 'active',
            ],
            [
                'name' => 'Health Supplements',
                'slug' => 'health-supplements',
                'description' => 'Natural health supplements and vitamins',
                'status' => 'active',
            ],
            [
                'name' => 'Essential Oils',
                'slug' => 'essential-oils',
                'description' => 'Pure essential oils for aromatherapy and wellness',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}