<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    @yield('header.meta_tags')
    <title>@yield('header.title')</title>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/font-awesome.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}" />
    @yield('header.css')
    <script type="text/javascript" src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
    @yield('header.js')
  </head>
  <body class="@yield('body.class')">
    <header>
      <div id="header">
        <div class="container-fuild">
          <div class="container">
            <div class="row header-prefix">
              <div class="col-md-8">
                <div class="logo-header">
                  <div class="pull-left"><a href="{!! url('/') !!}">
                    <img src="{!! asset('images/logo.png') !!}" alt="logo" width="40px"/>
                  </a></div>
                </div>
              </div><!-- End col-md-8 -->
              <div class="col-md-4">
                <div class="pull-right navigation-user">
                  @if(\Auth::check())
                    <div class="user-profile">
                      <div class="menu-user">
                        <div class="primary-link-menu">
                          <a href="javascript:;" class="show-menu"><i class="fa fa-bars fa-fw"></i></a>
                        </div>
                        <div class="sub-menu">
                          <a href="{!! url('/') !!}"><i class="fa fa-user"></i> <b>{!! \Auth::user()->firstName.' '.\Auth::user()->lastName !!}</b></a>
                          <a href="{!! route('image.create') !!}"><i class="fa fa-upload"></i> Upload your photo</a>
                          <a href="{!! route('album.index') !!}"><i class="fa fa-bolt"></i> Album</a>
                          <a href="{!! route('image.index') !!}"><i class="fa fa-picture-o"></i> All photos</a>
                        </div>
                      </div> |
                      <a href="{!! route('logout') !!}" onclick="return confirm('Do you want to logout?')"><i class="fa fa-sign-out fa-fw"></i></a>
                    </div>
                  @else
                    <div class="non-authorize">
                      <a href="{!! route('register') !!}" class="btn btn-sm btn-success">Join now</a> |
                      <a href="{!! route('login') !!}">Login</a>
                    </div>
                  @endif
                </div>
              </div><!-- Enc col-md-4 -->
            </div><!-- End row -->
          </div><!-- End container -->
        </div><!-- End container-fuild -->
      </div><!-- End #header -->
    </header>
    @yield('body.content')
    <footer id="footer">
      @include('includes.footer')
      @yield('footer.js')
    </footer>
    <script type="text/javascript">
      $(function(){
        $('.show-menu').click(function(){
          $('.sub-menu').toggleClass('show');
        });
      });
    </script>
  </body>
</html>
