<?php

namespace App\Listeners;

use App\OrderItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Mail;
//use Moltin\Cart\Cart;

class OrderCreatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCreated $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        foreach (\Cart::contents() as $cartItem) {
            OrderItem::create([
                'order_id' => $event->order->id,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity
            ]);
        }

        $event->order->update(['total' => \Cart::total()]);
        \Cart::destroy();

//        Mail::to($event->order->user->email);

        return redirect('product');
    }
}
