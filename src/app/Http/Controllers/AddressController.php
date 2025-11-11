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
    public function update(AddressRequest $request, $item_id)
    {
        $user = Auth::user();
        $validated = $request->validated();

        $user->update($request->only([
            'postal_code' => $validated['postal_code'],
            'address'     => $validated['address'],
            'building'    => $request->building,
        ]));

        return redirect()
            ->route('purchase.show', ['item_id' => $item_id])
            ->with('success', '住所を更新しました！');
    }

}
