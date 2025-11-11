@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/buy.css') }}">
@endsection

@section('content')
<div class="purchase-container">

  {{-- 左側：商品情報 --}}
  <div class="purchase-left">
    <div class="item-summary">
      @if($item->image)
        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
      @else
        <div class="placeholder">商品画像</div>
      @endif
      <div class="item-info">
        <p class="item-name">{{ $item->name }}</p>
        <p class="item-price">¥{{ number_format($item->price) }}</p>
      </div>
    </div>

    {{-- 支払い方法 --}}
    <form class="purchase-form" action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST">
      @csrf
      <div class="payment-section">
        <h3>支払い方法</h3>
        <select id="payment-select" name="payment_method" form="purchase-form"onchange="this.form.submit()">
          <option value="">選択してください</option>
          <option value="コンビニ払い" {{ request('payment_method') == 'コンビニ払い' ? 'selected' : '' }}>コンビニ払い</option>
          <option value="カード払い" {{ request('payment_method') == 'カード払い' ? 'selected' : '' }}>カード払い</option>
        </select>
      </div>
    </form>

    {{-- 配送先 --}}
    <div class="address-section">
      <h3>配送先</h3>
      <p>〒{{ $user->postal_code ?? 'XXX-YYYY' }}<br>{{ $user->address ?? 'ここには住所と建物が入ります' }}</p>
      <a href="{{ route('address.show', ['item_id' => $item->id]) }}" class="link-change">変更する</a>
    </div>
  </div>

  {{-- 右側：合計金額と購入ボタン --}}
  <div class="purchase-right">
    <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST" id="purchase-form">
      @csrf

      <div class="summary-box">
        <div class="summary-row">
          <span>商品代金</span>
          <span>¥{{ number_format($item->price) }}</span>
        </div>
        <div class="summary-row">
          <span>支払い方法</span>
          <span>{{ request('payment_method') ?? '未選択' }}</span>
        </div>
      </div>

      <input type="hidden" name="payment_method" value="{{ request('payment_method') }}">
      <button type="submit" class="btn-purchase">購入する</button>
    </form>
  </div>

</div>

@endsection