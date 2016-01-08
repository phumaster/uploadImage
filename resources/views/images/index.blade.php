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
        <pre>{!! print_r($images) !!}</pre>
      </div><!-- End col-md-12 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
