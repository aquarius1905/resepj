<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Like;
use DateTime;

class UserController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    $today = new DateTime();
    $today = $today->format('Y-m-d');

    //予約一覧を取得
    $reservations = Reservation::with(['user', 'shop', 'course'])
      ->where('user_id', $user->id)
      ->where('date', '>=', $today)
      ->orderBy('date')
      ->get();

    //評価店舗一覧を取得
    $ratingTargets = Reservation::with(['user', 'shop', 'course'])
      ->where('user_id', $user->id)
      ->where('rating_flg', true)
      ->orderBy('date', 'desc')
      ->get();

    //お気に入り店舗を取得
    $likes = Like::with(['user', 'shop'])
      ->where('user_id', $user->id)
      ->get();

    return view('mypage', [
      'reservations' => $reservations,
      'ratingTargets' => $ratingTargets,
      'user' => $user,
      'likes' => $likes,
    ]);
  }
}
