<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test.
     *
     * @return void
     */
    public function test_user()
    {
        //会員登録ページ表示
        $response = $this->get('/register');
        $response->assertStatus(200);

        //ログインページ表示
        $response = $this->get('/login');
        $response->assertStatus(200);

        //ユーザー登録
        $hashed_password = Hash::make('taro');
        $user = User::factory()->create([
            'name' => 'taro',
            'email' => 'taro@sample.com',
            'password' => $hashed_password
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'taro',
            'email' => 'taro@sample.com',
            'password' => $hashed_password
        ]);

        // 認証されていないことを確認
        $this->assertGuest($guard = 'web');

        // ログイン実行
        $password = 'taro';
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password
        ]);

        // リダイレクトされているか確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect('/');

        // 認証されていることを確認
        $this->assertAuthenticatedAs($user, $guard = 'web');

        // ログアウト実行
        $response = $this->post(route('logout'), [
            'email' => $user->email,
            'password' => $password
        ]);

        // ログアウト後、リダイレクトされているか確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect('/login');

        // ログアウトされていることを確認
        $this->assertGuest($guard = 'web');
    }
}
