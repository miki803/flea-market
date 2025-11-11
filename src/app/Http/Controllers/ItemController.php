<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $tab = $request->get('tab');
        $keyword = $request->get('keyword');

        if ($tab === 'mylist' && Auth::check()) {
            $query = Auth::user()
                ->favorites()
                ->with('user');
        } else {
            $query = Product::query();
        }

        // 検索（商品名で部分一致）
        if (!empty($keyword)){
            $query->where('name', 'like', "%{$keyword}%");
        }

        // 自分が出品した商品を除外
        if (Auth::check()) {
            $query->where('products.user_id', '!=', Auth::id());
        }

        $items = $query->orderBy('products.created_at', 'desc')->get();

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
        'ファッション',
        '家電',
        '雑貨',
        '食品',
        ];
        $conditions = ['新品', '未使用に近い', '目立った傷や汚れなし', 'やや傷や汚れあり', '状態が悪い'];


        return view('items.sell', compact('categories', 'conditions'));
    }

    // 出品登録
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'brand' => ['nullable', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'condition' => ['required', 'string'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        'categories' => ['required', 'array'],
    ]);

    //画像保存
        $path = null;
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('products', 'public');
        }

        //登録処理
        Product::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'condition' => $validated['condition'],
            'category' => $categoryNames,
            'image' => $path,
        ]);
        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }

}
