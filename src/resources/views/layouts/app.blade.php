<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}?v={{ time() }}">
  @yield('css')
</head>
<body>
  <header class="header">
  <div class="header__inner">
    {{-- ロゴを中央に保つための空要素（バランス用） --}}
    <div class="header-utilities"></div>

    <div class="header__logo">
      <a href="/">FashionablyLate</a>
    </div>

    <nav class="header-nav">
      @if (Auth::check())
        <form action="/logout" method="post" style="display: inline;">
          @csrf
          <button class="header-nav__button" type="submit">logout</button>
        </form>
      @elseif (Request::is('login'))
        <a href="/register" class="header-nav__link">register</a>
      @elseif (Request::is('register'))
        <a href="/login" class="header-nav__link">login</a>
      @endif
    </nav>
  </div>
</header>

  <main>
    @yield('content')
  </main>
</body>
</html>