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
                <b><i class="fa fa-frown-o"></i> Opps!</b>
                <ul>
                  @foreach( $errors->all() as $error )
                    <li>{!! $error !!}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            {!! Form::open(['route' => 'register', 'method' => 'POST']) !!}
              <div class="form-group">
                {!! Form::label('firstName', 'First name') !!}
                {!! Form::text('firstName', '' , ['class' => 'form-control', 'id' => 'firstName']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('lastName', 'Last name') !!}
                {!! Form::text('lastName', '', ['class' => 'form-control', 'id' => 'lastName']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('email', 'Email address') !!}
                {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('confPassword', 'Confirm password') !!}
                {!! Form::password('confPassword', ['class' => 'form-control', 'id' => 'confPassword']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('sex', 'Sex') !!}
                {!!
                  Form::select('sex', [
                    'male' => 'Male',
                    'female' => 'Female',
                    'gay' => 'Gay',
                    'lesbian' => 'Lesbian',
                    'bisexual' => 'Bisexual'
                  ], null, ['class' => 'form-control', 'title' => 'Select your sex...'])
                !!}
              </div>
              <div class="form-group">
                {!! Form::label('birthday', 'Birthday') !!}
                {!! Form::text('birthday', '', ['class' => 'form-control', 'id' => 'birthday']) !!}
              </div>
              <div class="form-group">
                {!! Form::button('<i class="fa fa-check"></i> Register', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                {!! Form::button('<i class="fa fa-refresh"></i> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
              </div>
            {!! Form::close() !!}
          </div><!-- End panel-body -->
        </div><!-- End panel-primary -->
      </div><!-- End col-md-8 -->
    </div><!-- End row -->
  </div><!-- End container -->
</div><!-- End #content -->
@endsection
