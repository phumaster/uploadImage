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
                      <ul class="header-navigation">
                        @if(Route::current()->getName() != 'index')
                        <li><a href="{!! route('photo.create', \Auth::user()->id) !!}" class="link"><span class="glyphicon glyphicon-cloud-upload"></span></a></li>
                        @endif
                        <li><a href="#" class="link"><span class="glyphicon glyphicon-globe"></span></a></li>
                        <li><a href="#" class="link notify"><span class="glyphicon glyphicon-comment"></span><span class="badge badge-message">99+</span></a></li>
                        <li><a class="show-menu link"><span class="glyphicon glyphicon-menu-down"></span></a></li>
                      </ul>
                      <div class="sub-menu">
                        <a href="{!! route('user.profile', \Auth::user()->id) !!}"><img src="{!! !is_null(\Auth::user()->getProfilePictureUrl()) ? \Auth::user()->getProfilePictureUrl() : url('images/logo.png') !!}"/ class="logo-user">  View profile</a>
                        <a href="{!! route('logout') !!}" onclick="return confirm('Do you want to logout?')"><span class="glyphicon glyphicon-off"></span> Logout</a>
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
