<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {
    //
    }

    public function boot(): void
    {
        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });
        // 会員登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
         // ログイン後の遷移先（商品一覧）
        Fortify::redirects('login', function (Request $request){
            return route('items.index');
        });
        //  新規登録後の遷移
        Fortify::redirects('register', function ($request) {
            return route('mypage.edit', ['first' => 1]);
        });

        // ログイン認証
        Fortify::authenticateUsing(function (LoginRequest $request)
        {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)
            ){
                return $user;
            }
            return null;
        });

    }

}