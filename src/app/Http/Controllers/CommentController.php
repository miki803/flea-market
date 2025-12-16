<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function store(CommentRequest $request, $item_id)
  {
      Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $item_id,
            'content' => $request->input('content'),
        ]);

      return redirect()
            ->route('item.show', ['item_id' => $item_id])
            ;
  }
}
