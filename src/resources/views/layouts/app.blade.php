<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH フリマ</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="{{ route('items.index') }}">
                    <img src="{{ asset('images/logo_coachtech.png') }}" alt="COACHTECH">
                </a>
            </div>

            <form class="header__search" action="{{ route('items.index') }}" method="get" >
                <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
            </form>

            <nav class="header__nav">
                @auth
                    <a href="{{ route('logout') }}">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>

                    <a href="{{ route('mypage.index') }}">マイページ</a>
                    <a href="{{ route('item.create') }}" class="header__sell-btn">出品</a>
                @else
                    <a href="{{ route('login.show') }}">ログイン</a>
                    <a href="{{ route('register.show') }}">会員登録</a>
                    <a href="{{ route('login.show') }}" class="header__sell-btn">出品</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

</body>
</html>