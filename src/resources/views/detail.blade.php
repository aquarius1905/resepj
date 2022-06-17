@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/detail.js') }}"></script>
<script src="{{ asset('js/confirm.js') }}"></script>
@endsection

@section('content')
<div class="detail">
  <div class="shop-detail">
    <div class="shop-ttl-container">
      <a href="/" class="index-btn box-shadow"><</a>
      <h2 class="shop-ttl">{{ $item->name }}</h2>
    </div>
    <div class="shop-img-container">
      @if(app()->isLocal() || app()->runningUnitTests())
        <img src="{{ asset('storage/'.$item->img_filename) }}" alt="{{ $item->name }}" class="shop-img">
      @else
        <img class="card-img" src="{{ Storage::disk('s3')->url("{$item->img_filename}") }}" alt="{{ $item->name }}">
      @endif
    </div>
    <div class="shop-tag-container">
      <p class="shop-area">#{{ $item->getAreaName() }}</p>
      <p class="shop-genre">#{{ $item->getGenreName() }}</p>
    </div>
    <div class="shop-overview-container">
      <p class="shop-overview">{{ $item->overview }}</p>
    </div>
  </div>
  @auth('web')
  <div class="reservation">
    <h2 class="reservation-ttl">予約</h2>
    <form name="reservation_form" class="reservation-form" action="{{ route('reservation.store') }}" method="POST">
      @csrf
      <div class="reservation-form-wrap">
        <div class="date-wrap">
          <input type="hidden" name="shop_id" value="{{ $item->id }}">
          <input type="date" name="date" class="reservation-date" onchange="changeDate()" value="<?php echo e(old('date', date('Y-m-d', strtotime('+1 day')))); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
        </div>
        @error('date')<label class="error">{{ $message }}</label>@enderror
        <div class="select-wrap">
          <select name="time" class="reservation-select" onchange="changeTime()">
            @foreach (Config::get('time.times') as $time)
              <option value="{{ old('time', $time) }}" @if(old('time')===$time) selected @endif>{{ $time }}</option>
            @endforeach
          </select>
        </div>
        @error('time')<label class="error">{{ $message }}</label>@enderror
        <div class="select-wrap">
          <select name="number" class="reservation-select" onchange="changeNumber()">
            @for ($number = 1; $number <= 100; $number++)
              <option value="{{ old('number', $number) }}" @if((int)old('number')===$number) selected @endif>{{ $number }}人</option>
            @endfor
          </select>
        </div>
        @error('number')<label class="error">{{ $message }}</label>@enderror
        <input type="hidden" id="courses" value="{{ json_encode($item->courses) }}">
        <div class="select-wrap">
          <select name="course_id" class="reservation-select" onchange="changeCourse()">
            @foreach ($item->courses as $course)
              <option value="{{ old('course_id', $course->id) }}" @if((int)old('course_id')===($course->id)) selected @endif>{{ $course->name }}コース</option>
            @endforeach
          </select>
        </div>
        @error('course_id')<label class="error">{{ $message }}</label>@enderror
        @if(session('payment_id'))
        <input type="hidden" name="payment_id" value="{{ session('payment_id') }}">
        @endif
        <div class="reservation-confirm">
          <div class="confirm-item">
            <label class="confirm-item-lbl">Shop</label>
            <label>{{ $item->name }}</label>
          </div>
          <div class="confirm-item">
            <label class="confirm-item-lbl">Date</label>
            <label id="confirm-date"></label>
          </div>
          <div class="confirm-item">
            <label class="confirm-item-lbl">Time</label>
            <label id="confirm-time"></label>
          </div>
          <div class="confirm-item">
            <label class="confirm-item-lbl">Number</label>
            <label id="confirm-number"></label>
          </div>
          <div class="confirm-item">
            <label class="confirm-item-lbl">Course</label>
            <label id="confirm-course"></label>
          </div>
          <div class="confirm-item">
            <label class="confirm-item-lbl">Price</label>
            <label id="confirm-price"></label>円
          </div>
        </div>
      </div>
    </form>
    @if($payment_flg || session('payment_flg'))
    <button class="reservation-btn" onclick="confirmReservation(event)">予約する</button>
    @else
    <form id="payment-form" class="payment-form" name="payment_form" action="{{ route('payment') }}" method="POST">
      @csrf
      <div class="form-row">
        <label for="card-element">
        </label>
        <div id="card-element">
        </div>
        <input type="hidden" name="stripeEmail" value="{{ auth()->user()->email }}">
        <div id="card-errors" class="card-errors" role="alert"></div>
      </div>
    </form>
    <input type="hidden" id="pb_key" value="{{ config('services.stripe.pb_key') }}">
    <button class="payment-btn" onclick="confirmPayment(event)">決済する</button>
    @endif
  </div>
  @endauth
</div>
@endsection