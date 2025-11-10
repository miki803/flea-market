<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    return [
        'user_id' => \App\Models\User::factory(),
        'name' => $this->faker->word(),
        'description' => $this->faker->sentence(),
        'price' => $this->faker->numberBetween(100,10000),
        'condition' => $this->faker->randomElement(['新品','未使用に近い','やや傷や汚れあり']),
        'category' => $this->faker->randomElement(['ファッション','雑貨','家電']),
        'image' => 'products/default.jpg', // ダミー画像ファイル名
        'brand' => $this->faker->company(),
    ];
    }
}