<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <base href="http://localhost:8000/" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('header.metaTags')
    <title>@yield('header.title')</title>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/font-awesome.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/non-authorize.css') !!}" />
    @yield('header.css')
    <script type="text/javascript" src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    @yield('header.js')
  </head>
  <body class="@yield('body.class')">
    <div id="content">
      <header id="header">
        @yield('header')
      </header>
      <section>
        @yield('body.content')
      </section>
      <footer id="footer">
        @yield('footer')
      </footer>
    </div>
    <div id="overlay-loading">
      <div class="spinner">
        <div class="circle-spin"></div>
        <p>loading...</p>
      </div>
    </div>
    <script type="text/javascript">
    document.getElementById('content').style.display = 'none';

    $(document).ready(function() {
      $('#overlay-loading').fadeOut(1000, 'swing', function() {
        $('#content').fadeIn(1000);
      });
    });
    </script>
    @yield('footer.js')
    @yield('js')
  </body>
</html>
