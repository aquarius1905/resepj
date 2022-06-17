<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Like;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Models\User;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();

        //ユーザー登録
        $this->user = User::factory()->create([
            'name'=>'taro',
            'email'=>'taro@sample.com',
            'password'=>Hash::make('taro')
        ]);

        //店舗代表者登録
        $this->shop_representative = ShopRepresentative::factory()->create([
            'name'=>'店舗代表者',
            'email'=>'shop_represetative@sample.com',
            'password'=> Hash::make('shoprepresentative')
        ]);

        //店舗情報登録
        $this->shop = Shop::factory()->create([
            'area_id'=> 1,
            'genre_id'=> 3,
            'representative_id'=> $this->shop_representative->id,
            'name'=>'八戒',
            'overview' => '当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。',
            'img_filename' => 'izakaya.jpg'
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_like()
    {
        //お気に入り追加
        $like = Like::factory()->create([
            'user_id'=> $this->user->id,
            'shop_id'=> $this->shop->id
        ]);
        $this->assertDatabaseHas('likes',[
            'user_id'=> $this->user->id,
            'shop_id'=> $this->shop->id
        ]);

        //お気に入り削除
        $like->delete();
        $this->assertDeleted($like);
    }
}
