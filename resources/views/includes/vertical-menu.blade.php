<div class="vertical-column">
  <nav class="vertical-menu">
    <ul id="vertical-menu">
      <li><a class="vertical-menu-a active target" data-target-xhr="{!! route('index') !!}"><span class="glyphicon glyphicon-list-alt"></span> News feed</a></li>
      <li><a class="vertical-menu-a target" href="{!! route('user.profile', Auth::user()->id) !!}"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
      <li><a class="vertical-menu-a target" data-target-xhr="{!! route('messages') !!}" id="menu-link-message"><span class="glyphicon glyphicon-inbox"></span> Messages</a></li>
      <li><a class="vertical-menu-a target" data-target-xhr="{!! route('album.index', \Auth::user()->id) !!}"><span class="glyphicon glyphicon-film"></span> Albums</a></li>
      <li><a class="vertical-menu-a target" data-target-xhr="{!! route('photo.index', \Auth::user()->id) !!}"><span class="glyphicon glyphicon-picture"></span> Photos</a></li>
      <li><a href="#" class="vertical-menu-a target"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
      <li><a href="#" class="vertical-menu-a target"><span class="glyphicon glyphicon-tasks"></span> Preferences</a></li>
      <li><a href="#" class="vertical-menu-a target"><span class="glyphicon glyphicon-stats"></span> Activity log</a></li>
      <li><a href="/founder" class="vertical-menu-a target"><span class="glyphicon glyphicon-ok"></span> About project
      <br/>
      <small>Xem thêm thông tin project tại đây</small>
      </a></li>
    </ul>
  </nav>
  <!-- end nav.vertical-menu -->
  <hr/>
  <div class="text-center">
    &copy; {!! date("Y") !!} Phu Master | hoạt động thử nghiệm
    <br/>
  </div>
</div>
