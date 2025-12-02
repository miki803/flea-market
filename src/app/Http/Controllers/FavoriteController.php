<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteRequest;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //お気に入り追加
    public function store($product_id)
    {
        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
        ]);

        return back();
    }

    //お気に入り解除
    public function destroy($product_id)
    {
        Favorite::where('user_id', Auth::id())
                ->where('product_id', $product_id)
                ->delete();

        return back();
    }
}
