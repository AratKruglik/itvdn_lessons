<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Order;
use App\Product;
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

        $cartRow = Cart::add($product->id, $product->title, 1, $product->price);
        $cartRow->associate(Product::class);

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

    /**
     * @param $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('cart.success', compact('order'));
    }
}
