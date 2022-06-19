@extends('layouts.default')
@section('content')
<div class="dashboard box-shadow">
  <h2 class="dashboard-ttl">店舗代表者登録</h2>
  <form class="register-form" action="{{ route('shop_represetative.store') }}" method="POST">
    @csrf
    <div class="register-input-wrap">
      <img src="{{ asset('images/representative.png') }}" alt="name" class="register-img">
      <input type="text" name="name" class="register-input" value="{{ old('name') }}" placeholder="Name">
    </div>
    @error('name')<label class="error">{{ $message }}</label>@enderror
    <div class="register-input-wrap">
      <img src="{{ asset('images/email.png') }}" alt="email" class="register-img">
      <input type="email" name="email" class="register-input" value="{{ old('email') }}" placeholder="Email">
    </div>
    @error('email')<label class="error">{{ $message }}</label>@enderror
    <div class="register-input-wrap">
      <img src="{{ asset('images/password.png') }}" alt="password" class="register-img">
      <input type="password" name="password" class="register-input" placeholder="Password">
    </div>
    @error('password')<label class="error">{{ $message }}</label>@enderror
    <div class="register-btn-wrap">
      <button type="submit" class="register-btn">登録</button>
    </div>
  </form>
</div>
@endsection