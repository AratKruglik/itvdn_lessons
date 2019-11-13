<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use \Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add($productId)
    {
        $product = Product::findOrfail($productId);

        Cart::add($product->id, $product->title, 1, $product->price);

        return redirect()->back();
    }

    public function update(CartUpdateRequest $request)
    {
        Cart::update($request->productId, $request->qty);

        return redirect()->route('cart.index');
    }
}
