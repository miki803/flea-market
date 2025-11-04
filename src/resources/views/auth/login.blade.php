@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-container">

    <h2 class="login-title">ログイン</h2>

    <form action="{{ route('login.post') }}" method="POST" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email') 
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn-login" type="submit" >ログインする</button>

        <p class="register-link">
            <a href="{{ route('register.show') }}">会員登録はこちら</a>
        </p>
    </form>
</div>
@endsection