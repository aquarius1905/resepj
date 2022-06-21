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
          <div class="reservation-detail-ttl-wrap">
            <img src="images/clock.png" alt="clock" class="clock-img">
            <h4 class="reservation-detail-ttl">予約{{ $loop->index + 1 }}</h4>
            <form method="POST" action="{{ route('reservation.destroy', ['reservation_id' => $reservation->id ]) }}" class="reservation-delete-form">
              @csrf
              <button type="submit" class="reservation-delete-btn" onclick="confirmDeletion(event)"><img src="images/cancel.png" alt="clock"></button>
            </form>
          </div>
          <div>
            <form method="POST" action="{{ route('reservation.update', ['reservation_id' => $reservation->id]) }}" class="reservation-update-form" name="reservation_update_form">
              @csrf
              <div class="reservation-status-content">
                <div class="status-item">
                  <label class="status-item-lbl">Shop</label>
                  <label>{{ $reservation->getShopName() }}</label>
                </div>
                <div class="status-item">
                  <label class="status-item-lbl" for="{{ 'date'.$loop->index }}">Date</label>
                  <div class="reservation-change-date-wrap">
                    <input type="date" name="date" value="{{ $reservation->date->format('Y-m-d') }}" class="reservation-date reservation-change-date" id="{{ 'date'.$loop->index }}" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                  </div>
                </div>
                <div class="status-item">
                  <label class="status-item-lbl" for="{{ 'time'.$loop->index }}">Time</label>
                  <div class="select-wrap reservation-change-select-wrap">
                    <select name="time" class="reservation-select reservation-change-select" id="{{ 'time'.$loop->index }}">
                      @foreach (Config::get('time.times') as $time)
                      <option value="{{ $time }}" @if($time==$reservation->time->format('H:i')) selected @endif>{{ $time }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="status-item">
                  <label class="status-item-lbl" for="{{ 'number'.$loop->index }}">Number</label>
                  <div class="select-wrap reservation-change-select-wrap">
                    <input type="hidden" id="{{ 'course-price'.$loop->index }}" value="{{ reservation->getCoursePrice() }}">
                  </div>
                </div>
                <div class="status-item">
                  <label class="status-item-lbl">Course</label>
                  <label>{{ $reservation->getCourseName() }}コース</label>
                  <input type="hidden" name="course_id" value="{{ $reservation->getCourseId() }}">
                </div>
                <div class="status-item">
                  <label class="status-item-lbl">Price</label>
                  <label id="{{ 'price'.$loop->index }}">{{ $reservation->getPrice() }}円</label>
                </div>
                <div class="status-item">
                  <label class="status-item-lbl">QRCode</label>
                  <label>{!! QrCode::generate(url('/reservation/'.$reservation->id)) !!}</label>
                </div>
              </div>
              <div>
                <button type="submit" class="reservation-change-btn" onclick="confirmChangeReservation(event)">予約を変更する</button>
              </div>
            </form>
          </div>
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