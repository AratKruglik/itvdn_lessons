<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'productId' => 'required|integer',
            'comment' => 'required'
        ]);

        $product = Product::findOrFail($request->productId);

        $comment = Comment::create($request->all());

        $product->comments()->save($comment);
        auth()->user()->comments()->save($comment);

        return redirect()->back();
    }
}
