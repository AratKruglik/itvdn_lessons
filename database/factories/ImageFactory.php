<?php

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'path' => 'https://loremflickr.com/640/480/computer'
    ];
});
