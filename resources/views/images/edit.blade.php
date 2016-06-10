@extends('layouts.master')

@section('header.title')
  Edit {!! $image->image_title !!}
@endsection

@section('body.content')
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span>Edit {!! $image->image_title !!}</span>
            </div><!-- End panel-heading -->
            <div class="panel-body">
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
              {!! Form::open(['route' => ['photo.update', $image->id],'files' => true, 'method' => 'PUT']) !!}
                <div class="form-group">
                  {!! Form::label('image_caption', 'Write something...') !!}
                  {!! Form::textarea('image_caption', $image->image_caption, ['class' => 'input-form-primary', 'id' => 'image_caption']) !!}
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('image', 'Choose an image to replace') !!}
                      {!! Form::file('image', ['id' => 'image', 'class' => '']) !!}
                      <div id="file-result" class="text-success" style="padding: 10px 5px"></div>
                    </div>
                    <div class="col-md-6">
                      <img src="{!! asset($image->fullsize_url) !!}" class="thumbnail" id="preview-thumbnail" style="max-width: 100%" alt="Image preview..."/>
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
                  {!! Form::button('<span class="glyphicon glyphicon-cloud-upload"></span> Upload', ['class' => 'btn btn-main', 'type' => 'submit']) !!}
                  {!! Form::button('<span class="glyphicon glyphicon-refresh"></span> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
                </div>
              {!! Form::close() !!}
            </div><!-- End panel-body -->
          </div><!-- End panel-default -->
        </div><!-- End col-md-12 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
  <script type="text/javascript">
  function changeImage(){
    var reader = new FileReader();
    var image = document.getElementById('image').files[0];
    var preview = document.getElementById('preview-thumbnail');
    var name = image.name;
    var size = image.size;
    var type = image.type;
    reader.onload = function(){
      preview.src = reader.result;
    }
    if(image) {
      reader.readAsDataURL(image);
    }else{
      preview.src = "";
    }
    document.getElementById('file-result').innerHTML = '<div class="panel panel-default">'
    +'<div class="panel-heading">File detail</div>'
    +'<div class="panel-body">'
    +'<p><b>File name:</b> '+name+'</p>'
    +'<p><b>File size:</b> '+Math.floor(size/1024)+' <b>Kb</b></p>'+'<p><b>File type:</b> '+type+'</p></div></div>';
  }
  document.getElementById('image').addEventListener('change', changeImage, false);
  </script>
@endsection
