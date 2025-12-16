<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class PurchaseController extends Controller
{
    // 購入フォーム表示
    public function showForm($item_id)
    {
        $item = Product::findOrFail($item_id);
        $user = Auth::user();

        return view('purchase.buy', compact('item', 'user'));
    }

    // 購入処理
    public function store(PurchaseRequest $request, $item_id)
    {
        $item = Product::findOrFail($item_id);

        if ($item->is_sold) {
            return redirect()
                ->route('items.index')
                ->with('error');
        }
        Stripe::setApiKey(config('services.stripe.secret'));

        if ($request->payment_method === 'コンビニ払い') {
            $paymentMethods = ['konbini'];
        } else {
            $paymentMethods = ['card'];
        }

        $session = CheckoutSession::create([
            'payment_method_types' => $paymentMethods,
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],

            'success_url' => route('items.index'),
            'cancel_url' => route('purchase.show', ['item_id' => $item->id]),
        ]);
        return redirect($session->url);
    }
}

