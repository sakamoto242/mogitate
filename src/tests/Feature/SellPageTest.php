<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SellPageTest extends TestCase
{
    // DatabaseTransactions を使うことで、既存のカテゴリーデータを消さずにテストできます
    use DatabaseTransactions;

    /** @test */
    public function 商品情報を正しく入力すれば出品できる()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/sell', [
            'name' => 'テスト商品',
            'description' => 'テストの説明文',
            'categories' => [$category->id], 
            'condition' => '新品', 
            'price' => 2000,
            'image' => UploadedFile::fake()->create('item.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('product.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'テスト商品',
            'price' => 2000,
        ]);
    }
}