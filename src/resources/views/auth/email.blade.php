@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify.css') }}">
@endsection

@section('content')
<div class="verify-container">

    <p class="verify-text">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn-verify" type="submit" >認証はこちらから</button>
    </form>

    <div class="resend-link">
        <a>認証メールを再送する
        </a>
    </div>
</div>
@endsection