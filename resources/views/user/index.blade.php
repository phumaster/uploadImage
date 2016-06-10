@extends('layouts.master')

@section('header.title')
  {!! $user->name !!}
@endsection

@section('body.content')
<div class="container">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-2">
      <div class="user-view-profile">
        <div class="user-header">
          <div class="cover-photo bg-cover"
          @if(!is_null($user->getCoverPhotoUrl()))
            style="background: url({!! url($user->getCoverPhotoUrl()) !!}) no-repeat;"
          @endif
            >
            <div class="box-cover">
              @if(!is_null($user->getProfilePictureUrl()))
                <img src="{!! asset($user->getProfilePictureUrl()) !!}" class="profile-picture" alt="Avatar">
              @endif
            </div>
            @if($user->isAuthor($user->id))
            <div class="edit-option">
              <a class="btn-main btn-sm" onclick="popup.profile();" id="update-profile-picture">Update profile picture</a>
              <a class="btn-main btn-sm" onclick="popup.cover()" id="update-cover-photo">Update cover photo</a>
            </div>
            @endif
            @if(!$user->isAuthor($user->id))
            <div class="contact-people">
              @if(\Auth::user()->isFriend($user->id))
              <?php $text = '<i class="fa fa-fw fa-check"></i>'." See relationship"; $btn = "btn-success"; ?>
              @elseif(\Auth::user()->isSentRequest($user->id))
              <?php $text = '<i class="fa fa-fw fa-check"></i> '."Friend request sent"; $btn = "btn-success";?>
              @else
              <?php $text = '<i class="fa fa-fw fa-plus"></i>'." Add friend"; $btn = "btn-default";?>
              @endif
              <a class="btn {!! $btn !!} btn-sm btn-add-friend" data-target-xhr="{!! route('add-friend', $user->id) !!}">{!! $text !!}</a>
              <a class="btn btn-default btn-sm send-message-to-friend" data-name="{!! $user->name !!}" data-id="{!! $user->id !!}" data-target-xhr="{!! route('message', $user->id) !!}"><i class="fa fa-fw fa-envelope"></i> Message</a>
            </div>
            @endif
          </div><!-- End cover-photo -->
        </div><!-- End user-header -->
        @include('includes.navbar-user-profile')
        <div class="user-body">
          <div class="col-md-12">
            <div class="row">
              <div class="tab" id="tab-about">
                <!-- info -->
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4><i class="fa fa-link"></i> Basic info</h4>
                    <hr/>
                    <p><b>Name: </b> {!! $user->name !!}</p>
                    <p><b>Sex: </b> {!! $user->sex !!}</p>
                    <p><b>Birthday: </b> {!! $user->birthday !!}</p>
                    <hr/>
                    <p><b>Email </b>{!! $user->email !!}</p>
                    <hr/>
                    <p><b>Address </b>{!! $user->address !!}</p>
                    <hr/>
                    <p><b>Description </b><br/>{!! $user->description !!}</p>
                  </div>
                </div>
                <!-- end info -->
              </div>

              <div class="tab" id="tab-albums">
                <!-- albums -->
                @if(count($user->album) > 0)
                  <?php $i = 0; ?>
                        @foreach($user->album as $album)
                            <div class="width-4">
                              <div class="album">
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
                @else
                  <div class="text-center">
                    <div class="text-info"><h4>No album available</h4></div>
                  </div>
                @endif
                <!-- end albums -->
              </div>

              <div class="tab" id="tab-photos">
                <!-- photos -->
                @if(count($user->images) > 0)
                <div class="list-image-all">
                  @foreach($user->images as $image)
                    <a href="{!! route('photo.show', [$image->user_id, $image->id]) !!}">
                      <div class="image-grid" style="position: relative">

                        <img src="{!! asset($image->fullsize_url) !!}">
                      </div>
                    </a>
                  @endforeach
                </div><!-- End list-image -->
                @else
                  <div class="text-center text-info">
                    No photos to show
                  </div>
                @endif
                <!-- end photos -->
              </div>
            </div>
          </div>
          <div class="clear-fix"></div>
        </div><!-- End user-body -->
      </div>
    </div>
  </div><!-- end .row -->
</div><!-- End container -->
@endsection

@section('footer.js')
<script src="{!! asset('js/album.js') !!}"></script>
@endsection

@section('js')
  <script type="text/javascript">
  $(function(){
    //loadAlbum();
    // menu style
    $('.tab:gt(0)').hide();
    $('.view-info-profile').click(function() {
      $('.tab').hide();
      $('.view-info-profile').removeClass('li-active');
      if(!$(this).hasClass('li-active')) {
        $(this).addClass('li-active');
      }
      var id = $(this).attr('id');
      $('#tab-'+id).fadeIn(500);
      loadAlbum();
    });
    // send ajax update profile picture
    $('#update-profile-picture').click(function() {
      $('#change-profile-picture-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          contentType: false,
          processData: false,
          url: $(this).attr('action')+'{!! \Auth::user()->id !!}/update/profile_picture?r='+Math.floor(Math.random()*10),
          data: new FormData(this),
          success: function(response) {
            var data = JSON.parse(response);
            $('.box-cover').html('<img src="" class="profile-picture" alt="Avatar">');
            $('.profile-picture').attr('src', data.imageUrl);
            popup.remove();
            notification.push(data.msg, 'success');
            //$('#notification').html('').addClass('text-success').html('<span>'+data.msg+'</span>').show(0).delay(4000).fadeOut(500);
          },
          error: function(response) {
            $('.response').html('');
            $.each(response.responseJSON, function(i, val) {
              $('.response').append('<div class="text-info">'+val+'</div>');
            });
          }
        });
      });
    });
    // send ajax update cover photo
    $('#update-cover-photo').click(function() {
      $('#change-cover-photo-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          contentType: false,
          processData: false,
          url: $(this).attr('action')+'{!! \Auth::user()->id !!}/update/cover_photo?r='+Math.floor(Math.random()*10),
          data: new FormData(this),
          success: function(response) {
            var data = JSON.parse(response);
            $('.cover-photo').css({
              'background':'url('+data.imageUrl+') no-repeat',
            });
            popup.remove();
            notification.show();
            notification.push(data.msg, 'success');
          },
          error: function(response) {
            $('.response').html('');
            $.each(response.responseJSON, function(i, val) {
              $('.response').append('<div class="text-info">'+val+'</div>');
            });
          }
        });
      });
    });
  });
  </script>
@endsection
