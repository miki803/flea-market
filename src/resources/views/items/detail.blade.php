@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/detail.css') }}">
@endsection

@section('content')
<div class="item-detail">

  {{-- 左側：商品画像 --}}
  <div class="item-detail__left">
    @if ($item->image)
      <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
    @else
      <div class="item-placeholder">商品画像</div>
    @endif
  </div>

  {{-- 右側：商品情報 --}}
  <div class="item-detail__right">
    <h2 class="item-name">{{ $item->name }}</h2>
    <p class="item-brand">{{ $item->brand }}</p>
    <p class="item-price">¥{{ number_format($item->price) }} <span>（税込）</span></p>

    {{-- お気に入り数やコメント数 --}}
    <div class="item-actions">
      <span>⭐ {{ $item->likes_count ?? 0 }}</span>
      <span>💬 {{ $item->comments->count() }}</span>
    </div>

    @auth
      <a class="btn-purchase" href="{{ route('purchase.show', ['item_id' => $item->id]) }}" >購入手続きへ</a>

    <div class="item-section">
      <h3>商品説明</h3>
      <p>{{ $item->description }}</p>
    </div>

    <div class="item-section">
      <h3>商品の情報</h3>
      <p><strong>カテゴリー：</strong>
        @foreach ($item->categories as $category)
          <span class="tag">{{ $category->name }}</span>
        @endforeach
      </p>
      <p><strong>商品の状態：</strong> {{ $item->condition }}</p>
    </div>

    {{-- コメント欄 --}}
    <div class="comments-section">
        <h3>コメント（{{ $item->comments->count() }}）</h3>
        @foreach ($item->comments as $comment)
            <div class="comment">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach

        @auth
        <form class="comment-form" action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST" >
            @csrf
            <textarea name="comment" placeholder="商品の感想を入力してください" rows="3"></textarea>
            @error('comment')
            <p class="error">{{ $message }}</p>
            @enderror
            <button class="btn-comment" type="submit" >コメントを送信する</button>
        </form>
        @else
            <p class="login-prompt">コメントを投稿するには <a href="{{ route('login.show') }}">ログイン</a> が必要です。</p>
        @endauth
    </div>

    </div>
</div>
@endsection