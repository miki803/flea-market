<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
         //ユーザーを1件作成（id=1）
        $user = User::factory()->create([
            'name' => '管理者ユーザー',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

          //商品データを登録
        DB::table('products')->insert([
            [
                'user_id' => 1,
                'name' => '腕時計',
                'price' => 15000,
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image' => 'products/Clock.jpg',
                'condition' => '良好',
                'category' => 'ファッション',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'HDD',
                'price' => 5000,
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image' => 'products/HardDisk.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '家電',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand' => 'なし',
                'description' => '新鮮な玉ねぎ3束のセット',
                'image' => 'products/onion.jpg',
                'condition' => 'やや傷や汚れあり',
                'category' => '食品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => '革靴',
                'price' => 4000,
                'brand' => null,
                'description' => 'クラシックなデザインの革靴',
                'image' => 'products/Shoes.jpg',
                'condition' => '状態が悪い',
                'category' => 'ファッション',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'ノートPC',
                'price' => 45000,
                'brand' => null,
                'description' => '高性能なノートパソコン',
                'image' => 'products/pcLaptop.jpg',
                'condition' => '良好',
                'category' => '家電',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'マイク',
                'price' => 8000,
                'brand' => 'なし',
                'description' => '高音質のレコーディング用マイク',
                'image' => 'products/Music.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '家電',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand' => null,
                'description' => 'おしゃれなショルダーバッグ',
                'image' => 'products/bag.jpg',
                'condition' => 'やや傷や汚れあり',
                'category' => 'ファッション',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'タンブラー',
                'price' => 500,
                'brand' => 'なし',
                'description' => '使いやすいタンブラー',
                'image' => 'products/Tumbler.jpg',
                'condition' => '状態が悪い',
                'category' => '雑貨',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'コーヒーミル',
                'price' => 4000,
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'image' => 'products/Coffee.jpg',
                'condition' => '良好',
                'category' => '雑貨',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'メイクセット',
                'price' => 2500,
                'brand' => null,
                'description' => '便利なメイクアップセット',
                'image' => 'products/makeup.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '雑貨',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
