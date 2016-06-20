<div class="container">
  <div class="row">
    <div class="col-sm-7 col-sm-offset-2">
      <div class="body-content">
        <div class="post visible-xs">
          <a class="btn btn-main" data-toggle="modal" data-target="#show-upload-modal"><span class="glyphicon glyphicon-cloud-upload"></span> Upload new photo</a>
          <a class="btn btn-main" data-toggle="modal" data-target="#show-create-album-modal"><span class="glyphicon glyphicon-plus"></span> New album</a>
        </div>
        @if(count($suggest) > 0)
          <div class="card suggest-friend text-center">
            <p><h4>People you may know</h4></p>
            @foreach($suggest as $singleFriend)
              <div class="suggest-single-friend">
                <div class="suggest-friend-header">
                  <a href="{!! route('user.profile', $singleFriend->id) !!}" class="link">
                    <img src="{!! $singleFriend->getProfilePictureUrl() !!}"/ class="suggest-thumbnail" data-toggle="tooltip" data-placement="right" title="{!! $singleFriend->name !!}">
                  </a>
                </div>
                @if(\Auth::user()->isSentRequest($singleFriend->id))
                <?php $text = '<span class="glyphicon glyphicon-check"></span> '."pending"; $btn = "btn-success";?>
                @else
                <?php $text = '<span class="glyphicon glyphicon-plus"></span>'." add"; $btn = "btn-default";?>
                @endif
                <div class="suggest-friend-body">
                  <a class="btn btn-sm {!! $btn !!} display-block btn-add-friend" data-target-xhr="{!! route('add-friend', $singleFriend) !!}">{!! $text !!}</a>
                </div>
              </div>
            @endforeach
          </div>
        @endif

        @if(count($posts) <= 0)
          <div class="no-post">
            :(
            <br/>
            <div class="text-info">Opps! No posts yet</div>
          </div>
        @else
          @foreach($posts as $post)
          <div class="post">
            <div class="post-header">
              <div class="post-author">
                <a href="{!! url($post->user->id) !!}" class="author-name"><b>{!! $post->user->name !!}</b></a> {!! $post->make_as_profile_picture == 1 ? "changed profile picture" : "added a new photo" !!}
              </div>
            </div><!-- end .post-header -->
            <div class="post-body">
              <p>{{ $post->image_caption }}</p>
              <div class="text-center">
                <a href="{!! route('photo.show', [$post->user_id, $post->id]) !!}" class="view-this-post">
                  <img src="{!! asset($post->fullsize_url) !!}" class="img-responsive"/>
                </a>
              </div>
            </div><!-- end .post-body -->
            <div class="post-footer">
              <div><i class="post-time">{!! TimeHelper::convert(time() - strtotime($post->created_at)) !!}</i></div>
              <div class="text-center">
                <div class="nav-this-post">
                  <a data-target-xhr="{!! route('photo.like', [$post->user_id, $post->id]) !!}" class="like-this-post {!! in_array(\Auth::user()->id, json_decode(is_null($post->likes) ? '[]' : $post->likes, true)) ? 'like' : '' !!}"><span class="glyphicon glyphicon-heart-empty"></span> {!! count(json_decode($post->likes, true)) > 0 ? count($post->likes) : "" !!} like</a> |
                  <a class="comment-this-post"><span class="glyphicon glyphicon-comment"></span> {!! count($post->comments) > 0 ? count($post->comments) : "" !!} comment</a>
                  <div class="form-in-this-post">
                    <hr/>
                    {!! Form::open(['route' => ['photo.comment', $post->user->id, $post->id], 'method' => 'POST', 'class' => 'form-post-comment']) !!}
                    <div class="form-group">
                      {!! Form::text('comment_content', '', ['class' => 'input-form-primary input-comment', 'placeholder' => 'write a comment...']) !!}
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div><!-- end .post-footer -->
          </div>
          @endforeach
        @endif
      </div>
    </div><!-- end .col-sm-7 -->
    <div class="col-sm-3 hidden-xs fix-padding-col-right">
      <div class="content-right">
        <div class="btn-navigator">
          <a class="btn btn-main" data-toggle="modal" data-target="#show-upload-modal"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</a>
          <a class="btn btn-main" data-toggle="modal" data-target="#show-create-album-modal"><span class="glyphicon glyphicon-plus"></span> Album</a>
        </div>
        <hr/>
        <div class="list-friends">
          <h4>Friends</h4>
          @if(count($friends) > 0)
            <div class="friends">
              @foreach($friends as $friend)
                <div class="send-message-to-friend" data-name="{!! $friend->name !!}" data-id="{!! $friend->id !!}" data-target-xhr="{!! route('message', $friend->id) !!}">
                  <span data-toggle="tooltip" data-placement="right" title="Click to send message"><img src="{!! $friend->getProfilePictureUrl() !!}" class="logo-user"/> {!! $friend->name !!}</span>
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center">
              <a href="#" class="btn btn-main btn-sm">Find friend</a>
            </div>
          @endif
        </div><!-- end list-friends -->
        <hr/>
        <p>
          <i>Smile, breathe, and go slowly. - <b>Thich Nhat Hanh</b></i>
        </p>
      </div>
    </div><!-- end col-sm-3-->
  </div>
  <!-- upload modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="show-upload-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Upload a new photo</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['route' => ['photo.store', \Auth::user()->id],'files' => true, 'method' => 'POST', 'class' => 'form-upload-photo']) !!}
            <div class="response"></div>
            <div class="form-group">
              {!! Form::label('image_caption', 'Write something...') !!}
              {!! Form::textarea('image_caption', '', ['class' => 'input-form-primary', 'id' => 'image_caption']) !!}
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  {!! Form::label('image', 'Choose a photo') !!}
                  {!! Form::file('image', ['id' => 'image', 'class' => '']) !!}
                </div>
                <div class="col-md-6">
                  <img src="" class="thumbnail hide" id="preview-thumbnail" style="max-width: 100%" alt="Image preview..."/>
                </div>
              </div>
            </div>
            @if(count($albums) > 0)
              <div class="form-group">
                {!! Form::label('album_id', 'Select album') !!}
                {!! Form::select('album_id', $albums, null, ['class' => 'input-form-primary', 'id' => 'album_id']) !!}
              </div>
            @endif
            <div class="form-group">
              {!! Form::button('<span class="glyphicon glyphicon-cloud-upload"></span> Upload', ['class' => 'btn-main', 'type' => 'submit']) !!}
              {!! Form::button('<span class="glyphicon glyphicon-refresh"></span> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div><!-- end .modal -->
  <!-- create album modal -->
  <div class="modal fade" tabindex="-1" id="show-create-album-modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
          <h4 class="modal-title">Create new album</h4>
        </div>
        <div class="modal-body">
          @include('includes.form-create-album')
        </div>
      </div>
    </div>
  </div><!-- end .modal#show-create-album-modal -->
</div><!-- end .container -->
<script type="text/javascript">
  $(function(){
    $('.comment-this-post').click(function(e) {
      e.preventDefault();
      var parent = $(this);
      $(this).next('.form-in-this-post').slideToggle().find('.input-comment').focus();
    });

    $('.form-post-comment').commentThisPhoto();

    $('.like-this-post').likeThisPhoto();

    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
