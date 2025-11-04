@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-container">

    <h2 class="register-title">会員登録</h2>

    <form class="register-form" action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="register-group">
            <label class="register-label" for="name">ユーザー名</label>
            <input class="register-input" class="register-input" type="text" id="name" name="name" value="{{ old('name') }}">
            <p class="error">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-group">
            <label class="register-label" for="email">メールアドレス</label>
            <input class="register-input" class="register-input" type="email" id="email" name="email" value="{{ old('email') }}">
            <p class="error">
                @error('email')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-group">
            <label class="register-label" for="password">パスワード</label>
            <input class="register-input" type="password" id="password" name="password">
            <p class="error">
                @error('password')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-group">
            <label class="register-label" for="password_confirmation">確認用パスワード</label>
            <input class="register-input" type="password" id="password_confirmation" name="password_confirmation">
            <p class="error">
                @error('password')
                {{ $message }}
                @enderror
            </p>
        </div>

        <button class="btn-submit" type="submit" >登録する</button>

        <p class="login-link">
            <a href="{{ route('login.show') }}">ログインはこちら</a>
        </p>
    </form>
</div>
@endsection