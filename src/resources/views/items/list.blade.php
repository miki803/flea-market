@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/list.css') }}">
@endsection

@section('content')
<div class="items-container">

  {{-- タブ切り替え --}}
  @auth
    <div class="tab-menu">
        <a href="{{ route('items.index') }}" class="{{ request('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'mylist']) }}" class="{{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>
  @else
    <div class="tab-menu">
        <a href="{{ route('items.index') }}" class="active">おすすめ</a>
        <span class="tab-disabled">マイリスト（ログインが必要）</span>
    </div>
  @endauth

  {{-- 商品一覧 --}}
  <div class="item-list">
    @foreach ($items as $item)
      <div class="item-card">
        <a href="{{ route('item.show', ['item_id' => $item->id]) }}">
          <div class="item-image">
            @if($item->image)
              <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
            @else
              <div class="placeholder">商品画像</div>
            @endif
          </div>
          <p class="item-name">{{ $item->name }}</p>
        </a>
      </div>
    @endforeach
  </div>
</div>
@endsection