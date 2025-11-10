@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/address.css') }}">
@endsection

@section('content')
<div class="address-container">
  <h2 class="address-title">住所の変更</h2>

  <form class="address-form" action="{{ route('address.update', ['item_id' => $item_id]) }}" method="POST" >
    @csrf

    <div class="form-group">
      <label class="address-label" for="postal_code">郵便番号</label>
      <input class="address-input"  type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
      <p class="error">
        @error('postal_code')
        {{ $message }}
        @enderror
      </p>
    </div>

    <div class="form-group">
      <label class="address-label"  for="address">住所</label>
      <input class="address-input" type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
      <p class="error">
        @error('address')
        {{ $message }}
        @enderror
      </p>
    </div>

    <div class="form-group">
      <label class="address-label"  for="building">建物名</label>
      <input class="address-input" type="text" id="building" name="building" value="{{ old('building', $user->building) }}" >
      <p class="error">
        @error('building')
        {{ $message }}
        @enderror
      </p>
    </div>

    <button class="btn-update" type="submit" >更新する</button>
  </form>
</div>
@endsection