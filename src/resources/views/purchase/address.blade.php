@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/address.css') }}">
@endsection

@section('content')
<div class="address-container">
  <h2 class="address-title">住所の変更</h2>

  <form action="{{ route('address.update', ['item_id' => $item_id]) }}" method="POST" class="address-form">
    @csrf

    <div class="form-group">
      <label for="postal_code">郵便番号</label>
      <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" placeholder="例：123-4567">
      @error('postal_code')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label for="address">住所</label>
      <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" placeholder="住所を入力してください">
      @error('address')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label for="building">建物名</label>
      <input type="text" id="building" name="building" value="{{ old('building', $user->building) }}" placeholder="建物名を入力してください（任意）">
      @error('building')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="btn-update">更新する</button>
  </form>
</div>
@endsection