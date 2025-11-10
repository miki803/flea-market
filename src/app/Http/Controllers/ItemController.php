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
        if ($tab === 'mylist' && Auth::check()) {
            $items = Auth::user()->favorites;
        } else {
            $items = Product::latest()->get();
        }
    }

    // 商品詳細
    public function show($item_id)
    {
        $item = Product::with(['comments.user'])->findOrFail($item_id);
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
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'brand' => ['nullable', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'condition' => ['required', 'string'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        'categories' => ['required'],
    ]);

        $path = null;
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'condition' => $validated['condition'],
            'category' => $request->input('category', 'その他'),
            'image' => $path,
        ]);
        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }

}
