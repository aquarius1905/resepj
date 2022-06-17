@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_dashboard.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/confirm.js') }}"></script>
<script src="{{ asset('js/shop_dashboard.js') }}"></script>
@endsection

@section('content')
<div class="shop-dashboard">
  <div class="shop-info">
    <h2 class="shop-info-ttl">店舗情報{{ $shop ? "更新" : "作成"}}</h2>
    <form class="shop-info-form box-shadow" method="POST" action="{{ $shop ? route('shop.update', ['shop_id' => $shop->id]) : route('shop.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="representative_id" value="{{ $representative_id }}">
      <div class="shop-info-content">
        <div class="shop-info-item">
          <label class="shop-info-lbl" for="name">Name</label>
          <input type="text" class="shop-info-name" id="name" name="name" value="{{ $shop ? $shop->name : old('name')}}"></input>
        </div>
        @error('name')<label class="error">{{ $message }}</label>@enderror
        <div class="shop-info-item">
          <label class="shop-info-lbl" for="area">Area</label>
          <div class="shop-info-select-wrap">
            <select name="area_id" id="area" class="shop-info-select">
              @foreach ($areas as $area)
                <option value="{{ $area->id }}"  @if($shop && $shop->area_id == $area->id) selected @endif>{{ $area->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        @error('area')<label class="error">{{ $message }}</label>@enderror
        <div class="shop-info-item">
          <label class="shop-info-lbl" for="genre">Genre</label>
          <div class="shop-info-select-wrap">
            <select name="genre_id" id="genre" class="shop-info-select">
              @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @if($shop && $shop->genre_id == $genre->id) selected @endif>{{ $genre->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        @error('genre')<label class="error">{{ $message }}</label>@enderror
        <div class="shop-info-item">
          <label for="overview" class="shop-info-lbl" >Overview</label>
          <textarea class="shop-info-overview" id="overview" name="overview">{{ $shop ? $shop->overview : old('overview')}}</textarea>
        </div>
        @error('overview')<label class="error">{{ $message }}</label>@enderror
        @for($i = 0; $i < 3; $i++)
        <div class="shop-info-item">
          <label for="course" class="shop-info-lbl" >Course{{$i + 1}}</label>
          <input type="text" class="shop-info-course" id="course" name="course_names[]" value="{{ $courses ? $courses[$i]->name : old('course_names.'.$i) }}"><label>コース</label></input>
          <input type="number" class="shop-info-price" name="course_prices[]" value="{{ $courses ? $courses[$i]->price : old('course_prices.'.$i) }}" pattern="^[1-9][0-9]*$"><label>円</label></input>
        </div>
        @error('course_names.'.$i)<label class="error">{{ $message }}</label>@enderror
        @error('course_prices.'.$i)<label class="error">{{ $message }}</label>@enderror
        @endfor

        <div class="shop-info-item">
          <label for="shop-img-file" class="shop-info-lbl">Image</label>
          <input type="file" class="shop-img-file" id="shop-img-file" name="img" accept="image/png, image/jpeg" onchange="previewImg(event)">
        </div>
        @error('img')<label class="error">{{ $message }}</label>@enderror
        @if($shop)
        <div class="shop-img-wrap">
          @if(app()->isLocal() || app()->runningUnitTests())
            <img class="card-img" src="{{ asset('storage/'.$shop->img_filename) }}" alt="{{ $shop->name }}">
          @else
            <img class="card-img" src="{{ Storage::disk('s3')->url("{$shop->img_filename}") }}" alt="{{ $shop->name }}">
          @endif
          
        </div>
        @endif
      </div>
      <div>
        @if($shop)
        <button type="submit" class="shop-btn" onclick="confirmShopUpdate(event)">店舗情報を更新する</button>
        @else
        <button type="submit" class="shop-btn" onclick="confirmShopRegisteration(event)">店舗情報を登録する</button>
        @endif
      </div>
    </form>
  </div>
  <div class="reservation-info">
    <h2 class="reservation-info-ttl">予約情報</h2>
    @if($reservations)
    <table class="reservation-info-table box-shadow">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Date</th>
          <th scope="col">Time</th>
          <th scope="col">Course</th>
          <th scope="col">Number</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reservations as $reservation)
        <tr>
          <td data-label="No">{{ $loop->index + 1 }}</td>
          <td data-label="Name">{{ $reservation->getUserName() }}</td>
          <td data-label="Date">{{ $reservation->date->format('Y-m-d') }}</td>
          <td data-label="Time">{{ $reservation->time->format('H:i') }}</td>
          <td data-label="Course">{{ $reservation->getCourseName() }}</td>
          <td data-label="Number">{{ $reservation->number }}人</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
  <div class="rating-info">
    <h2 class="rating-info-ttl">評価</h2>
    @if($ratings)
    <table class="rating-info-table box-shadow">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Rating</th>
          <th scope="col">Comment</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ratings as $rating)
        <tr>
          <td data-label="No">{{ $loop->index + 1 }}</td>
          <td data-label="Name">{{ $rating->getUserName() }}</td>
          <td data-label="Rating">{{ $rating->rating }}</td>
          <td data-label="Comment">{{ $rating->comment }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
</div>
@endsection