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
    <link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}" />
    @yield('header.css')
    <script type="text/javascript" src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
    @yield('header.js')
  </head>
  <body class="@yield('body.class')">
    @include('includes.header')
    @yield('body.content')
    <footer id="footer">
      @include('includes.footer')
    </footer>
    <script type="text/javascript">
      $(function(){
        $('.show-menu').click(function(){
          $('.sub-menu').toggleClass('show');
        });
      });
    </script>
    @yield('footer.js')
    <script type="text/javascript">
      notification.create();
    </script>
    @yield('js')
  </body>
</html>
