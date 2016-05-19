@extends('layouts.master')

@section('header.title')
Features
@endsection

@section('body.content')
<div class="container-fuild margin-content">
  <div class="container">
    <div class="row">
      <div class="col-sm-2 horizontal-column hidden-xs">
        <div class="horizontal-menu">
          <ul id="horizontal-menu">
            <li><a href="{!! route('features') !!}" class="horizontal-menu-a active"><i class="fa fa-fw fa-feed"></i> Features</a></li>
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
          @if(count($posts) < 0)
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
                  <span><a href="{!! url($post->user->id) !!}"><b>{!! $post->user->name !!}</b></a> đã thêm một ảnh mới</span>
                </div>
              </div><!-- end .post-header -->
              <div class="post-body">
                <div class="text-center">
                  <a href="{!! route('image.show', [$post->user_id, $post->id]) !!}" class="view-this-post">
                    <img src="{!! asset($post->image_url) !!}" class="img-responsive"/>
                  </a>
                </div>
              </div><!-- end .post-body -->
              <div class="post-footer">
                <div><i class="post-time">{!! $post->created_at !!}</i></div>
                <div class="text-center">
                  <div class="nav-this-post">
                    <a href="{!! route('image.like', [$post->user_id, $post->id]) !!}" class="like-this-post {!! in_array(\Auth::user()->id, json_decode(is_null($post->likes) ? '[]' : $post->likes, true)) ? 'like' : '' !!}"><i class="fa fa-fw fa-heart-o"></i> {!! count(json_decode($post->likes, true)) > 0 ? count($post->likes) : "" !!} like</a> |
                    <a href="#" class="comment-this-post"><i class="fa fa-fw fa-comment-o"></i> {!! count($post->comments) > 0 ? count($post->comments) : "" !!} comment</a>
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
          <p>Biết viết gì vào cái chỗ này bây giờ. Hmmm......</p>
        </div>
      </div><!-- end col-sm-2-->
    </div>
  </div><!-- end .container -->
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(function(){
    $('.horizontal-menu-a').click(function(e){
      e.preventDefault();
      $('#horizontal-menu li a').removeClass('active');
      $(this).addClass('active');
    });

    $('.comment-this-post').click(function(e) {
      e.preventDefault();
      var parent = $(this);
      $(this).next('.form-in-this-post').slideToggle().find('.input-comment').focus();
      $(this).next('.form-in-this-post').find('.form-post-comment').submit(function(e) {
        e.preventDefault();
        var elm = $(this);
        e.preventDefault();
        $.ajax({
          method: 'POST',
          contentType: false,
          processData: false,
          url: $(this).attr('action'),
          data: new FormData(this),
          success: function(response) {
            var data = JSON.parse(response);
            notification.push(data.message, 'success');
            elm.find('.input-comment').val("");
            parent.html('<i class="fa fa-fw fa-comment-o"></i> '+data.commentCount+' comment');
          },
          error: function(response) {
            $.each(response.responseJSON, function(i, v) {
              notification.push(v, 'danger');
            });
          }
        });
      });
    });

    $('.like-this-post').click(function(e) {
      var elm = $(this);
      e.preventDefault();
      $.ajax({
        method: 'POST',
        url: $(this).attr('href'),
        data: {'_token':'{!! csrf_token() !!}'},
        success: function(response) {
          var data = JSON.parse(response);
          notification.push(data.message, 'info');
          elm.html('<i class="fa fa-fw fa-heart-o"></i> '+data.likeCount+' like');
          if(typeof data.like != "undefined" && data.like == 1) {
            elm.addClass('like');
          }else if(typeof data.like != "undefined" && data.like == 0) {
            elm.removeClass('like');
          }
        },
        error: function(response) {
          alert("Photo does not exists");
        }
      });
    });
  });
</script>
@endsection
