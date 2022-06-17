@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done box-shadow">
  <div class="done-inner">
    @yield('done-content')
  </div>
</div>
@endsection