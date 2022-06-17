<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ShopRegisterRequest;
use App\Http\Requests\ShopUpdateRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Course;

class ShopController extends Controller
{
  public function index()
  {
    $user_id = Auth::id();
    $items = Shop::with(['area', 'genre', 'likes' => function ($query) use ($user_id) {
      $query->where('user_id', $user_id);
    }])->get();
    $areas = Area::all();
    $genres = Genre::all();

    return view('index', [
      'items' => $items,
      'areas' => $areas,
      'genres' => $genres,
      'inputs' => null,
      'payment_flg' => false
    ]);
  }

  public function show($id)
  {
    $item = Shop::with(['courses'])->find($id);

    return view('detail', [
      'item' => $item,
      'payment_flg' => false
    ]);
  }

  public function search(Request $request)
  {
    $area = $request->area;
    $genre = $request->genre;
    $shop_name = $request->shop_name;
    $items = null;
    $user_id = Auth::id();
    if ($user_id) {
      $items = Shop::with(['area', 'genre', 'likes' => function ($like_query) use ($user_id) {
        $like_query->where('user_id', $user_id);
      }])
        ->whereArea($area)
        ->whereGenre($genre)
        ->whereShopName($shop_name)
        ->get();
    } else {
      $items = Shop::with(['area', 'genre'])
        ->whereArea($area)
        ->whereGenre($genre)
        ->whereShopName($shop_name)
        ->get();
    }
    $areas = Area::all();
    $genres = Genre::all();
    $inputs = $request->except(['_token']);

    return view('index', [
      'items' => $items,
      'areas' => $areas,
      'genres' => $genres,
      'inputs' => $inputs
    ]);
  }

  public function store(ShopRegisterRequest $request)
  {
    //店舗の追加
    $shop_inputs = $request->except(['_token', 'course_names', 'course_prices']);
    $course = $request->only(['course_names', 'course_prices']);
    $img = $request->file('img');
    if (app()->isLocal() || app()->runningUnitTests()) {
      $path = $img->store('');
      $shop_inputs['img_filename'] = pathinfo($path, PATHINFO_BASENAME);
    } else {
      $path = Storage::disk('s3')->put('/', $img);
      $shop_inputs['img_filename'] = $path;
    }
    $shop = Shop::create($shop_inputs);

    //コースの追加
    $course_inputs = [];
    foreach (array_map(NULL, $course['course_names'], $course['course_prices']) as [$name, $price]) {
      $course_inputs[] = ['shop_id' => $shop->id, 'name' => $name, 'price' => $price];
    }
    Course::insert($course_inputs);

    return view('/shop/done');
  }

  public function update(ShopUpdateRequest $request, $id)
  {
    //店舗の更新
    $img = $request->file('img');
    if ($img) {
      $inputs = $request->only([
        'name', 'area_id', 'genre_id', 'overview', 'img_filename'
      ]);
      if (app()->isLocal() || app()->runningUnitTests()) {
        $path = $img->store('');
        $shop_inputs['img_filename'] = pathinfo($path, PATHINFO_BASENAME);
      } else {
        $path = Storage::disk('s3')->put('/', $img);
        $inputs['img_filename'] = $path;
      }
      Shop::where('id', $id)->update($inputs);
    } else {
      $inputs = $request->only([
        'name', 'area_id', 'genre_id', 'overview'
      ]);
      Shop::where('id', $id)->update($inputs);
    }

    //コースの更新
    $course_ids = Course::where('shop_id', $id)->get(['id'])->toArray();
    $course = $request->only(['course_names', 'course_prices']);
    foreach (array_map(NULL, $course['course_names'], $course['course_prices'], $course_ids) as [$name, $price, $course_id]) {
      Course::where('id', $course_id['id'])->update([
        'name' => $name, 'price' => $price
      ]);
    }

    return back();
  }
}
