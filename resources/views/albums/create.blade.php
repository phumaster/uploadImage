@extends('layouts.master')

@section('header.title')
  Create a new album
@endsection

@section('body.content')
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span>Create a new album</span>
            </div><!-- End panel-heading -->
            <div class="panel-body">
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
              @include('includes.form-create-album')
            </div><!-- End panel-body -->
          </div><!-- End panel-default -->
        </div><!-- End col-md-12 -->
      </div><!-- End row -->
    </div><!-- End container -->
  </div><!-- End #content -->
@endsection
