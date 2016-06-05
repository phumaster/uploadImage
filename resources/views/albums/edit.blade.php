@extends('layouts.master')

@section('header.title')
  Edit album {!! $album->album_name !!}
@endsection

@section('body.content')
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-sm-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span>Edit album {!! $album->album_name !!}</span>
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
              {!! Form::open(['route' => ['album.update', $album->user_id, $album->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                  {!! Form::label('album_name', 'Name') !!}
                  {!! Form::text('album_name', $album->album_name, ['class' => 'form-control', 'id' => 'album_name']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('album_title', 'Title') !!}
                  {!! Form::text('album_title', $album->album_title, ['class' => 'form-control', 'id' => 'album_title']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('album_description', 'Description') !!}
                  {!! Form::textarea('album_description', $album->album_description, ['class' => 'form-control', 'id' => 'album_description']) !!}
                </div>
                <div class="form-group">
                  {!! Form::button('<span class="glyphicon glyphicon-plus"></span> Update', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                  {!! Form::button('<span class="glyphicon glyphicon-refresh"></span> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
                </div>
              {!! Form::close() !!}
            </div><!-- End panel-body -->
          </div><!-- End panel-default -->
        </div><!-- End col-md-12 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
@endsection
