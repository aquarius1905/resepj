<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ShopRepresetativeController;
use App\Http\Controllers\VerifyShopRepresetativeEmailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\ShopLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//飲食店一覧
Route::get('/', [ShopController::class, 'index'])->name('shop.index');

//飲食店検索
Route::get('/shops/search', [ShopController::class, 'search'])->name('shops.search');

//飲食店詳細
Route::get('/shops/{shop_id}', [ShopController::class, 'show'])->name('shop.show');

//予約QRコード読み取り
Route::get('/reservation/{reservation_id}', [ReservationController::class, 'updateRatingFlg'])->name('reservation.updateRatingFlg');

Route::middleware(['auth:web', 'user.verified'])->group(function () {
  //飲食店お気に入り追加
  Route::post('/likes', [LikeController::class, 'store'])->name('like.store');
  //飲食店お気に入り削除
  Route::post('/likes/{like_id}', [LikeController::class, 'destroy'])->name('like.destroy');
  //飲食店予約情報追加
  Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation.store');
  //飲食店予約情報削除
  Route::post('/reservations/{reservation_id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
  //飲食店予約情報変更
  Route::post('/reservations/change/{reservation_id}', [ReservationController::class, 'update'])->name('reservation.update');
  // ユーザー情報取得
  // ユーザー飲食店お気に入り一覧取得
  // ユーザー飲食店予約情報取得
  Route::get('/mypage', [UserController::class, 'show'])->name('user.show');
  // 評価画面表示
  Route::get('/rating/{reservation_id}', [RatingController::class, 'show'])->name('rating.show');
  // 評価登録
  Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
  // カード決済
  Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
});

Route::prefix('admin')->group(function () {
  // 管理者ログイン画面表示
  Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
  // 管理者ログイン
  Route::post('/login', [AdminLoginController::class, 'store'])->name('admin.store');

  Route::middleware('auth:admin')->group(function () {
    // 管理者ログアウト
    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');
    // 管理画面表示
    Route::get('/dashboard', [AdministratorController::class, 'index'])->name('admin.dashboard');
  });
});

Route::prefix('shop')->group(function () {
  //店舗代表者ログイン画面表示
  Route::get('/login', [ShopLoginController::class, 'create'])->name('shop.login');
  // 店舗代表者メール認証
  $verificationLimiter = config('fortify.limiters.verification', '6,1');
  Route::get('/email/verify/{id}/{hash}', [VerifyShopRepresetativeEmailController::class,  '__invoke'])
    ->middleware(['auth:shop', 'signed', 'throttle:' . $verificationLimiter])->name('shop.verification.verify');
  // 店舗代表者ログイン
  Route::post('/login', [ShopLoginController::class, 'store'])->name('shop.login.store');
  // 店舗代表者ログアウト
  Route::post('/logout', [ShopLoginController::class, 'destroy'])
    ->middleware('auth:shop')->name('shop.logout');

  Route::middleware('auth:admin')->group(function () {
    //店舗代表者登録
    Route::post('/represetative', [ShopRepresetativeController::class, 'store'])->name('shop_represetative.store');
  });

  Route::middleware(['auth:shop', 'shop.verified'])->group(function () {
    // 店舗代表者管理画面表示
    Route::get('/dashboard', [ShopRepresetativeController::class, 'index'])->name('shop.dashboard');
    // 店舗情報登録
    Route::post('/', [ShopController::class, 'store'])->name('shop.store');
    // 店舗情報変更
    Route::post('/{shop_id}', [ShopController::class, 'update'])->name('shop.update');
  });
});
