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