<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {
    //
    }

    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(20)->by(
            optional($request->user())->id ?: $request->ip()
            );
        });
        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });
        // 会員登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });
        //新規ユーザー登録
        Fortify::createUsersUsing(CreateNewUser::class);
        //ログイン後の遷移先
        Fortify::redirects('login', function (){
            return route('items.index');
        });
        // 新規登録後の遷移
        Fortify::redirects('register', '/mypage/profile');

        // ログイン認証
        Fortify::authenticateUsing(function (Request $request)
        {
            Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ], [
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレスはメール形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ])->validate();

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {

                return $user;
            }
            return null;
        });

    }

}