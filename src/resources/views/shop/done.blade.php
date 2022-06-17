@extends('layouts.done')

@section('done-content')
  <p class="done-content">店舗情報を登録しました</p>
  <a href="{{ route('shop.dashboard') }}" class="btn">戻る</a>
@endsection