<?php

namespace Tests\Feature;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemListTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_item_list()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('商品がありません。');
    }

    public function test_item_name_is_displayed_when_item_exists()
    {
        Product::factory()->create([
            'name' => 'テスト商品',
        ]);

        $response = $this->get('/');

        $response->assertSee('テスト商品');
    }

    public function test_sold_label_is_displayed_when_item_is_sold()
    {
        $product = Product::factory()->create([
            'name' => '売却済み商品',
        ]);

        Purchase::factory()->create([
            'product_id' => $product->id,
        ]);

        $response = $this->get('/');

        $response->assertSee('SOLD');
    }

    public function test_sold_label_is_not_displayed_when_item_is_not_sold()
    {
        Product::factory()->create([
            'name' => '未購入商品',
        ]);

        $response = $this->get('/');

        $response->assertDontSee('SOLD');
    }

    public function test_mylist_tab_is_not_visible_for_guest()
    {
        $response = $this->get('/');
        $response->assertDontSee('マイリスト');
    }

    public function test_mylist_tab_is_visible_for_authenticated_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertSee('マイリスト');
    }

    public function test_own_items_are_not_displayed_in_item_list()
    {
        $user = User::factory()->create();

        Product::factory()->create([
            'user_id' => $user->id,
            'name' => '自分の商品',
        ]);

        Product::factory()->create([
            'name' => '他人の商品',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertDontSee('自分の商品');
        $response->assertSee('他人の商品');
    }

    public function test_items_can_be_filtered_by_keyword()
    {
    // 検索対象になる商品
        Product::factory()->create([
            'name' => '赤いりんご',
        ]);

        Product::factory()->create([
            'name' => '青いりんご',
        ]);

    // 検索対象にならない商品
        Product::factory()->create([
            'name' => 'バナナ',
        ]);

    // keyword を付けて一覧にアクセス
        $response = $this->get('/?keyword=りんご');

    // 部分一致した商品は表示される
        $response->assertSee('赤いりんご');
        $response->assertSee('青いりんご');

    // 一致しない商品は表示されない
        $response->assertDontSee('バナナ');
    }
}
