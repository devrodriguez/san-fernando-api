<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create();

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'product_id' => Product::all()->random()->id
        ]);
    }
}
