<?php

namespace App\Services;

use App\Http\Requests\ProductFormRequest;
use App\Product;
use \Exception;

class ProductService
{
    /**
     * @param ProductFormRequest $request
     */
    public function storeProduct(ProductFormRequest $request): void
    {
        $product = Product::create($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }
    }

    /**
     * @param ProductFormRequest $request
     * @param Product $product
     */
    public function updateProduct(ProductFormRequest $request, Product $product): void
    {
        $product->update($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->sync($categoryId);
        }
    }

    /**
     * @param Product $product
     * @throws Exception
     */
    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    /**
     * @param Product $product
     */
    public function restoreProduct(Product $product): void
    {
        $product->restore();
    }

    /**
     * @param Product $product
     */
    public function destroyProduct(Product $product): void
    {
        $product->forceDelete();
    }
}