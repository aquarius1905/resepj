@section('search')
<form class="search-form box-shadow" action="{{ route('shops.search') }}" name="search" method="get">
  @csrf
  <div class="search-form-inner">
    <div class="search-select-wrap">
      <select onchange="document.search.submit();" name="area" class="search-select">
        <option value="0" selected>All area</option>
        @foreach($areas as $area)
          <option value="{{ $area->id }}" @if ($inputs && $inputs['area'] == $area->id) selected @endif>{{ $area->name }}</option>
        @endforeach
      </select>
    </div>
    <span class="partition">|</span>
    <div class="search-select-wrap">
      <select onchange="document.search.submit();" name="genre" class="search-select">
        <option value="0" selected>All genre</option>
        @foreach($genres as $genre)
          <option value="{{ $genre->id }}" @if ($inputs && $inputs['genre'] == $genre->id) selected @endif>{{ $genre->name }}</option>
        @endforeach
      </select>
    </div>
    <span class="partition">|</span>
    <div class="search-shopname-box">
      <input type="text" name="shop_name" placeholder="Search..." class="search-shopname-input" value="@if ($inputs && $inputs['shop_name']) {{ $inputs['shop_name'] }} @endif">
    </div>
  </div>
</form>
@endsection