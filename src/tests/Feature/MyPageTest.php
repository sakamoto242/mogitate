<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyPageTest extends TestCase
{
    use RefreshDatabase; // データベースをテストごとにリセット

    public function test_mypage_display_success()
    {
        // 1. テスト用のユーザーを作る
        $user = User::factory()->create();

        // 2. そのユーザーとしてログインして、マイページへ行く
        $response = $this->actingAs($user)->get('/mypage');

        // 3. ちゃんと表示されたか（ステータスコード200か）確認
        $response->assertStatus(200);
        
        // 4. 画面に「猫」などの文字が含まれているか確認
        $response->assertSee($user->name);
    }
}
