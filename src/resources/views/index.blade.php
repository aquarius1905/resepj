@extends('layouts.default')
@extends('layouts.search')

@section('content')
<div class="shoplist">
  <div class="shoplist-inner">
    @foreach($items as $item)
    <div class="shop-card box-shadow">
      <div class="card-img-container">
        @if(config('app.env') === 'production')
        <img class="card-img" src="{{ Storage::disk('s3')->url("{$item->img_filename}") }}" alt="{{ $item->name }}">
        @else
        <img class="card-img" src="{{ asset('storage/'.$item->img_filename) }}" alt="{{ $item->name }}">
        @endif
      </div>
      <div class="card-content">
        <h2 class="card-ttl">{{ $item->name }}</h2>
        <div class="card-tag-container">
          <p class="shop-area">#{{ $item->getAreaName() }}</p>
          <p class="shop-genre">#{{ $item->getGenreName() }}</p>
        </div>
        <div class="card-btn-container">
          <a href="{{ route('shop.show', ['shop_id' => $item->id ]) }}" class="btn">詳しく見る</a>
          @auth('web')
          @if($item->isLike())
          <form method="POST" action="{{ route('like.destroy', ['like_id' => $item->getLikeId() ]) }}">
            @csrf
            <input type="hidden" name="shop_id" value={{ $item->id }}>
            <button class="like-btn" type="submit">
              <div class="like-heart"></div>
            </button>
          </form>
          @else
          <form method="POST" action="{{ route('like.store') }}">
            @csrf
            <input type="hidden" name="shop_id" value={{ $item->id }}>
            <button class="like-btn" type="submit">
              <div class="normal-heart"></div>
            </button>
          </form>
          @endif
          @endauth
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection