@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">
    <h2 class="profile-title">プロフィール設定</h2>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="profile-image">
            <div class="profile-image__preview">
                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-user.png') }}" alt="プロフィール画像">
            </div>
            <label class="btn-upload" for="profile_image">画像を選択する</label>
            <input type="file" id="profile_image" name="profile_image" hidden>
            @error('profile_image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="postal_code">郵便番号</label>
            <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}">
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" name="building" value="{{ old('building', $user->building) }}">
        </div>

        {{-- 初回か通常かでボタンを切り替え --}}
        @if ($isFirstLogin)
            <button type="submit" class="btn-save first">はじめる</button>
        @else
            <button type="submit" class="btn-save">更新する</button>
        @endif
    </form>
</div>
@endsection