@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/sell.css') }}">
@endsection

@section('content')
<div class="sell-container">
    <h2 class="page-title">商品の出品</h2>

    <form class="sell-form" action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf

    {{-- 画像アップロード --}}
    <div class="form-group">
        <label class="form-label">商品画像</label>
        <input type="file" name="image" id="image" hidden>
        <label class="upload-btn" for="image" >画像を選択する</label>
        <p class="error">
            @error('image')
            {{ $message }}
            @enderror
        </p>
    </div>

    <hr>

    {{-- 商品の詳細 --}}
    <h3 class="section-title">商品の詳細</h3>

    {{-- カテゴリー --}}
    <div class="category-group">
        <p class="form-label">カテゴリー</p>
        <div class="category-tags">
            @foreach ($categories as $category)
            <label class="tag">
                <input class="category-checkbox" type="checkbox" name="categories[]" value="{{ $category }}" >
                <span>{{ $category }}</span>
            </label>
            @endforeach
        </div>
        <p class="error">
            @error('categories')
            {{ $message }}
            @enderror
        </p>
    </div>

    {{-- 商品の状態 --}}
    <div class="form-group">
        <label class="form-label">商品の状態</label>
        <select name="condition" id="condition" required>
            <option value="">選択してください</option>
            @foreach ($conditions as $condition)
                <option value="{{ $condition }}">{{ $condition }}</option>
            @endforeach
        </select>
        <p class="error">
            @error('condition')
            {{ $message }}
            @enderror
        </p>
    </div>

    <hr>

    {{-- 商品名と説明 --}}
    <h3 class="section-title">商品名と説明</h3>

        <div class="form-group">
            <label class="form-label" for="name" >商品名</label>
            <input type="text" name="name" id="name" placeholder="商品名を入力してください" value="{{ old('name') }}">
            <p class="error">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label class="form-label" for="brand" >ブランド名</label>
            <input type="text" name="brand" id="brand" placeholder="ブランド名を入力してください" value="{{ old('brand') }}">
            <p class="error">
                @error('brand')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label class="form-label" for="description" >商品の説明</label>
            <textarea name="description" id="description" rows="4" placeholder="商品の説明を入力してください">{{ old('description') }}</textarea>
            <p class="error">
                @error('description')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label class="form-label" for="price" >販売価格</label>
            <input type="number" name="price" id="price" placeholder="¥" value="{{ old('price') }}">
            <p class="error">
                @error('price')
                {{ $message }}
                @enderror
            </p>
        </div>

        <button class="btn-submit" type="submit" >出品する</button>
    </form>
</div>

@endsection