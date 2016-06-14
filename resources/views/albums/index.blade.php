<div class="container">
  <div class="row">
    <div class="col-md-10 col-sm-offset-2">
      @if(Session::has('message'))
        <div class="alert alert-success">
          {!! Session::get('message') !!}
        </div>
      @endif

      @if(count($errors) > 0)
        <div class="alert alert-danger">
          <b>:( Opps!</b>
          <ul>
            @foreach($errors->all() as $error)
              <li>{!! $error !!}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">All album of You</div><!-- End panel-heading -->
        <div class="panel-body">
          @if(count($albums) > 0)
            <?php $i = 0; ?>
                <div class="row">
                  @foreach($albums as $album)
                      <div class="width-4">
                        <div class="album">
                          <div class="pull-right">
                            <div class="show-option">
                              <a class="show-option-link"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                              <ul>
                                <li>
                                  {!! Form::open(['route' => ['album.destroy',$album['user_id'], $album['id']], 'method' => 'DELETE']) !!}
                                    {!! Form::button('Xóa album', ['class' => 'btn-block option-item', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure delete this album?")']) !!}
                                  {!! Form::close() !!}
                                </li>
                                <li><a href="{!! route('album.edit', [$album['user_id'], $album['id']]) !!}" class="option-item">Chỉnh sửa</a></li>
                              </ul>
                            </div><!-- end .show-option -->
                          </div>
                          <div class="image-preview">
                            @if(count($album['images']) > 0)
                              @foreach($album['images'] as $image)
                                <img src="{!! asset($image['fullsize_url']) !!}" id="image_{!! $image['id'] !!}">
                              @endforeach
                            @endif
                          </div><!-- End image-preview -->
                          <div class="album-body">
                            <div class="album-link">
                              <b><a href="{!! route('album.show', [$album['user_id'], $album['id']]) !!}">{!! $album['album_name'] !!}</a></b>
                            </div><!-- End album-link -->
                            <div class="image-number">
                              <i>{!! count($album['images']) !!} photos</i>
                            </div><!-- End image-number -->
                          </div><!-- End album-body -->
                        </div>
                      </div><!-- End width-4 -->
                  @endforeach
                </div><!-- End row -->
          @else
            <div class="text-center">
              <div class="text-info">No album available</div>
            </div>
          @endif
        </div><!-- End panel-body -->
      </div><!-- End panel-default -->
    </div><!-- End col-md-12 -->
  </div><!-- End row -->
</div><!-- End container -->
<script src="{!! asset('js/album.js') !!}"></script>
<script type="text/javascript">
$(function(){
  loadAlbum();
});
</script>
