@extends('layouts.master')

@section('header.title')
Register
@endsection

@section('body.content')
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <span>Register</span>
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
            {!! Form::open(['route' => 'register', 'method' => 'POST']) !!}
              <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', '' , ['class' => 'input-form-primary', 'id' => 'name']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('email', 'Email address') !!}
                {!! Form::email('email', '', ['class' => 'input-form-primary', 'id' => 'email']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'input-form-primary', 'id' => 'password']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('confPassword', 'Confirm password') !!}
                {!! Form::password('confPassword', ['class' => 'input-form-primary', 'id' => 'confPassword']) !!}
              </div>
              <div class="form-group">
                {!! Form::button('<span class="glyphicon glyphicon-check"></span> Register', ['class' => 'btn btn-main', 'type' => 'submit']) !!}
                {!! Form::button('<span class="glyphicon glyphicon-refresh"></span> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
              </div>
            {!! Form::close() !!}
          </div><!-- End panel-body -->
        </div><!-- End panel-primary -->
      </div><!-- End col-md-8 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
