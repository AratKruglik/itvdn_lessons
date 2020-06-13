<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductFormRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['categories'])->paginate();
        $trashedProducts = Product::onlyTrashed()->get();

        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = [];

        return view('admin.products.create', compact('categories', 'productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $product = Product::create($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = $product->categories()->pluck('id');

        return view('admin.products.edit', compact('product', 'categories', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        $product->update($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->sync($categoryId);
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        $this->authorize('restore', $product);
        $product->restore();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        $this->authorize('forceDelete', $product);
        $product->forceDelete();

        return redirect()->route('admin.products.index');
    }
}
