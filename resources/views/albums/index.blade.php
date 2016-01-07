@extends('layouts.master')

@section('header.title')
  Album
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

          @if(count($albums) > 0)
            <div class="panel panel-default">
              <div class="panel-heading">All album from {!! $user !!}</div><!-- End panel-heading -->
              <div class="panel-body">
                @foreach($albums as $key => $album)
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <b>{!! $album['album_name'] !!}</b>
                      </div>
                      <div class="panel-body">
                        <p>{!! $album['album_title'] !!}</p>
                        <p>{!! $album['album_description'] !!}</p>
                      </div>
                      <div class="panel-footer">
                        Created: {!! $album['created_at'] !!}
                        {!! Form::open(['route' => ['album.destroy', $album['id']], 'method' => 'DELETE']) !!}
                          {!! Form::button('Xóa', ['class' => 'btn btn-link', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div><!-- End panel-body -->
            </div><!-- End panel-default -->
          @else
            <div class="text-danger">No album available!</div>
          @endif
        </div><!-- End col-md-12 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
@endsection
