<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->numerify('Product ###'),
        'description' => $faker->paragraphs(4, true),
        'price' => $faker->randomFloat(2, 1, 10000),
        'barcode' => $faker->ean8,
        'stock' => $faker->numberBetween(0, 999)
    ];
});
