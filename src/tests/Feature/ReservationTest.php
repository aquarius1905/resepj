<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();

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

        $this->course = Course::factory()->create([
            'shop_id' => $this->shop->id,
            'name' => '月',
            'price' => 5000,
        ]);

        //ユーザー登録
        $this->user = User::factory()->create([
            'name'=>'taro',
            'email'=>'taro@sample.com',
            'password'=>Hash::make('taro')
        ]);
    }

    /**
     * A basic feature test.
     *
     * @return void
     */
    public function test_reservation()
    {
        //予約情報登録
        $datetime_registration = new Carbon('2022-06-01 18:00');
        $date_registration = $datetime_registration->format('Y-m-d');
        $time_registration = $datetime_registration->format('H:i');
        $reservation = Reservation::factory()->create([
            'user_id'=> $this->user->id,
            'shop_id'=> $this->shop->id,
            'date'=> $date_registration,
            'time'=> $time_registration,
            'number' => 2,
            'course_id' => $this->course->id,
            'rating_flg' => 0
        ]);
        $this->assertDatabaseHas('reservations',[
            'user_id'=> $this->user->id,
            'shop_id'=> $this->shop->id,
            'date'=> $date_registration,
            'time'=> $time_registration,
            'number' => 2,
            'course_id' => $this->course->id,
            'rating_flg' => 0,
        ]);

        //予約情報変更
        $datetime_update = new Carbon('2022-06-02 19:00');
        $date_update = $datetime_update->format('Y-m-d');
        $time_update = $datetime_update->format('H:i');
        $reservation->update([
            'date'=> $date_update,
            'time'=> $time_update,
            'number' => 3
        ]);
        $this->assertDatabaseHas('reservations',[
            'user_id'=> $this->user->id,
            'shop_id'=> $this->shop->id,
            'date'=> $date_update,
            'time'=> $time_update,
            'number' => 3
        ]);

        //予約情報削除
        $reservation->delete();
        $this->assertDeleted($reservation);
    }
}
