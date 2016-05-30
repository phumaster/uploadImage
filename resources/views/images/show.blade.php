@extends('layouts.master')

@section('header.title')
  Photo of {!! $image->user->name !!}
@endsection

@section('body.content')
  <div id="content">
    <div class="container-fuild">
      <div class="container image-show-bg">
        <div class="row">
          <div class="col-md-8 fix-margin-col">
            <div class="image-show">
              <img src="{!! asset($image->fullsize_url) !!}" class="img-responsive">
            </div><!-- End image-show -->
          </div><!-- End col-md-8 -->
          <div class="col-md-4 image-comment-bg">
            <div class="info-image-show">
              <div class="image-author">
                <h4><a href="{!! url('/') !!}">{!! $image->user->name !!}</a></h4>
              </div>
              {!! Form::open(['route' => ['image.destroy',$image->user_id, $image->id], 'method' => 'DELETE']) !!}
                {!! Form::button('xóa ảnh', ['class' => 'btn-link text-danger', 'type' => 'submit']) !!}
              {!! Form::close() !!}
              <div class="image-caption">
                <p>{!! $image->image_caption !!}</p>
              </div>
              <hr/>
              @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                  <div class="text-danger"><h5>{!! $error !!}</h5></div>
                @endforeach
              @endif
              @if(Session::has('message'))
                <div class="text-success"><h5>{!! Session::get('message') !!}</h5></div>
              @endif
              <div class="image-form-comment">
                {!! Form::open(['route' => ['image.comment', $image->user_id, $image->id], 'method' => 'POST', 'class' => 'comment-this-photo']) !!}
                  <div class="form-group">
                    {!! Form::text('comment_content', '', ['class' => 'form-control input-comment', 'placeholder' => 'Write something...', 'autocomplete' => 'off', 'autofocus' => 'true']) !!}
                  </div>
                {!! Form::close() !!}
              </div>
              <hr/>
            </div><!-- end info-image-show -->
            <div class="image-comment">
              @if(count($image->comments) > 0)
                @foreach($image->comments as $comment)
                  <div class="comment">
                    <p>
                      <span class="comment-author"><a href="{!! url('/') !!}">{!! $comment->user->name !!}</a></span>
                      <span class="comment-content">{{ $comment->comment_content }}</span>
                    </p>
                  </div>
                @endforeach
                <br/>
                <div class="comment-count">
                  <i>{!! count($image->comments) !!} comment</i>
                </div>
                <br/>
              @else
                <div class="text-danger"><h5>No comment in this photo</h5></div>
              @endif
            </div><!-- End image-comment -->
          </div><!-- End col-md-4 -->
        </div><!-- End row -->
      </div><!-- End container -->
    </div><!-- End container-fuild -->
  </div><!-- End #content -->
@endsection

@section('footer.js')
<script type="text/javascript">
  $(document).ready(function() {
    $('.comment-this-photo').commentThisPhoto();
  });
</script>
@endsection
