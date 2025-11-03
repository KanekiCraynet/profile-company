<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('usage_instructions')->nullable()->after('benefits');
            $table->boolean('is_halal_certified')->default(false)->after('usage_instructions');
            $table->boolean('is_bpom_certified')->default(false)->after('is_halal_certified');
            $table->boolean('is_natural')->default(false)->after('is_bpom_certified');
            $table->integer('stock_quantity')->nullable()->after('price');
            $table->boolean('is_active')->default(true)->after('stock_quantity');
            $table->boolean('is_featured')->default(false)->after('is_active');

            // Rename category_id to product_category_id
            $table->renameColumn('category_id', 'product_category_id');
            // Rename status to is_active (but we already added is_active, so drop status)
            $table->dropColumn('status');
            // Rename featured to is_featured (but we already added is_featured, so drop featured)
            $table->dropColumn('featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'usage_instructions',
                'is_halal_certified',
                'is_bpom_certified',
                'is_natural',
                'stock_quantity',
                'is_active',
                'is_featured'
            ]);

            // Rename back
            $table->renameColumn('product_category_id', 'category_id');
            // Add back status and featured
            $table->string('status')->default('active')->after('price');
            $table->boolean('featured')->default(false)->after('status');
        });
    }
};
