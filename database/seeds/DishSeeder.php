<?php

use Illuminate\Database\Seeder;
use App\Dish;
use App\Product;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Dish::class, 10)->create();

        DB::table('dishes_detail')->insert([
            'dish_id' => Dish::first()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('dishes_detail')->insert([
            'dish_id' => Dish::first()->id,
            'product_id' => Product::all()->random()->id
        ]);

        DB::table('dishes_detail')->insert([
            'dish_id' => Dish::first()->id,
            'product_id' => Product::all()->random()->id
        ]);
    }
}
