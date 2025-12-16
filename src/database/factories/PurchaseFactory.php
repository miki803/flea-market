<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'user_id'        => User::factory(),
            'product_id'     => Product::factory(),
            'payment_method' => 'card',
            'postal_code'    => '123-4567',
            'address'        => '東京都テスト区1-2-3',
            'building'       => 'テストビル101',
        ];
    }
}
