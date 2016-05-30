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
                      <ul class="header-navigation">
                        @if(Route::current()->getName() != 'index')
                        <li><a href="{!! route('image.create', \Auth::user()->id) !!}" class="link"><i class="fa fa-cloud-upload fa-fw"></i></a></li>
                        @endif
                        <li><a href="#" class="link"><i class="fa fa-bell fa-fw"></i></a></li>
                        <li><a href="{!! route('album.index', \Auth::user()->id) !!}" class="link"><i class="fa fa-camera-retro fa-fw visible-xs"></i> <span class="hidden-xs">albums</span></a></li>
                        <li><a href="{!! route('image.index', \Auth::user()->id) !!}" class="link"><i class="fa fa-picture-o fa-fw visible-xs"></i> <span class="hidden-xs">photos</span></a></li>
                        <li><a class="show-menu link"><img src="{!! !is_null(\Auth::user()->getProfilePictureUrl()) ? \Auth::user()->getProfilePictureUrl() : url('images/logo.png') !!}"/ class="logo-user"> <i class="fa fa-fw fa-angle-down"></i></a></li>
                      </ul>
                      <div class="sub-menu">
                        <a href="{!! route('user.profile', \Auth::user()->id) !!}"><i class="fa fa-fw fa-user"></i> View profile</a>
                        <a href="{!! route('logout') !!}" onclick="return confirm('Do you want to logout?')"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div><!-- Enc col-md-4 -->
        </div><!-- End row -->
      </div><!-- End container -->
    </div><!-- End container-fuild -->
  </div><!-- End #header -->
</header>
