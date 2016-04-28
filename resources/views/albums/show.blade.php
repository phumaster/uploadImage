@extends('layouts.master')

@section('header.title')
{!! $album->album_name !!} : Album
@endsection

@section('body.content')
<div id="content">
  <div class="container album-show-bg">
    <div class="row">
      <div class="col-md-8">
        <div class="album-show">
          @if(count($images) > 0)
            <h4>{!! $album->album_name !!}</h4>
              <div class="album-option" style="position: absolute; top: 0; right: 0; z-index: 98">
                <div class="dropdown-menu-option">
                  <i class="fa fa-angle-down"></i>
                  <div class="album-menu-option" tabindex="-1">
                    <div class="">
                      <a href="{!! route('album.edit', [$album['user_id'], $album['id']]) !!}" class="option-list">Edit</a>
                    </div>
                    {!! Form::open(['route' => ['album.destroy', $album['user_id'], $album['id']], 'method' => 'DELETE']) !!}
                      {!! Form::button('Delete', ['class' => 'option-list', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure delete this album?")']) !!}
                    {!! Form::close() !!}
                  </div>
                </div><!-- End dropdown-menu-option -->
            </div>
            <hr/>
            <div class="list-image">
              @foreach($images as $image)
                <a href="{!! route('image.show', [$image->user_id, $image->id]) !!}">
                  <div class="image-grid" style="position: relative">
                    <div class="pull-right"  style="position: absolute; top: 0; right: 0">
                      {!! Form::open(['route' => ['image.destroy',$image->user_id, $image->id], 'method' => 'DELETE']) !!}
                        {!! Form::button('xóa', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']) !!}
                      {!! Form::close() !!}
                    </div>
                    <img src="{!! asset($image->image_url) !!}">
                  </div>
                </a>
              @endforeach
            </div><!-- End list-image -->
          @else
            <div class="text-danger text-center"><h4>No image to show on this album</h4></div>
          @endif
          <div class="text-center">{!! $images->render() !!}</div>
        </div>
      </div><!-- End col-md-8 -->
      <div class="col-md-4 album-comment-bg fix-margin-col">
        <h4>Comment</h4>
        <hr/>
        @if(count($errors) > 0)
          @foreach($errors->all() as $error)
            <div class="text-danger"><h5>{!! $error !!}</h5></div>
          @endforeach
        @endif
        @if(Session::has('message'))
          <div class="text-success"><h5>{!! Session::get('message') !!}</h5></div>
        @endif

        <div class="form-comment">
          {!! Form::open(['route' => ['album.comment', $album->user_id, $album->id], 'method' => 'POST']) !!}
            <div class="form-group">
              {!! Form::text('comment_content', '', ['class' => 'form-control', 'placeholder' => 'Write something...', 'autofocus', 'autocomplete' => 'off']) !!}
            </div>
          {!! Form::close() !!}
          <hr/>
          <div class="image-comment">
            @if(count($comments) > 0)
              @foreach($comments as $comment)
                <div class="comment">
                  <p>
                    <span class="comment-author"><a href="{!! url('/') !!}">{!! $comment->user->firstName.' '.$comment->user->lastName !!}</a></span>
                    <span class="comment-content">{{ $comment->comment_content }}</span>
                  </p>
                </div>
              @endforeach
            @else
              <div class="text-danger"><h5>No comment in this album</h5></div>
            @endif
          </div><!-- End image-comment -->
        </div>
      </div><!-- End col-md-4 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
@section('footer.js')
  <script src="{!! asset('js/album.js') !!}"></script>
@endsection

@section('js')
  <script type="text/javascript">
  $(function(){
    loadAlbum();
  });
  </script>
@endsection
