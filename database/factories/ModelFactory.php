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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(1),
        'code' => $faker->ean13,
        'description' => $faker->sentence(6),
        'price_per_unit' => $faker->randomNumber(4),
        'image_url' => $faker->imageUrl(640, 480, 'food')      
    ];
});
