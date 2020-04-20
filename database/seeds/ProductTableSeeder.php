<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
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
            $product->slug = str_slug($product->title, '-');
            $product->save();

            $categories = [];

            for ($i = 0; $i < 4; $i++) {
                array_push($categories, $faker->numberBetween(1, 5));
            }

            $product->categories()->sync($categories);
        });
    }
}
