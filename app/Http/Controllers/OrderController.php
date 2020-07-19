<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use \Cart;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrderRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $order = $this->orderService->storeOrder($request);

        return redirect()->route('cart.success', ['orderId' => $order->id]);
    }
}
