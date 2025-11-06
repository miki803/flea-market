<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'recommend');
        if ($tab === 'mylist' && Auth::check()) {
            $items = Auth::user()->favorites()->get();
        } else {
            $items = Product::latest()->get();
        }
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
        $categories = \App\Models\Category::all();
        $conditions = ['新品', '未使用に近い', 'やや傷や汚れあり'];
        return view('items.sell', compact('categories', 'conditions'));
    }

    // 出品処理
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
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
            'category' => $request->category,
            'image' => $path,
        ]);
        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }

}
