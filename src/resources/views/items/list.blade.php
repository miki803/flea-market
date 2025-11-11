@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/list.css') }}">
@endsection

@section('content')
<div class="items-container">

  {{-- タブ切り替え --}}
  <div class="tab-menu">
      <a href="{{ route('items.index', array_filter(['keyword' => request('keyword')])) }}"class="tab {{ request('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a>
      @auth
        <a href="{{ route('items.index', ['tab' => 'mylist']) }}" class="{{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
      @endauth
  </div>

  {{-- 商品一覧 --}}
  <div class="item-list">
    @forelse ($items as $item)
      <div class="item-card">
        <a href="{{ route('item.show', ['item_id' => $item->id]) }}">
          <div class="item-image">
            @if($item->image)
              <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
            @else
              <div class="placeholder">商品画像</div>
            @endif

            @if ($item->is_sold ?? false)
              <div class="sold-label">SOLD</div>
            @endif
          </div>
          <p class="item-name">{{ $item->name }}</p>
        </a>
      </div>
    @empty
      <p class="no-items">商品がありません。</p>
    @endforelse
  </div>
</div>
@endsection