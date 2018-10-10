<?php

use Illuminate\Database\Seeder;

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
            $product->slug = str_slug($product->title, '-');
            $product->save();
            $product->categories()->attach($category);
        });
    }
}
