<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReturnOrder;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnOrderSeeder extends Seeder
{
    public function run(): void
    {

        $order = Order::findOrFail(3);

        DB::table('return_orders')->insert([
            'order_id' => 3,
            'product_id' => 3,
            'user_id' => 2,
            'return_date' => now(),
            'reason' => 'Item arrived with a slight scratch on the casing.',
            'return_status' => 'Pending Return',
            'return_quantity' => 1,
            'stock_restored' => false, //stock not updated yet
            'created_at' => now(),
            'updated_at'=>now()
        ]);

        $order->update(['order_status' => 'Pending Return']);

        $this->command->info('Seeded a Delivered order with 1 item pending return.');
    }
}
