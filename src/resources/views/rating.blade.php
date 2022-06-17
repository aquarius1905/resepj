@extends('layouts.default')

@section('js')
<script src="js/confirm.js"></script>
@endsection

@section('content')
<div class="rating-box">
  <div class="rating-box-inner box-shadow">
    <form method="POST" action="{{ route('rating.store') }}">
      @csrf
      <div class="rating-item">
        <label class="rating-item-lbl">Shop</label>
        <label>{{ $reservation->getShopName() }}</label>
        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
      </div>
      <div class="rating-item">
        <label class="rating-item-lbl">Rating</label>
        <div class="rating">
          <input class="rating-input hidden-visually" type="radio" id="star5" name="rating" value="5" {{old('rating') == 5 ? 'checked' : ''}} />
          <label class="rating-label" for="star5" title="星5つ"><span class="rating-icon" aria-hidden="true"></span><span
              class="hidden-visually">星5つ</span></label>
          <input class="rating-input hidden-visually" type="radio" id="star4" name="rating" value="4" {{old('rating') == 4 ? 'checked' : ''}} />
          <label class="rating-label" for="star4" title="星4つ"><span class="rating-icon" aria-hidden="true"></span><span
              class="hidden-visually">星4つ</span></label>
          <input class="rating-input hidden-visually" type="radio" id="star3" name="rating" value="3" {{old('rating') == 3 ? 'checked' : ''}} />
          <label class="rating-label" for="star3" title="星3つ"><span class="rating-icon" aria-hidden="true"></span><span
              class="hidden-visually">星3つ/span></label>
          <input class="rating-input hidden-visually" type="radio" id="star2" name="rating" value="2" {{old('rating') == 2 ? 'checked' : ''}} />
          <label class="rating-label" for="star2" title="星2つ"><span class="rating-icon" aria-hidden="true"></span><span
              class="hidden-visually">星2つ</span></label>
          <input class="rating-input hidden-visually" type="radio" id="star1" name="rating" value="1" {{old('rating') == 1 ? 'checked' : ''}} />
          <label class="rating-label" for="star1" title="星1つ"><span class="rating-icon" aria-hidden="true"></span><span
              class="hidden-visually">星1つ</span></label>
        </div>
      </div>
      @error('rating')<label class="error">{{ $message }}</label>@enderror
      <div class="rating-item">
        <label class="rating-item-lbl">Comment</label>
        <textarea class="rating-comment" name="comment">{{ old('comment') }}</textarea>
      </div>
      @error('comment')<label class="error">{{ $message }}</label>@enderror
      <div class="rating-btn-wrap">
        <button type="submit" class="rating-btn" onclick="confirmRating(event)">評価する</button>
      </div>
    </form>
  </div>
</div>
@endsection