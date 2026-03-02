<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Review;

use function Symfony\Component\Clock\now;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        DB::table('reviews')->insert([
            [
                'rating' => 5,
                'review_image' => null,
                'review_text' => 'A very fast and good quality cpu.',
                'review_date' => now(),
                'user_id' => 1,
                'order_id' => 1,
                'product_id' => 3,
                'created_at' => now()
            ],
            [
                'rating' => 3,
                'review_image' => null,
                'review_text' => 'A perfect pc cpu.',
                'review_date' => now(),
                'user_id' => 2,
                'order_id' => 2,
                'product_id' => 3,
                'created_at' => now()
            ],
            [
                'rating' => 5,
                'review_image' => 'plant_ryzen.jpg',
                'review_text' => 'I love this cpu, its cheap and very good quality!',
                'review_date' => now(),
                'user_id' => 2,
                'order_id' => 2,
                'product_id' => 26,
                'created_at' => now()
            ]
        ]);

        //make sure we have some delivered orders
        if (Order::count() == 0) {
            Order::factory(20)->create(['order_status' => 'Delivered']);
        }

        //obtain 50 different reviews for user 1 and 2
        Review::factory(20)->create();

        $this->command->info('...20 reviews generated for users 1 and 2!');
    }
}
