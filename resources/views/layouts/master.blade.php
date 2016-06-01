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
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
    <script src="{!! asset('js/extends.js') !!}"></script>
    @yield('header.js')
  </head>
  <body class="@yield('body.class')">
    @include('includes.vertical-menu')
    @include('includes.header')
    @yield('body.content')
    <footer id="footer">
      @include('includes.footer')
    </footer>
    <script type="text/javascript">
      $(function(){
        $('.show-menu').click(function(){
          if($('.sub-menu').is(':hidden')) {
            $('.sub-menu').show(200);
          }else{
            $('.sub-menu').hide(200);
          }
        });
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
    @yield('footer.js')
    <script type="text/javascript">
      notification.create();
      $(document).ready(function() {
        $('.vertical-menu-a').click(function(e){
          e.preventDefault();
          $('#vertical-menu li a').removeClass('active');
          $(this).addClass('active');
        });
        var h_h = $('#header').height();
        $('.vertical-column').css({"padding-top":h_h+10});
      });
    </script>
    <script type="text/javascript" src="{!! asset('js/add-friend.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/pull.js') !!}"></script>
    @yield('js')
  </body>
</html>
