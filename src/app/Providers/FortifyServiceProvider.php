<?php


namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {
    //
    }

    public function boot(): void
    {
        // ビュー登録
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        // 登録時のユーザー作成クラス設定
        Fortify::createUsersUsing(CreateNewUser::class);

         // ログイン後の遷移先（商品一覧）
        Fortify::redirects('login', function (Request $request){
            return route('items.index');
        });

        //  新規登録後も商品一覧へ遷移（任意）
        Fortify::redirects('register', function (Request $request) {
            return route('items.index');
        });

    }

}