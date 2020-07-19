<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('admin.index');
    }
}
