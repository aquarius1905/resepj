<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Administrator;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();

        //管理者
        $this->admin = Administrator::factory()->create([
            'name'=>'管理者',
            'email'=>'admin@sample.com',
            'password'=> Hash::make('admin')
        ]);
    }

    /**
     * A basic feature test.
     *
     * @return void
     */
    public function test_admin()
    {
        // 管理者ログインページ表示
        $response = $this->get('/admin/login');
        $response->assertStatus(200);

        // 認証されていないことを確認
        $this->assertGuest($guard = 'admin');

        // ログイン実行
        $response = $this->post(route('admin.store'), [
            'email' => $this->admin->email,
            'password' => 'admin'
        ]);

        // リダイレクトされているか確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect('/admin/dashboard');

        // 認証されていることを確認
        $this->assertAuthenticatedAs($this->admin, $guard = 'admin');

        // ログアウト実行
        $response = $this->post(route('admin.logout'), [
            'email' => $this->admin->email,
            'password' => 'admin'
        ]);

        // ログアウト後、リダイレクトされているか確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect('/admin/login');

        // ログアウトされていることを確認
        $this->assertGuest($guard = 'admin');

    }
}
