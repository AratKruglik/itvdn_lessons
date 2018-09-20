<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{

    public function index()
    {
        return view('layouts.cart.cart');
    }

    public function checkout()
    {
        return view('layouts.cart.checkout');
    }


    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        Cart::insert([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => 1
        ]);

        return redirect()->back();
    }

    public function destroy()
    {
        Cart::destroy();

        return redirect()->back();
    }
}
