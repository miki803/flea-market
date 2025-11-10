<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 購入フォーム表示
    public function showForm($item_id)
    {
        $item = Product::findOrFail($item_id);
        $user = Auth::user();
        return view('purchase.buy', compact('item', 'user'));
    }

    // 購入処理
    public function store(Request $request, $item_id)
    {
        $item = Product::findOrFail($item_id);

        Purchase::create([
            'user_id' => Auth::id(),
            'product_id' => $item->id,
            'payment_method' => $request->payment_method,
            'postal_code' => Auth::user()->postal_code,
            'address' => Auth::user()->address,
            'building' => Auth::user()->building,
        ]);
        return redirect()->route('mypage.index')->with('success', '購入が完了しました！');
    }




}
