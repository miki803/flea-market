<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    //ログイン画面表示
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    // 認証試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // セッション再生成
            return redirect()->intended('/'); // トップページなどへ
        }

        // 認証失敗時
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが違います。',
        ])->onlyInput('email');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }

}
