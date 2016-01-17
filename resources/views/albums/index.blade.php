@extends('layouts.master')

@section('header.title')
  Album of {!! $user->lastName !!}
@endsection

@section('body.content')
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @if(Session::has('message'))
            <div class="alert alert-success">
              {!! Session::get('message') !!}
            </div>
          @endif

          @if(count($errors) > 0)
            <div class="alert alert-danger">
              <b><i class="fa fa-frown-o"></i> Opps!</b>
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
                                <div class="album-option" style="position: absolute; top: 0; right: 0; z-index: 999">
                                  <div class="dropdown-menu-option">
                                    <i class="fa fa-angle-down"></i>
                                    <div class="album-menu-option" tabindex="-1">
                                      <div class="">
                                        <a href="{!! route('album.edit', $album['id']) !!}" class="option-list">Edit</a>
                                      </div>
                                      {!! Form::open(['route' => ['album.destroy', $album['id']], 'method' => 'DELETE']) !!}
                                        {!! Form::button('Delete', ['class' => 'option-list', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure delete this album?")']) !!}
                                      {!! Form::close() !!}
                                    </div>
                                  </div><!-- End dropdown-menu-option -->
                                </div>
                              </div>
                              <div class="image-preview">
                                @if(count($album['images']) > 0)
                                  @foreach($album['images'] as $image)
                                    <img src="{!! asset($image['image_url']) !!}" id="image_{!! $image['id'] !!}">
                                  @endforeach
                                @endif
                              </div><!-- End image-preview -->
                              <div class="album-body">
                                <div class="album-link">
                                  <b><a href="{!! route('album.show', $album['id']) !!}">{!! $album['album_name'] !!}</a></b>
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
                  <div class="text-danger"><h4>No album available</h4></div>
                </div>
              @endif
            </div><!-- End panel-body -->
          </div><!-- End panel-default -->
        </div><!-- End col-md-12 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
  <script type="text/javascript">
  $(function() {
    $('.album .image-preview img').height($('.album').height());
    $('.album .image-preview img').width($('.album').width());

    $('.album .image-preview').each(function() {
      if($(this).children('img').length > 1) {
        $(this).children('img:gt(0)').hide();
        $(this).parent().hover(function() {
          var fun = $(this);
          setTimeout(function() {
            fun.children('.image-preview').children('img:first-child').fadeOut('slow').next('img').fadeIn('slow').end().appendTo(fun.children('.image-preview'));
          }, 700);
        });
      }else if($(this).children('img').length < 1){
        $(this).parent().css({'background':'#fff', 'border':'1px solid rgba(0,0,0,0.15)'}).find('.image-preview').html('<div class="text-danger text-center" style="padding-top: 50px"><h4>No photos in this album</h4></div>')
        .parent().parent().find('.album-body').css('background', '#222');
      }
    });

    $('.dropdown-menu-option').click(function() {
      $(this).children('.album-menu-option').toggleClass('show');
    });
  });
  </script>
@endsection
