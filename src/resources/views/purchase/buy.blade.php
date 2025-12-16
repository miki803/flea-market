@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/buy.css') }}">
@endsection

@section('content')
<div class="purchase-container">

<form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST" id="purchase-form">
@csrf
  {{-- 左側 --}}
  <div class="purchase-left">

    <div class="item-summary">
      @if($item->image)
        <img src="{{ asset('storage/' . $item->image) }}">
      @else
        <div class="placeholder">商品画像</div>
      @endif

      <div class="item-info">
        <p class="item-name">{{ $item->name }}</p>
        <p class="item-price">¥{{ number_format($item->price) }}</p>
      </div>
    </div>

    {{-- 支払い方法 --}}
    <div class="payment-section">
      <h3>支払い方法</h3>
      <select id="payment-select">
        <option value="">選択してください</option>
        <option value="コンビニ払い">コンビニ払い</option>
        <option value="カード払い">カード払い</option>
      </select>
    </div>

    {{-- 配送先 --}}
    <div class="address-section">
      <h3>配送先
        <a href="{{ route('address.show', ['item_id' => $item->id]) }}" class="link-change">変更する</a>
      </h3>

      <p>
        〒{{ $user->postal_code ?? 'XXX-YYYY' }}<br>
        {{ $user->address ?? 'ここには住所と建物が入ります' }}
      </p>

      <input type="hidden" name="postal_code" value="{{ $user->postal_code }}">
      <input type="hidden" name="address" value="{{ $user->address }}">
      <input type="hidden" name="building" value="{{ $user->building }}">

      
    </div>

  </div>

  {{-- 右側 --}}
  <div class="purchase-right">

    <div class="summary-box">
      <div class="summary-row">
        <span>商品代金</span>
        <span>¥{{ number_format($item->price) }}</span>
      </div>

      <div class="summary-row">
        <span>支払い方法</span>
        <span id="payment-method-display">未選択</span>
      </div>
    </div>

    <input type="hidden" id="payment-method-hidden" name="payment_method">

  @if($item->is_sold)
    <button class="btn-purchase" disabled
        style="background:#aaa; cursor:not-allowed;">売り切れ</button>
  @else
    <button type="submit" class="btn-purchase">購入する</button>
  @endif

  </div>
</form>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const select = document.getElementById('payment-select');
    const display = document.getElementById('payment-method-display');
    const hidden = document.getElementById('payment-method-hidden');

    select.addEventListener('change', function() {
        const value = this.value;
        display.textContent = value || '未選択';
        hidden.value = value;
    });

});
</script>
@endsection
