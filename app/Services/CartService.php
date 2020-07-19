<?php

namespace App\Services;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Product;
use \Cart;

class CartService
{
    /**
     * @param int $productId
     */
    public function addProduct(int $productId): void
    {
        $product = Product::findOrfail($productId);

        $cartRow = Cart::add($product->id, $product->title, 1, $product->price);
        $cartRow->associate(Product::class);
    }

    /**
     * @param CartUpdateRequest $request
     */
    public function updateCart(CartUpdateRequest $request): void
    {
        Cart::update($request->productId, $request->qty);
    }

    /**
     * @param CartDropItemRequest $request
     */
    public function dropItem(CartDropItemRequest $request): void
    {
        Cart::remove($request->productId);
    }

    /**
     * Destroy Cart
     */
    public function destroyCart(): void
    {
        Cart::destroy();
    }
}