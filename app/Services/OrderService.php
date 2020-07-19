<?php

namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Order;
use App\OrderItem;
use App\User;
use \Cart;

class OrderService
{
    /**
     * @param StoreOrderRequest $request
     * @return Order
     */
    public function storeOrder(StoreOrderRequest $request): Order
    {
        $order = Order::create([
            'customerName' => $request->customerName,
            'customerLastName' => $request->customerLastName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'comment' => $request->customerComment,
            'total' => Cart::total(),
        ]);

        foreach (Cart::content() as $cartRow) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartRow->model->id,
                'price' => $cartRow->model->price,
                'quantity' => $cartRow->qty,
            ]);
        }

        if ($request->has('updateUser')) {
            $user = auth()->guest() ? User::where('email', $request->customerEmail)->first() : auth()->user();

            if (!is_null($user)) {
                $user->update([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'email' => $request->customerEmail,
                    'phone' => $request->customerPhone,
                    'address' => $request->customerAddress,
                ]);

                $order->update([
                    'user_id' => $user->id,
                ]);
            }
        }

        Cart::destroy();

        return $order;
    }
}