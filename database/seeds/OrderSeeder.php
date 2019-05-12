<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Product;
use App\Dish;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 5)->create();

        // Order detail one

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'dish_id' => Dish::all()->random()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'dish_id' => Dish::all()->random()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('orders_details')->insert([
            'order_id' => Order::first()->id,
            'product_id' => Product::all()->random()->id
        ]);

        // Order detail two

        DB::table('orders_details')->insert([
            'order_id' => Order::find(2)->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('orders_details')->insert([
            'order_id' => Order::find(2)->id,
            'product_id' => Product::all()->random()->id
        ]);
    }
}
