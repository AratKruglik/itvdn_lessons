<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        \App\Product::all()->each(function ($product) use ($faker) {
            $categories = [];

            for ($i = 0; $i < 4; $i++) {
                array_push($categories, $faker->numberBetween(1, 5));
            }

            $product->categories()->sync($categories);
        });
    }
}
