<?php

use App\Gallery;
use App\Product;
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
        Product::all()->each(function ($product) {
            $gallery = factory(Gallery::class)->create();
            $product->gallery()->save($gallery);
        });
    }
}
