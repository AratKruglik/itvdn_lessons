<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('layouts.cart.cart');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        return view('layouts.cart.checkout');
    }


    /**
     * @param $productId
     * @param int $quantity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);

        Cart::insert([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => $quantity
        ]);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'productId' => 'required',
            'qty' => 'required|min:1'
        ]);


        if (Cart::has($request->productId) && $cartItem = Cart::item($request->productId)) {
            $cartItem->quantity = $request->qty;
        }

        return redirect()->route('cart.index');
    }

    /**
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function drop($productId)
    {
        if (Cart::has($productId) && $cartItem = Cart::item($productId)) {
            $cartItem->remove();
        }

        return redirect()->route('cart.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy()
    {
        Cart::destroy();

        return redirect('product');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function order(Request $request)
    {
        $this->validate($request, []);

        $order = Order::create($request->all());

        return redirect()->route('cart.order.success', ['orderId' => $order->id]);
    }

    /**
     * @param $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success($orderId)
    {
        $order= Order::findOrFail($orderId);

        return view('layouts.cart.success', compact('order'));
    }
}
