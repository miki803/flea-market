<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    // 出品・購入
    public function index()
    {
        $user = Auth::user();
        $tab = request('page', 'sell');

        $items = $tab === 'buy'
            ? $user->purchases->map(fn($p) => $p->product)
            : $user->products;

        return view('mypage.main', compact('user', 'items', 'tab'));
    }

    // プロフィール編集画面
    public function edit(Request $request)
    {
        $user = Auth::user();
        $isFirstLogin = $request->query('first') == 1
                        || !$user->postal_code
                        || !$user->address;
        return view('mypage.profile', compact('user', 'isFirstLogin'));
    }

    // 更新処理
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->only(['name', 'postal_code', 'address', 'building']));

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->image = $path;
            $user->save();
        }
        if ($request->query('first') == 1) {
            return redirect()->route('items.index')->with('success', '登録が完了しました！');
        }


        return redirect()->route('mypage.index')->with('success', 'プロフィールを更新しました。');
    }

}
