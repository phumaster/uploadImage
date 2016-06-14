<header>
  <div id="header">
    <div class="container-fuild">
      <div class="container">
        <div class="row header-prefix">
          <div class="col-md-8">
            <div class="logo-header">
              <div class="pull-left">
                <a href="{!! url('/') !!}" class="logo hidden-xs">
                  <span class="glyphicon glyphicon-home"></span>
                </a>
                <div id="show-vertical-menu" class="menu-bar visible-xs logo" data-toggle="tooltip" data-placement="right" title="menu">
                  <span class="glyphicon glyphicon-menu-hamburger"></span>
                </div>
              </div>
            </div>
          </div><!-- End col-md-8 -->
          <div class="col-md-4">
            <div class="pull-right">
              @if(\Auth::check())
                <nav class="navigation-menu-header">
                  @if(Route::current()->getName() != 'index')
                  <div class="navigator-item">
                    <a href="{!! route('photo.create', \Auth::user()->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Upload new photo"><span class="glyphicon glyphicon-cloud-upload"></span></a>
                  </div>
                  @endif
                  <div class="navigator-item">
                    <a href="#" class="notify" data-toggle="tooltip" data-placement="bottom" title="Notification"><span class="glyphicon glyphicon-globe"></span></a>
                  </div>
                  <div class="navigator-item">
                    <a href="#" class="notify" id="show-friends-request" data-toggle="tooltip" data-placement="bottom" title="Friend requests"><span class="glyphicon glyphicon-user"></span><span class="badge badge-friends"></span></a>
                  </div>
                  <div class="navigator-item">
                    <a class="notify notify-message" onclick="return document.getElementById('menu-link-message').click()" data-toggle="tooltip" data-placement="bottom" title="Messages"><span class="glyphicon glyphicon-comment"></span><span class="badge badge-message"></span></a>
                  </div>
                  <div class="navigator-item">
                    <a href="{{ route('logout') }}" onclick="return confirm('Do you really want to logout?');" data-toggle="tooltip" data-placement="bottom" title="Logout"><span class="glyphicon glyphicon-off"></span></a>
                  </div>
                </nav>
                <div class="nav-content">

                </div>
              @endif
            </div><!-- pull right -->
          </div><!-- Enc col-md-4 -->
        </div><!-- End row -->
      </div><!-- End container -->
    </div><!-- End container-fuild -->
  </div><!-- End #header -->
</header>
