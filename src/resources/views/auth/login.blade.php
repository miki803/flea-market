@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-container">

    <h2 class="login-title">ログイン</h2>

    <form class="login-form" action="{{ route('login') }}" method="POST" >
        @csrf

        <div class="form-group">
            <label class="login-label" for="email">メールアドレス</label>
            <input class="login-input" type="email" name="email" id="email" value="{{ old('email') }}" autofocus>

            <p class="error">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label class="login-label" for="password">パスワード</label>
            <input class="login-input" type="password" name="password" id="password" >
            <p class="error">
                @error('password')
                    {{ $message }}
                @enderror
            </p>
        </div>

        <button class="btn-login" type="submit" >ログインする</button>

        <p class="register-link">
            <a href="{{ route('register') }}">会員登録はこちら</a>
        </p>
    </form>
</div>
@endsection