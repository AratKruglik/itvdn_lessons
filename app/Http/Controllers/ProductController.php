<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductFormRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::with(['categories'])->paginate();
        $trashedProducts = Product::onlyTrashed()->get();

        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
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
     * @return RedirectResponse
     */
    public function store(ProductFormRequest $request): RedirectResponse
    {
        $this->productService->storeProduct($request);

        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return View
     */
    public function edit(Product $product): View
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
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(ProductFormRequest $request, Product $product): RedirectResponse
    {
        $this->productService->updateProduct($request, $product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function delete(Product $product): RedirectResponse
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function restore(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        $this->authorize('restore', $product);

        $this->productService->restoreProduct($product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        $this->authorize('forceDelete', $product);

        $this->productService->destroyProduct($product);

        return redirect()->route('admin.products.index');
    }
}
