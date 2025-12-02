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
    public function store(PurchaseRequest $request, $item_id)
    {
        $item = Product::findOrFail($item_id);

        if ($item->is_sold) {
            return redirect()
                ->route('items.index')
                ->with('error', 'この商品はすでに購入されています。');
        }
        $user = Auth::user();
        return view('purchase.buy', compact('item', 'user'));

        Purchase::create([
            'user_id' => Auth::id(),
            'product_id' => $item->id,
            'payment_method' => $request->payment_method,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $item->update([
            'is_sold' => true,
        ]);

        return redirect()->route('mypage.index');
    }
}
