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
                    <img src="{{ asset('images/coachtechlogo.svg') }}" alt="COACHTECH">
                </a>
            </div>

            <form class="header__search" action="{{ route('items.index') }}" method="get" >
                <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
            </form>

            <nav class="header__nav">
                @auth
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>

                    <a href="{{ route('mypage.index') }}">マイページ</a>
                    <a class="header__sell-btn" href="{{ route('item.create') }}" >出品</a>
                @else
                    <a href="{{ route('login') }}">ログイン</a>
                    <a href="{{ route('register') }}">会員登録</a>
                    <a class="header__sell-btn" href="{{ route('login') }}" >出品</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

</body>
</html>