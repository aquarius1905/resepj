@extends('layouts.default')

@section('js')
<script src="{{ asset('js/confirm.js') }}"></script>
<script src="{{ asset('js/mypage.js') }}"></script>
@endsection

@section('content')
<div class="mypage">
  <div class="mypage-container">
    <div class="login-user-name-wrap">
      <h2>{{ $user->name }}さん</h2>
    </div>
    <div class="mypage-content-wrap">
      <div class="reservation-status">
        <h3 class="reservation-status-ttl">予約状況</h3>
        @foreach ($reservations as $reservation)
        <div class="reservation-detail box-shadow">
        </div>
        @endforeach
        <div class="shop-rating">
          <h4 class="shop-rating-ttl">評価</h4>
          @foreach ($ratingTargets as $ratingTarget)
          <div class="reservation-rating-box box-shadow">
            <div class="shop-rating-content">
              <div class="shop-rating-item">
                <label class="shop-rating-item-lbl">Shop</label>
                <label>{{ $ratingTarget->getShopName() }}</label>
                <input type="hidden" value="{{ $ratingTarget->getShopId() }}">
              </div>
              <div class="shop-rating-item">
                <label class="shop-rating-item-lbl">Date</label>
                <label>{{ $ratingTarget->date->format('Y-m-d') }}</label>
              </div>
              <div class="shop-rating-item">
                <label class="shop-rating-item-lbl">Time</label>
                <label>{{ $ratingTarget->time->format('H:i') }}</label>
              </div>
              <div class="shop-rating-item">
                <label class="shop-rating-item-lbl">Course</label>
                <label>{{ $ratingTarget->getCourseName() }}コース</label>
              </div>
              <div class="shop-rating-item">
                <label class="shop-rating-item-lbl">Number</label>
                <label>{{ $ratingTarget->number }}人</label>
              </div>
            </div>
            @if($ratingTarget->rating)
            <div class="rated-lbl-wrap">
              <label class="rated-lbl">評価済</label>
            </div>
            @else
            <div>
              <form method="GET" action="{{ route('rating.show', ['reservation_id' => $ratingTarget->id]) }}">
                @csrf
                <button type="submit" class="shop-rating-btn">評価する</button>
              </form>
            </div>
            @endif
          </div>
          @endforeach
        </div>
      </div>
      <div class="favorite-shops">
        <h3 class="favorite-shoplist-ttl">お気に入り店舗</h3>
        <div class="favorite-shoplist-wrap">
          @foreach($likes as $like)
          <div class="like-shop-card box-shadow">
            <div class="card-img-container">
              @if(config('app.env') === 'production')
              <img class="card-img" src="{{ Storage::disk('s3')->url("{$like->getShopImgFileName()}") }}" alt="{{ $like->getShopName() }}">
              @else
              <img class="card-img" src="{{ asset('storage/'.$like->getShopImgFileName()) }}" alt="{{ $like->getShopName() }}">
              @endif
            </div>
            <div class="card-content">
              <h2 class="card-ttl">{{ $like->getShopName() }}</h2>
              <div class="card-tag-container">
                <p class="shop-area">#{{ $like->getShopAreaName() }}</p>
                <p class="shop-genre">#{{ $like->getShopGenreName() }}</p>
              </div>
              <div class="card-btn-container">
                <a href="{{ route('shop.show', ['shop_id' => $like->getShopId() ]) }}" class="btn">詳しく見る</a>
                <form method="POST" action="{{ route('like.destroy', ['like_id' => $like->id ]) }}">
                  @csrf
                  <button class="like-btn" type="submit">
                    <div class="like-heart"></div>
                  </button>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection