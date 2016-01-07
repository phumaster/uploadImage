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
      </div><!-- End col-md-12 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
