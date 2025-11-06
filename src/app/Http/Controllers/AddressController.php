<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    // フォーム表示
    public function show($item_id)
    {
        $user = Auth::user();
        return view('purchase.address', compact('user', 'item_id'));
    }

   // 更新
    public function update(Request $request, $item_id)
    {
        $user = Auth::user();
        $user->update([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase.show', ['item_id' => $item_id])->with('success', '住所を更新しました！');
    }

}
