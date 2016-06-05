@extends('layouts.master')

@section('header.title')
Login
@endsection

@section('body.content')
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <span>Login</span>
          </div><!-- End panel-heading -->
          <div class="panel-body">
            @if(count($errors) > 0)
              <div class="alert alert-danger">
                <b>:( Opps!</b>
                <ul>
                  @foreach( $errors->all() as $error )
                    <li>{!! $error !!}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if(Session::has('message'))
              <div class="alert alert-success">
                {!! Session::get('message') !!}
              </div>
            @endif
            {!! Form::open(['route' => 'login', 'method' => 'POST']) !!}
              <div class="form-group">
                {!! Form::label('email', 'Email address') !!}
                {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
              </div>
              <div class="form-group">
                {!! Form::button('<span class="glyphicon glyphicon-check"></span> Login', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
              </div>
            {!! Form::close() !!}
          </div><!-- End panel-body -->
        </div><!-- End panel-primary -->
      </div><!-- End col-md-8 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
