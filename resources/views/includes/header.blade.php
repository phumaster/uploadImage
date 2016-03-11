<header>
  <div id="header">
    <div class="container-fuild">
      <div class="container">
        <div class="row header-prefix">
          <div class="col-md-8">
            <div class="logo-header">
              <div class="pull-left"><a href="{!! url('/') !!}">
                <img src="{!! asset('images/logo.png') !!}" alt="logo" width="40px" class="logo"/>
              </a></div>
            </div>
          </div><!-- End col-md-8 -->
          <div class="col-md-4">
            <div class="pull-right navigation-user">
              @if(\Auth::check())
                <div class="user-profile">
                  <div class="menu-user">
                    <div class="primary-link-menu">
                      <div id="loading-icon" style="display: inline-block">
                      </div>
                      <a href="{!! route('image.create', \Auth::user()->id) !!}" class="link">
                        <i class="fa fa-upload fa-fw"></i>
                      </a>
                      <span> | </span>
                      <a class="show-menu link"><i class="fa fa-bars fa-fw"></i></a>
                    </div>
                    <div class="sub-menu">
                      <a href="{!! route('user.profile', \Auth::user()->id) !!}"><i class="fa fa-user"></i> <b>{!! \Auth::user()->firstName.' '.\Auth::user()->lastName !!}</b></a>
                      <a href="{!! route('album.index', \Auth::user()->id) !!}"><i class="fa fa-bolt"></i> Album</a>
                      <a href="{!! route('image.index', \Auth::user()->id) !!}"><i class="fa fa-picture-o"></i> All photos</a>
                      <a href="{!! route('logout') !!}" onclick="return confirm('Do you want to logout?')"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </div>
                  </div>
                </div>
              @else
                <div class="non-authorize">
                  <a href="{!! route('register') !!}" class="link">Join now</a> |
                  <a href="{!! route('login') !!}" class="link">Login</a>
                </div>
              @endif
            </div>
          </div><!-- Enc col-md-4 -->
        </div><!-- End row -->
      </div><!-- End container -->
    </div><!-- End container-fuild -->
  </div><!-- End #header -->
</header>
