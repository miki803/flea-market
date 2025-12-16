@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/main.css') }}">
@endsection

@section('content')
<div class="mypage-container">

  {{-- プロフィール情報 --}}
    <div class="profile-header">
        <div class="profile-left">
            <div class="profile-image">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="プロフィール画像">
                @else
                <div class="placeholder">画像</div>
                @endif
            </div>
            <h2 class="user-name">{{ $user->name }}</h2>
        </div>
        <div class="profile-right">
            <a href="{{ route('mypage.edit') }}" class="btn-edit">プロフィールを編集</a>
        </div>
    </div>

  {{-- タブ切り替え --}}
    <div class="tab-menu">
        <a href="{{ route('mypage.index', ['page' => 'sell']) }}" class="{{ $tab === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="{{ route('mypage.index', ['page' => 'buy']) }}" class="{{ $tab === 'buy' ? 'active' : '' }}">購入した商品</a>
    </div>

  {{-- 商品一覧 --}}
    <div class="item-list">
        @forelse ($items as $item)
            <div class="item-card">
                <div class="item-image">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                    @else
                        <div class="placeholder">商品画像</div>
                    @endif
                </div>
                <p class="item-name">{{ $item->name }}</p>
            </div>
        @empty
            <p class="no-items">表示できる商品がありません。</p>
        @endforelse
    </div>

</div>
@endsection
