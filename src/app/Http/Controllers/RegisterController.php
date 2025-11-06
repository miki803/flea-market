<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
  // 登録画面表示
    public function showForm()
    {
        return view('auth.register');
    }

    // 登録処理
    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.show')->with('success', '登録が完了しました。ログインしてください。');
    }
}
