<!DOCTYPE HTML>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/css/app.css">

  <script>
  //  "{{ \Log::debug(json_encode(['apiToken' => \Auth::user()->api_token])) }}";
    window.api_token = "{{ \Auth::user()->api_token }}";

  </script>
  <script src="/js/app.js" defer></script>
</head>

<body>
  <div id="app">
    <header>
      @include('header')
    </header>
    <br>
    <div class="container">
      @yield('content')
    </div>
    <footer class="footer bg-dark  fixed-bottom">
      @include('footer')
    </footer>
  </div>
</body>

</html>