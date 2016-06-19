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
                    <a data-target-tab="#tab-notification" class="notify" data-toggle="tooltip" data-placement="bottom" title="Notification"><span class="glyphicon glyphicon-globe"></span></a>
                  </div>
                  <div class="navigator-item">
                    <a data-target-tab="#tab-friend-request" class="notify" id="show-friends-request" data-toggle="tooltip" data-placement="bottom" title="Friend requests"><span class="glyphicon glyphicon-user"></span><span class="badge badge-friends"></span></a>
                  </div>
                  <div class="navigator-item">
                    <a class="notify notify-message" onclick="return document.getElementById('menu-link-message').click()" data-toggle="tooltip" data-placement="bottom" title="Messages"><span class="glyphicon glyphicon-comment"></span><span class="badge badge-message"></span></a>
                  </div>
                  <div class="navigator-item">
                    <a href="{{ route('logout') }}" onclick="return confirm('Do you really want to logout?');" data-toggle="tooltip" data-placement="bottom" title="Logout"><span class="glyphicon glyphicon-off"></span></a>
                  </div>
                </nav>
              @endif
            </div><!-- pull right -->
          </div><!-- Enc col-md-4 -->
        </div><!-- End row -->
      </div><!-- End container -->
    </div><!-- End container-fuild -->
  </div><!-- End #header -->
  <div class="nav-content">
    <div class="pull-right">
      <div class="close-tab" data-toggle="tooltip" data-placement="left" title="Close"><a>&times;</a></div>
    </div>
    <div class="clear-fix"></div>
    <div id="tab-notification">
      <div class="text-center">
        <span class="glyphicon glyphicon-bell"></span>
        Nothing new
      </div>
    </div><!-- end #tab-notification -->
    <div id="tab-friend-request">
      @if(count($friendRequest) > 0)
        @foreach($friendRequest as $request)
          <div class="card-friend-request">
            <div class="author-request">
              <a href="{{ route('user.profile', $request->getUserSend->id) }}">
                <img class="logo-user" src="{{ $request->getUserSend->getProfilePictureUrl() }}" alt="{{ $request->getUserSend->name }}">
                <b>{{ $request->getUserSend->name }}</b>
              </a>
            </div>
            <div class="pull-right">
              <a href="{{ route('accept-request', [$request->getUserSend->id, 'accept' => 'yes']) }}">
                <span class="glyphicon glyphicon-ok"></span> Accept
              </a>
              .
              <a href="{{ route('accept-request', [$request->getUserSend->id, 'accept' => 'no']) }}">
                Ignore
              </a>
            </div>
            <div class="clear-fix"></div>
          </div>
        @endforeach
      @else
        <div class="text-center">
          <span class="glyphicon glyphicon-bell"></span>
          Nothing done, nothing show
        </div>
      @endif
    </div><!-- end #tab-friend-request -->
    <div id="tab-messages">
      @yield('history-messages')
    </div><!-- end #tab-messages -->
  </div>
</header>
