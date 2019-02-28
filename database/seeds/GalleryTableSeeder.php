<?php

use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::all()->each(function ($product) {
            $gallery = factory(\App\Gallery::class)->create();
            $product->gallery()->save($gallery);
        });
    }
}
