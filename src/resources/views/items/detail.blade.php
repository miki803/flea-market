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
    <div class="item-actions" action="{{ route('favorite.store', $item->id) }}" method="POST">
      <div class="favorite-area">
        @auth
          @if (Auth::user()->favorites->contains($item->id))
            {{-- お気に入り解除ボタン --}}
            <form class="favorite-form" action="{{ route('favorite.destroy', $item->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn-unfavorite" type="submit" >★</button>
            </form>
          @else
            {{-- お気に入り追加ボタン --}}
            <form class="favorite-form" action="{{ route('favorite.store', $item->id) }}" method="POST" >
              @csrf
              <button class="btn-favorite" type="submit" >☆</button>
            </form>
          @endif
        @else
          <span class="btn-disabled">☆</span>
        @endauth
        <span class="favorite-count">{{ $item->favoritedBy->count() }}</span>
      </div>
    <div class="comment-count">💬 {{ $item->comments->count() }}</div>
  </div>

    {{-- 購入ボタン --}}
    @auth
      <a class="btn-purchase" href="{{ route('purchase.show', ['item_id' => $item->id]) }}" >購入手続きへ</a>
    @endauth

      {{-- 商品説明 --}}
    <div class="item-section">
      <h3>商品説明</h3>
      <p>{{ $item->description }}</p>
    </div>

    {{-- 商品情報 --}}
    <div class="item-section">
      <h3>商品の情報</h3>
      <p><strong>カテゴリー：</strong> {{ $item->category }}</p>
      <p><strong>商品の状態：</strong> {{ $item->condition }}</p>
    </div>

    {{-- コメント欄 --}}
    <div class="comments-section">
        <h3>コメント（{{ $item->comments->count() }}）</h3>

        @foreach ($item->comments as $comment)
            <div class="comment">
              <div class="comment-user">
                @if($comment->user->image)
                  <img class="comment-user-image" src="{{ asset('storage/' . $comment->user->image) }}"alt="{{ $comment->user->name }}">
                @else
                  <div class="comment-user-placeholder">画像</div>
                @endif
                <strong class="comment-user-name">
                  {{ $comment->user->name }}
                </strong>
              </div>
              <p class="comment-content">{{ $comment->content }}</p>
            </div>
        @endforeach

        @auth
        <form class="comment-form" action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST">
            @csrf
            <textarea name="content" placeholder="商品の感想を入力してください" rows="3">{{ old('content') }}</textarea>
            @error('content')
            <p class="error">{{ $message }}</p>
            @enderror
            <button class="btn-comment" type="submit" >コメントを送信する</button>
        </form>
        @else
            <p class="login-prompt">コメントを投稿するには <a href="{{ route('login') }}">ログイン</a> が必要です。</p>
        @endauth
    </div>

    </div>
</div>
@endsection