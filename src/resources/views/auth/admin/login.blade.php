@extends('layouts.default')

@section('content')
<div class="login box-shadow">
  <h2 class="login-ttl">Admin Login</h2>
  <form class="login-form" action="{{ route('admin.store') }}" method="POST">
    @csrf
    <div class="login-input-wrap">
      <img src="{{ asset('images/email.png') }}" alt="email" class="login-img">
      <input type="email" name="email" class="login-input" placeholder="Email" value="{{ old('email') }}">
    </div>
    @error('email')<label class="error">{{ $message }}</label>@enderror
    <div class="login-input-wrap">
      <img src="{{ asset('images/password.png') }}" alt="password" class="login-img">
      <input type="password" name="password" class="login-input" placeholder="Password">
    </div>
    @error('password')<label class="error">{{ $message }}</label>@enderror
    @error('login_error')<label class="error">{{ $message }}</label>@enderror
    <div class="login-btn-wrap">
      <button type="submit" class="login-btn">ログイン</button>
    </div>
  </form>
</div>
@endsection