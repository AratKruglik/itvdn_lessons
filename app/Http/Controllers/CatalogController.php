<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);

        return view('catalog.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return View
     */
    public function show($slug): View
    {
        $product = Product::where('slug', $slug)->first();

        return view('catalog.product', ['product' => $product]);
    }
}
