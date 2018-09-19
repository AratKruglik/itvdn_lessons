<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 120)->create();

        $faker = Faker\Factory::create();
        \App\Product::all()->each(function ($product) use ($faker) {
            $category = \App\Category::find($faker->numberBetween(1, 5));
            $product->categories()->attach($category);
        });
    }
}
