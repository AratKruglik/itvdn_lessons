<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex()
    {
        $catalog = Product::all()->take(12);

        return view('welcome', compact('catalog'));
    }
}
