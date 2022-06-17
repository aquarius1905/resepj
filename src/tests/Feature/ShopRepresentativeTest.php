<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\ShopRepresentative;

class ShopRepresentativeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test.
     *
     * @return void
     */
    public function test_shoprepresentative()
    {
        //店舗代表者ログインページ表示
        $response = $this->get('/shop/login');
        $response->assertStatus(200);

        //店舗代表者登録
        $hashed_password = Hash::make('shoprepresentative');
        $shop_representative = ShopRepresentative::factory()->create([
            'name'=>'店舗代表者',
            'email'=>'shop_represetative@sample.com',
            'password'=> $hashed_password
        ]);
        $this->assertDatabaseHas('shop_representatives',[
            'name'=>'店舗代表者',
            'email'=>'shop_represetative@sample.com',
            'password'=>$hashed_password
        ]);

        // 認証されていないことを確認
        $this->assertGuest($guard = 'shop');

        // ログイン実行
        $password = 'shoprepresentative';
        $response = $this->post(route('shop.login'), [
            'email' => $shop_representative->email,
            'password' => $password
        ]);

        // リダイレクトされているか確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect('/shop/dashboard');

        // 認証されていることを確認
        $this->assertAuthenticatedAs($shop_representative, $guard = 'shop');

        // ログアウト実行
        $response = $this->post(route('shop.logout'), [
            'email' => $shop_representative->email,
            'password' => $password
        ]);

        // ログアウト後、リダイレクトされているか確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect('/shop/login');

        // ログアウトされていることを確認
        $this->assertGuest($guard = 'shop');
    }
}
