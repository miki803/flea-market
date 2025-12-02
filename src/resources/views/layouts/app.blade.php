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
                    <img src="{{ asset('images/coachtechlogo.png') }}" alt="COACHTECH">
                </a>
            </div>

            @auth
            <form class="header__search" action="{{ route('items.index') }}" method="get" >
                <input type="text" name="keyword" placeholder="なにをお探しですか？">
            </form>
            @endauth

            <div class="header__nav">
                @auth
                    <a class="header__logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>

                    <a class="header__mypage-btn" href="{{ route('mypage.index') }}">マイページ</a>
                    <a class="header__sell-btn" href="{{ route('item.create') }}" >出品</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

</body>
</html>