<?php

namespace App\Http\Controllers;

use App\Auth\Events\RepresetativeRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShopRepresentativeRegisterRequest;
use App\Models\ShopRepresentative;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Rating;
use App\Models\Course;
use DateTime;

class ShopRepresetativeController extends Controller
{
    public function index()
    {
        $representative_id = Auth::id();
        //店舗情報
        $shop = Shop::where('representative_id', $representative_id)->first();
        $courses = null;
        $reservations = null;
        $ratings = null;
        if ($shop) {
            $shop_id = $shop->id;
            //コース
            $courses = Course::where('shop_id', $shop_id)->get();
            //予約情報
            $today = new DateTime();
            $today = $today->format('Y-m-d');
            $reservations = Reservation::where('shop_id', $shop_id)
                ->where('date', '>=', $today)
                ->orderby('date')
                ->get();
            //評価情報
            $ratings = Rating::whereHas('reservation', function ($query) use ($shop_id) {
                $query->where('shop_id', $shop_id);
            })->get();
        }
        $areas = Area::all();
        $genres = Genre::all();

        return view('/shop/dashboard', [
            'areas' => $areas,
            'genres' => $genres,
            'representative_id' => $representative_id,
            'shop' => $shop,
            'courses' => $courses,
            'reservations' => $reservations,
            'ratings' => $ratings
        ]);
    }

    public function store(ShopRepresentativeRegisterRequest $request)
    {
        //店舗代表者登録
        $inputs = $request->except(['_token']);
        $inputs['password'] = Hash::make($inputs['password']);
        $shop_represetative = ShopRepresentative::create($inputs);
        event(new RepresetativeRegistered($shop_represetative));

        return view('/admin/thanks');
    }
}
