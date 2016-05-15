@extends('layouts.non-authorize')

@section('header.title')
Welcome
@endsection

@section('header')
<div class="container-fuild header-non-authorize">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <div class="logo-header">
          <div class="pull-left"><a href="{!! url('/') !!}">
            <img src="{!! asset('images/logo.png') !!}" alt="logo" width="40px" class="logo"/>
          </a></div>
        </div>
      </div><!-- end .col-sm-8 -->
      <div class="col-sm-4">
        <div class="pull-right">
          <a href="#" class="join-now" data-toggle="modal" data-target="#popUpAuthentication"><i class="fa fa-fw fa-sign-in"></i> join now</a>
        </div>
        <!-- popup -->
        <div class="modal fade" id="popUpAuthentication"  role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Join with us</h4>
              </div><!-- .modal-header -->
              <div class="modal-body">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#login" class="tabLoginLink">Login</a></li>
                  <li><a data-toggle="tab" href="#register">Create my account</a></li>
                </ul>
                <div class="tab-content">
                  <div id="response"></div>
                  <div id="login" class="tab-pane fade in active">
                    <br/>
                    {!! Form::open(['route' => 'login', 'method' => 'POST', 'id' => 'formLogin']) !!}
                      <div class="form-group">
                        {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::button('<i class="fa fa-unlock"></i> Login', ['class' => 'btn btn-primary btn-login btn-sm', 'type' => 'submit']) !!}
                      </div>
                    {!! Form::close() !!}
                  </div>
                  <div id="register" class="tab-pane fade">
                    <br/>
                    {!! Form::open(['route' => 'register', 'method' => 'POST', 'id' => 'formRegister']) !!}
                      <div class="form-group">
                        {!! Form::text('name', '' , ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Your name']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::password('confPassword', ['class' => 'form-control', 'id' => 'confPassword', 'placeholder' => 'Re-type password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::button('<i class="fa fa-check"></i> Register', ['class' => 'btn btn-primary btn-register btn-sm', 'type' => 'submit']) !!}
                        {!! Form::button('<i class="fa fa-refresh"></i> Reset', ['class' => 'btn btn-default btn-sm', 'type' => 'reset']) !!}
                      </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div><!-- .modal-body -->
            </div><!-- end .modal-content -->
          </div>
        </div>
      </div><!-- end .col-sm-4 -->
    </div>
  </div><!-- end .container -->
</div><!-- end .header -->
@endsection

@section('body.content')
<div class="container-fuild body-content">
  <ul class="slide">
    <div class="slide-content">
      <li class="item-slide-content"></li>
      <li class="item-slide-content"></li>
      <li class="item-slide-content"></li>
      <li class="item-slide-content"></li>
      <li class="item-slide-content"></li>
      <li class="item-slide-content"></li>
    </div>
  </ul>
  <div class="clear-fix"></div>
</div>
@endsection

@section('footer')
<div>f</div>
@endsection

@section('js')
<script type="text/javascript">
  $('.slide-content').height(window.innerHeight);
  $('.body-content').css({'min-height':window.innerHeight});
  var li = $('.slide-content li');
  $('.slide-content').css({
    '-moz-transform':'translateX(0px)',
    '-webkit-transform':'translateX(0px)',
    'transform':'translateX(0px)'
  });
  li.width(window.innerWidth).height(window.innerHeight);
  $.each(li, function(i){
    var translate = window.innerWidth*i;
    $(this).addClass('bg-item-slide-content'+i).css({
      '-moz-transform':'translateX('+translate+'px)',
      '-webkit-transform':'translateX('+translate+'px)',
      'transform':'translateX('+translate+'px)'
    });
  });
  var i = 1;
  var bool = true;
  setInterval(function(){
    var translate = -window.innerWidth*i;
    $('.slide-content').css({
      '-moz-transform':'translateX('+translate+'px)',
      '-webkit-transform':'translateX('+translate+'px)',
      'transform':'translateX('+translate+'px)'
    });
    if(i >= li.length - 1) {
      i = li.length - 1;
      bool = false;
      i--;
    }else if(i == 0){
      bool = true;
      i++;
    }else{
      if(bool) {
        i++;
      }else{
        i--;
      }
    }
  }, 3000);

  $('#formRegister, #formLogin').submit(function(event){
    event.preventDefault();
    $('.btn-register, .btn-login').attr('disabled', 'disabled').addClass('disabled');
    $.ajax({
      url: $(this).attr('action')+'?p='+Math.floor(Math.random()*100),
      method: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(response) {
        $('#response').html("");
        var data = JSON.parse(response);
        if(data.error === 1) {
          $('#response').append('<div class="text-danger">'+data.message+'</div>');
        }else{
          if(typeof data.message == "undefined") {
            window.location.reload();
          }else{
            if(typeof data.forceLogin != "undefined" && data.forceLogin === 1) {
              $('.tabLoginLink').click();
            }
            $('#response').append('<div class="text-success">'+data.message+'</div>');
          }
        }
        $('.btn-register, .btn-login').removeAttr('disabled').removeClass('disabled');
      },
      error: function(response) {
        $('#response').html("");
        $.each(response.responseJSON, function(i, val){
          $('#response').append('<div class="text-danger">'+val+'</div>');
        });
        $('.btn-register, .btn-login').removeAttr('disabled').removeClass('disabled');
      }
    });
  });
</script>
@endsection
