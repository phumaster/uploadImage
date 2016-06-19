<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <base href="{!! url('/').'/'; !!}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('header.metaTags')
    <title>@yield('header.title')</title>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}" />
    @yield('header.css')
    <script type="text/javascript" src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
    <script src="{!! asset('js/extends.js') !!}"></script>
    @yield('header.js')
  </head>
  <body class="@yield('body.class')">
    @if(\Auth::check())
      @include('includes.vertical-menu')
    @endif
    @include('includes.header')
    <div id="content">
      @yield('body.content')
    </div><!-- end #content -->
    <footer id="footer">
      @include('includes.footer')
    </footer>
    <script type="text/javascript">
      $(function(){
        $('.show-menu').click(function(){
          var elm = $(this);
          if($('.sub-menu').is(':hidden')) {
            $('.sub-menu').show(200);
            elm.html('<span class="glyphicon glyphicon-menu-up"></span>');
          }else{
            $('.sub-menu').hide(200);
            elm.html('<span class="glyphicon glyphicon-menu-down"></span>');
          }
        });
        /* show tooltip when hover */
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
    @yield('footer.js')
    <script type="text/javascript" src="{!! asset('js/add-friend.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/pull.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/extra.js') !!}"></script>
    @yield('js')
  </body>
</html>