<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Models\Course;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();

        //店舗代表者登録
        $this->shop_representative = ShopRepresentative::factory()->create([
            'name' => '店舗代表者',
            'email' => 'shop_represetative@sample.com',
            'password' => Hash::make('shoprepresentative')
        ]);
    }

    /**
     * A basic feature test.
     *
     * @return void
     */
    public function test_shop()
    {
        //飲食店一覧ページ表示
        $response = $this->get('/');
        $response->assertStatus(200);

        //店舗情報登録
        $shop = Shop::factory()->create([
            'area_id' => 1,
            'genre_id' => 3,
            'representative_id' => $this->shop_representative->id,
            'name' => '八戒',
            'overview' => '当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。',
            'img_filename' => 'izakaya.jpg'
        ]);
        $this->assertDatabaseHas('shops', [
            'area_id' => 1,
            'genre_id' => 3,
            'representative_id' => $this->shop_representative->id,
            'name' => '八戒',
            'overview' => '当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。',
            'img_filename' => 'izakaya.jpg'
        ]);

        //コースを追加
        $course = Course::factory()->create([
            'shop_id' => $shop->id,
            'name' => '月',
            'price' => 5000
        ]);
        $this->assertDatabaseHas('courses', [
            'shop_id' => $shop->id,
            'name' => '月',
            'price' => 5000
        ]);

        //飲食店詳細ページ表示
        $response = $this->get('/shops/' . $shop->id);
        $response->assertStatus(200);

        //店舗情報更新
        $shop->update([
            'area_id' => 2,
            'genre_id' => 4,
            'name' => 'JJ',
            'overview' => 'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
            'img_filename' => 'italian.jpg'
        ]);
        $this->assertDatabaseHas('shops', [
            'area_id' => 2,
            'genre_id' => 4,
            'representative_id' => $this->shop_representative->id,
            'name' => 'JJ',
            'overview' => 'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
            'img_filename' => 'italian.jpg'
        ]);

        //コースを更新
        $course->update([
            'shop_id' => $shop->id,
            'name' => 'C',
            'price' => 7000
        ]);
        $this->assertDatabaseHas('shops', [
            'shop_id' => $shop->id,
            'name' => 'C',
            'price' => 7000
        ]);
    }
}
