@extends('layouts.master')

@section('header.title')
News feed
@endsection

@section('body.content')
<div class="container-fuild margin-content">
  <div class="container">
    <div class="row">
      <div class="col-sm-2 horizontal-column hidden-xs">
        <div class="horizontal-menu">
          <ul id="horizontal-menu">
            <li><a class="horizontal-menu-a active" data-target-xhr="{!! route('index') !!}"><i class="fa fa-fw fa-feed"></i> News feed</a></li>
            <li><a href="#" class="horizontal-menu-a"><i class="fa fa-fw fa-comments"></i> Messages <span class="badge">5</span></a></li>
            <li><a href="#" class="horizontal-menu-a"><i class="fa fa-fw fa-cogs"></i> Setting</a></li>
            <li><a href="#" class="horizontal-menu-a"><i class="fa fa-fw fa-sliders"></i> Preferences</a></li>
            <li><a href="#" class="horizontal-menu-a"><i class="fa fa-fw fa-line-chart"></i> Activity log</a></li>
          </ul>
        </div>
        <hr/>
        <div class="chat">
          <h4>Who's online?</h4>
          <span>No friend online</span>
        </div>
        <hr/>
        <div class="copyright">
          <div class="text-center">
            <h5>&copy; {!! date("Y") !!} Phú Master</h5>
          </div>
        </div>
      </div><!-- end .col-sm-2 -->
      <div class="col-sm-6">
        <div class="body-content">
          @if(count($suggest) > 0)
            <div class="card suggest-friend text-center">
              <p><h4>People you may know</h4></p>
              @foreach($suggest as $singleFriend)
                <div class="suggest-single-friend">
                  <div class="suggest-friend-header">
                    <a href="{!! route('user.profile', $singleFriend->id) !!}" class="link">
                      <img src="{!! !is_null($singleFriend->getProfilePictureUrl()) ? $singleFriend->getProfilePictureUrl() : url('images/logo.png') !!}"/ class="suggest-thumbnail" data-toggle="tooltip" data-placement="right" title="{!! $singleFriend->name !!}">
                    </a>
                  </div>
                  @if(\Auth::user()->isSentRequest($singleFriend->id))
                  <?php $text = '<i class="fa fa-fw fa-check"></i> '."friend request sent"; $btn = "btn-success";?>
                  @else
                  <?php $text = '<i class="fa fa-fw fa-plus"></i>'." add friend"; $btn = "btn-default";?>
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
              <i class="fa fa-fw fa-frown-o fa-2x"></i>
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
                <div class="text-center">
                  <a href="{!! route('image.show', [$post->user_id, $post->id]) !!}" class="view-this-post">
                    <img src="{!! asset($post->fullsize_url) !!}" class="img-responsive"/>
                  </a>
                </div>
              </div><!-- end .post-body -->
              <div class="post-footer">
                <div><i class="post-time">{!! $post->created_at !!}</i></div>
                <div class="text-center">
                  <div class="nav-this-post">
                    <a data-target-xhr="{!! route('image.like', [$post->user_id, $post->id]) !!}" class="like-this-post {!! in_array(\Auth::user()->id, json_decode(is_null($post->likes) ? '[]' : $post->likes, true)) ? 'like' : '' !!}"><i class="fa fa-fw fa-heart-o"></i> {!! count(json_decode($post->likes, true)) > 0 ? count($post->likes) : "" !!} like</a> |
                    <a class="comment-this-post"><i class="fa fa-fw fa-comment-o"></i> {!! count($post->comments) > 0 ? count($post->comments) : "" !!} comment</a>
                    <div class="form-in-this-post">
                      <hr/>
                      {!! Form::open(['route' => ['image.comment', $post->user->id, $post->id], 'method' => 'POST', 'class' => 'form-post-comment']) !!}
                      <div class="form-group">
                        {!! Form::text('comment_content', '', ['class' => 'form-control input-comment', 'placeholder' => 'write a comment...']) !!}
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
      </div><!-- end .col-sm-6 -->
      <div class="col-sm-4 hidden-xs">
        <div class="content-right">
          <div class="">
            <a href="{!! route('image.create', \Auth::user()->id) !!}" class="btn btn-main btn-block">Upload new photos</a>
            <a href="{!! route('album.create', \Auth::user()->id) !!}" class="btn btn-main btn-block">New album</a>
          </div>
          <hr/>
          <p>Viết gì vào đây giờ....</p>
        </div>
      </div><!-- end col-sm-2-->
    </div>
  </div><!-- end .container -->
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(function(){
    // $('.author-name').showHoverCard();

    $('.horizontal-menu-a').click(function(e){
      e.preventDefault();
      $('#horizontal-menu li a').removeClass('active');
      $(this).addClass('active');
    });

    $('.comment-this-post').click(function(e) {
      e.preventDefault();
      var parent = $(this);
      $(this).next('.form-in-this-post').slideToggle().find('.input-comment').focus();
    });

    $('.form-post-comment').commentThisPhoto();

    $('.like-this-post').likeThisPhoto();
  });
</script>
@endsection
