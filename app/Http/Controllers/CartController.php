<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function add($productId)
    {
        $cartId = 'shopping-cart.default';

        $product = Product::findOrFail($productId);

        Cart::instance('default')->add($product->id, $product->title, $product->price, 1);
        Cart::store($cartId);
        dump(Cart::content());

//        return redirect()->back();
    }
}
