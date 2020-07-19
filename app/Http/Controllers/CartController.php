<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Order;
use App\Services\CartService;
use \Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('cart.index');
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function add($productId): RedirectResponse
    {
       $this->cartService->addProduct($productId);

        return redirect()->back();
    }

    /**
     * @param CartUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(CartUpdateRequest $request): RedirectResponse
    {
        $this->cartService->updateCart($request);

        return redirect()->route('cart.index');
    }

    /**
     * @param CartDropItemRequest $request
     * @return RedirectResponse
     */
    public function drop(CartDropItemRequest $request): RedirectResponse
    {
        $this->cartService->updateCart($request);

        return redirect()->route('cart.index');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $this->cartService->destroyCart();

        return redirect()->route('cart.index');
    }

    /**
     * @return View
     */
    public function checkout(): View
    {
        return view('orders.checkout');
    }

    /**
     * @param $orderId
     * @return View
     */
    public function success($orderId): View
    {
        $order = Order::findOrFail($orderId);

        return view('cart.success', compact('order'));
    }
}
