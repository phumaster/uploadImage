@extends('layouts.master')

@section('header.title')
  Upload an image!
@endsection

@section('body.content')
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span>Upload an image</span>
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
              {!! Form::open(['route' => ['photo.store', \Auth::user()->id],'files' => true, 'method' => 'POST', 'class' => 'form-upload-photo']) !!}
                <div class="response"></div>
                <div class="form-group">
                  {!! Form::label('image_caption', 'Write something...') !!}
                  {!! Form::textarea('image_caption', '', ['class' => 'input-form-primary', 'id' => 'image_caption']) !!}
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('image', 'Choose an photo') !!}
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
            </div><!-- End panel-body -->
          </div><!-- End panel-default -->
        </div><!-- End col-md-6 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
  <script type="text/javascript">
  function changeImage(){
    var reader = new FileReader();
    var image = document.getElementById('image').files[0];
    var preview = document.getElementById('preview-thumbnail');
    reader.onload = function(){
      preview.src = reader.result;
    }
    if(image) {
      reader.readAsDataURL(image);
      preview.setAttribute('class', 'thumbnail');
    }else{
      preview.src = "";
    }
  }
  document.getElementById('image').addEventListener('change', changeImage, false);
  </script>
@endsection
