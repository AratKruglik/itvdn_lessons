<?php

namespace App\Observers;

use App\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the product "creating" event.
     *
     * @param  Product  $product
     * @return void
     */
    public function creating(Product $product): void
    {
        $product->slug = Str::slug($product->title);
    }

    /**
     * Handle the product "creating" event.
     *
     * @param  Product  $product
     * @return void
     */
    public function updating(Product $product): void
    {
        $product->slug = Str::slug($product->title);
    }
}
