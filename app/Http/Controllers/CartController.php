<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use \Cart;

class CartController extends Controller
{
    public function add($productId)
    {
        $product = Product::findOrfail($productId);

        Cart::add($product->id, $product->title, 1, $product->price);

        return redirect()->back();
    }
}
