<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
    <script src="{{ asset('js/default.js') }}"></script>
    @yield('js')
</head>
<body>
  @auth('admin')
  <nav class="nav" id="nav">
    <ul class="nav-list">
      <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
      <li class="nav-item">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="nav-btn">Logout</button>
        </form>
      </li>
    </ul>
  </nav>
  @endauth
  @auth('shop')
  <nav class="nav" id="nav">
    <ul class="nav-list">
      <li class="nav-item"><a href="{{ route('shop.dashboard') }}" class="nav-link">Dashboard</a></li>
      <li class="nav-item">
        <form method="POST" action="{{ route('shop.logout') }}">
          @csrf
          <button type="submit" class="nav-btn">Logout</button>
        </form>
      </li>
    </ul>
  </nav>
  @endauth
  @auth('web')
  <nav class="nav" id="nav">
    <ul class="nav-list">
      <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="nav-btn">Logout</button>
        </form>
      </li>
      <li class="nav-item">
        <form method="GET" action="{{ route('user.show') }}">
          @csrf
          <button type="submit" class="nav-btn">MyPage</button>
        </form>
      </li>
    </ul>
  </nav>
  @endauth
  @guest
  <nav class="nav" id="nav">
    <ul class="nav-list">
      <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
      <li class="nav-item">
        <form method="GET" action="{{ route('register') }}">
          @csrf
          <button type="submit" class="nav-btn">Registration</button>
        </form>
      </li>
      <li class="nav-item">
        <form method="GET" action="{{ route('login') }}">
          @csrf
          <button type="submit" class="nav-btn">User Login</button>
        </form>
      </li>
      <li class="nav-item">
        <form method="GET" action="{{ route('admin.login') }}">
          @csrf
          <button type="submit" class="nav-btn">Admin Login</button>
        </form>
      </li>
      <li class="nav-item">
        <form method="GET" action="{{ route('shop.login') }}">
          @csrf
          <button type="submit" class="nav-btn">Shop Login</button>
        </form>
      </li>
    </ul>
  </nav>
  @endguest
  <header class="header">
    <div class="header-inner">
      <div class="menu-ttl-wrap">
        <div class="menu box-shadow" id="menu">
          <span class="menu__line--top"></span>
          <span class="menu__line--middle"></span>
          <span class="menu__line--bottom"></span>
        </div>
        <h1 class="ttl">Rese</h1>
      </div>
      <div class="search">
        @yield('search')
      </div>
    </div>
  </header>
  <div class="content">
    @yield('content')
  </div>
</body>
</html>