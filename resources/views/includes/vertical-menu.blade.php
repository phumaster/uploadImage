<div class="vertical-column">
  <nav class="vertical-menu">
    <ul id="vertical-menu">
      <li><a class="vertical-menu-a active" data-target-xhr="{!! route('index') !!}"><i class="fa fa-fw fa-feed"></i> News feed</a></li>
      <li><a href="#" class="vertical-menu-a"><i class="fa fa-fw fa-comments"></i> Messages <span class="badge">5</span></a></li>
      <li><a href="{!! route('album.index', \Auth::user()->id) !!}" class="vertical-menu-a"><i class="fa fa-camera-retro fa-fw"></i> Albums</a></li>
      <li><a href="{!! route('photo.index', \Auth::user()->id) !!}" class="vertical-menu-a"><i class="fa fa-picture-o fa-fw"></i> Photos</a></li>
      <li><a href="#" class="vertical-menu-a"><i class="fa fa-fw fa-cogs"></i> Setting</a></li>
      <li><a href="#" class="vertical-menu-a"><i class="fa fa-fw fa-sliders"></i> Preferences</a></li>
      <li><a href="#" class="vertical-menu-a"><i class="fa fa-fw fa-line-chart"></i> Activity log</a></li>
    </ul>
  </nav>
  <!-- end nav.vertical-menu -->
  <hr/>
  <div class="text-center">
    &copy; {!! date("Y") !!} Phu Master
    <br/>
  </div>
</div>
