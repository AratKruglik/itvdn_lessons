<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->numerify('Product ###'),
        'description' => $faker->paragraphs(4, true),
        'price' => $faker->randomFloat(2, 10, 999),
        'barcode' => $faker->ean8,
        'stock' => $faker->numberBetween(0, 999),
        'cover' => 'https://loremflickr.com/640/480/computer'
    ];
});
