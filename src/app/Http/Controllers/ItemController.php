<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SellRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $tab = $request->get('tab');
        $keyword = $request->get('keyword');

        if ($tab === 'mylist' && Auth::check()) {
            $favoriteProductIds = Auth::user()
                ->favorites()
                ->pluck('product_id');
            $query = Product::whereIn('id', $favoriteProductIds);
        } else {
            $query = Product::query();
        }

        // 検索（商品名で部分一致）
        if (!empty($keyword)){
            $query->where('name', 'like', "%{$keyword}%");
        }

        // 自分が出品した商品を除外
        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        $query->orderBy('created_at', 'desc');
        $items = $query->get();

        return view('items.list', compact('items', 'keyword', 'tab'));
    }

    // 商品詳細
    public function show($item_id)
    {
        $item = Product::findOrFail($item_id);
        return view('items.detail', compact('item'));
    }

    // 出品フォーム
    public function create()
    {
        $categories = [
        'ファッション','家電','インテリア','レディース','メンズ','コスメ','本','ゲーム','スポーツ','キッチン','ハンドメイド','アクセサリー','おもちゃ','ベビー・キッズ',];

        $conditions = ['新品', '未使用に近い', '目立った傷や汚れなし', 'やや傷や汚れあり', '状態が悪い'];

        return view('items.sell', compact('categories', 'conditions'));
    }

    // 出品登録
    public function store(SellRequest $request)
    {
        $validated = $request->validated();

    //画像保存
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        //登録処理
        Product::create([
            'user_id'     => Auth::id(),
            'name'        => $validated['name'],
            'brand'       => $request->brand,
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'condition'   => $validated['condition'],
            'category'    => implode(',', $validated['categories']),
            'image'       => $path,
        ]);

        return redirect()->route('items.index');
    }

}
