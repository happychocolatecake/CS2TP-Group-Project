<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Check if category exists, otherwise create it
        $categoryId = DB::table('product_category')->where('category_name', 'Gaming PCs')->value('category_id');

        if (!$categoryId) {
            $categoryId = DB::table('product_category')->insertGetId([
                'category_name' => 'Gaming PCs'
            ]);
        }

        // Add some dummy products
        DB::table('products')->insert([
            [
                'product_name' => 'RTX 4090 Beast',
                'product_price' => 3500,
                'product_description' => 'Ultimate gaming performance.',
                'category_id' => $categoryId,
                'product_createdate' => now(),
                'product_stock' => 10,
                'product_image' => '/images/cool_pc.jpg'
            ],
            [
                'product_name' => 'Starter Rig',
                'product_price' => 800,
                'product_description' => 'Perfect for 1080p gaming.',
                'category_id' => $categoryId,
                'product_createdate' => now(),
                'product_stock' => 5,
                'product_image' => '/images/cool_pc.jpg'
            ],
            [
                'product_name' => 'Streamer Pro',
                'product_price' => 2200,
                'product_description' => 'Optimized for streaming and editing.',
                'category_id' => $categoryId,
                'product_createdate' => now(),
                'product_stock' => 8,
                'product_image' => '/images/cool_pc.jpg'
            ]
        ]);
    }
}
