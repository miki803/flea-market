<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\CommentController;



//標品一覧（トップ画面）
Route::get('/', [ItemController::class,'index'])->name('items.index');
// 商品マイリスト
Route::get('/?tab=mylist', [ItemController::class, 'mylist'])->name('item.mylist');
//商品詳細
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware('auth')->group(function () {
//商品購入
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'showForm'])->name('purchase.show');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
// 住所変更
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'showForm'])->name('address.show');
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'update'])->name('address.update');
// 商品出品
    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
// プロフィール
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/profile', [MypageController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/profile', [MypageController::class, 'update'])->name('mypage.update');
// コメント投稿
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comment.store');
});
