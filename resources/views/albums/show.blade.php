@extends('layouts.master')

@section('header.title')
This is title
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
        @if(count($images) > 0)
          @foreach($images as $image)
            <img src="{{ asset($image->image_url) }}" class="thumbnail" width="25%" style="display: inline-block"/>
          @endforeach
        @else
          <div class="text-danger">No image to show on this album.</div>
        @endif
      </div><!-- End col-md-12 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
