<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use \Cart;

class CartController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($productId)
    {
        $product = Product::findOrfail($productId);

        Cart::add($product->id, $product->title, 1, $product->price);

        return redirect()->back();
    }

    /**
     * @param CartUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CartUpdateRequest $request)
    {
        Cart::update($request->productId, $request->qty);

        return redirect()->route('cart.index');
    }

    /**
     * @param CartDropItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function drop(CartDropItemRequest $request)
    {
        Cart::remove($request->productId);

        return redirect()->route('cart.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        Cart::destroy();

        return redirect()->route('cart.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        return view('orders.checkout');
    }
}
