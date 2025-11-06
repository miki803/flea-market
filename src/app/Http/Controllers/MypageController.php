<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    // 出品・購入
    public function index()
    {
        $user = Auth::user();
        $tab = request('page', 'sell');
        $items = [];

        return view('mypage.main', compact('user', 'items', 'tab'));
    }

    // プロフィール編集画面
    public function edit()
    {
        $user = Auth::user();
        $isFirstLogin = !$user->postal_code && !$user->address;
        return view('mypage.profile', compact('user', 'isFirstLogin'));
    }

    // 更新処理
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        if ($request->hasFile('profile_image')) {
            if ($user->image_path && Storage::exists('public/' . $user->image_path)) {
                Storage::delete('public/' . $user->image_path);
        }
            $path = $request->file('profile_image')->store('profile', 'public');
            $user->image_path = $path;
        }
        $user->update([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('mypage.edit')->with('success', 'プロフィールを更新しました！');
    }

}
