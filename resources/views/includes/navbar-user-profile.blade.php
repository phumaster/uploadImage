<nav role="menu">
  <div class="navbar-user">
    <ul id="navbar-user-profile">
      <li data-send="{!! route('user.about', \Auth::user()->id) !!}" class="view-info-profile btn-main btn-sm li-active" id="about">About</li>
      <li data-send="{!! route('album.index', \Auth::user()->id) !!}" class="view-info-profile btn-main btn-sm" id="albums">Album</li>
      <li data-send="{!! route('photo.index', \Auth::user()->id) !!}" class="view-info-profile btn-main btn-sm" id="photos">Photos</li>
    </ul>
  </div>
</nav>
