@extends('layouts.master')

@section('header.title')
  {!! $image->image_title !!}
@endsection

@section('body.content')
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="text-center">
            <img src="{!! asset($image->image_url) !!}" alt="{!! $image->image_title !!}" class="thumbnail" style="width: 100%"/>
          </div>
        </div><!-- End col-md-12 -->
        <div class="col-md-4">
          {!! Form::open(['route' => ['image.destroy', $image->id], 'method' => 'DELETE']) !!}
            {!! Form::button('Delete', ['class' => 'btn btn-link', 'type' => 'submit']) !!}
          {!! Form::close() !!}
          {!! $image->image_title !!}
          <p>{!! $image->image_caption !!}</p>
          <h1>Comment</h1>
        </div><!-- End col-md-4 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
@endsection
