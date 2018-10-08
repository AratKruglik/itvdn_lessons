<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
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
     * @param Request $request
     * @param $productId
     * @param int $quantity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, $productId = null, $quantity = 1)
    {
        $this->validate($request, [
            'productId' => 'integer',
            'quantity' => 'integer'
        ]);

        $productId = $request->has('productId') ? $request->productId : $productId;

        $product = Product::findOrFail($productId);

        Cart::insert([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => $request->has('quantity') ? $request->quantity : $quantity
        ]);

        session()->flash('success', true);

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
//        $this->validate($request, [
//            'updateUser' => 'boolean'
//        ]);

        if ($request->has('updateUser')) {
            if (!auth()->guest()) {
                auth()->user()->update([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'email' => $request->customerEmail,
                    'phone' => $request->customerPhone
                ]);
            } else {
                User::updateOrNew([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'email' => $request->customerEmail,
                    'phone' => $request->customerPhone
                ]);
            }
        }

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
