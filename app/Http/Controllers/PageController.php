<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        $products = Product::orderBy('created_at', 'desc')->take(12)->get();

        return view('welcome', compact('products'));
    }
}
