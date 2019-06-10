<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'code' => $faker->ean13,
        'description' => $faker->sentence(6),
        'price' => $faker->randomNumber(5),
        'img_url' => $faker->imageUrl(640, 480, 'food'),
        'available_amount' => 1
    ];
});

$factory->define(App\Dish::class, function(Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'price' => $faker->randomNumber(5),
        'img_url' => $faker->imageUrl(640, 480, 'food')
    ];
});

$factory->define(App\Order::class, function(Faker $faker) {
    return [
        'price' => $faker->randomNumber(4),
        'payment_method' => $faker->randomElement(array('E', 'T', 'D')),
        'carrier' => $faker->randomElement(array('RP', 'UB'))
    ];
});
