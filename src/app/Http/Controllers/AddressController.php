<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // フォーム表示
    public function show($item_id)
    {
        $user = Auth::user();
        return view('purchase.address', compact('user', 'item_id'));
    }

   // 住所変更処理
    public function update(Request $request, $item_id)
    {
        $request->validate([
            'postal_code' => 'required|regex:/^\d{3}-\d{4}$/',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]));

        return redirect()->route('purchase.show', ['item_id' => $item_id])->with('success', '住所を更新しました！');
    }

}
