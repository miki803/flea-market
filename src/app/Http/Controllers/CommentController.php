<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(CommentRequest $request, $item_id)
  {
      Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $item_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'コメントを投稿しました。');
  }
}
