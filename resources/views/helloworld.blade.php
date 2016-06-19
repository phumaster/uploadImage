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
          <a href="#" class="join-now" data-toggle="modal" data-target="#popUpAuthentication">Join now</a>
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
                        {!! Form::email('email', '', ['class' => 'input-form-primary', 'id' => 'email', 'placeholder' => 'Email', 'autocomplete' => 'off']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::password('password', ['class' => 'input-form-primary', 'id' => 'password', 'placeholder' => 'Password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::button('<span class="glyphicon glyphicon-check"></span> Login', ['class' => 'btn btn-main btn-login btn-sm', 'type' => 'submit']) !!}
                      </div>
                    {!! Form::close() !!}
                  </div>
                  <div id="register" class="tab-pane fade">
                    <br/>
                    {!! Form::open(['route' => 'register', 'method' => 'POST', 'id' => 'formRegister']) !!}
                      <div class="form-group">
                        {!! Form::text('name', '' , ['class' => 'input-form-primary', 'placeholder' => 'Your name', 'autocomplete' => 'off']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::email('email', '', ['class' => 'input-form-primary', 'placeholder' => 'Email', 'autocomplete' => 'off']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::password('password', ['class' => 'input-form-primary', 'placeholder' => 'Password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::password('confPassword', ['class' => 'input-form-primary', 'id' => 'confPassword', 'placeholder' => 'Re-type password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::button('<span class="glyphicon glyphicon-check"></span> Register', ['class' => 'btn btn-main btn-register btn-sm', 'type' => 'submit']) !!}
                      </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div><!-- .modal-body -->
              <div class="modal-footer" style="text-align: justify">
                <p>
                  Chào mừng đến với project thử nghiệm của <font color="blue">@Phú Master</font> | Xem thêm thông tin project tại <a href="{!! url('/founder') !!}" target="_blank">đây</a>
                </p>
              </div>
            </div><!-- end .modal-content -->
          </div>
        </div>
      </div><!-- end .col-sm-4 -->
    </div>
  </div><!-- end .container -->
</div><!-- end .header -->
@endsection

@section('body.content')
<div class="container-fuild body-content large-header" id="large-header">
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
  $(document).ready(function() {
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
            $('#response').append('<div class="text-info">'+data.message+'</div>');
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
            $('#response').append('<div class="text-info">'+val+'</div>');
          });
          $('.btn-register, .btn-login').removeAttr('disabled').removeClass('disabled');
        }
      });
    });
    $('#popUpAuthentication').on('shown.bs.modal', function () {
      $('#email').focus()
    });

    setTimeout(function() {
      $('.join-now').click();
    }, 1000);
  });
</script>
<script type="text/javascript">
(function() {

  var width, height, largeHeader, canvas, ctx, points, target, animateHeader = true;

  // Main
  initHeader();
  initAnimation();
  addListeners();

  function initHeader() {
      width = window.innerWidth;
      height = window.innerHeight;
      target = {x: width/2, y: height/2};

      largeHeader = document.getElementById('large-header');
      largeHeader.style.height = height+'px';

      canvas = document.getElementById('demo-canvas');
      canvas.width = width;
      canvas.height = height;
      ctx = canvas.getContext('2d');

      // create points
      points = [];
      for(var x = 0; x < width; x = x + width/20) {
          for(var y = 0; y < height; y = y + height/20) {
              var px = x + Math.random()*width/20;
              var py = y + Math.random()*height/20;
              var p = {x: px, originX: px, y: py, originY: py };
              points.push(p);
          }
      }

      // for each point find the 5 closest points
      for(var i = 0; i < points.length; i++) {
          var closest = [];
          var p1 = points[i];
          for(var j = 0; j < points.length; j++) {
              var p2 = points[j]
              if(!(p1 == p2)) {
                  var placed = false;
                  for(var k = 0; k < 5; k++) {
                      if(!placed) {
                          if(closest[k] == undefined) {
                              closest[k] = p2;
                              placed = true;
                          }
                      }
                  }

                  for(var k = 0; k < 5; k++) {
                      if(!placed) {
                          if(getDistance(p1, p2) < getDistance(p1, closest[k])) {
                              closest[k] = p2;
                              placed = true;
                          }
                      }
                  }
              }
          }
          p1.closest = closest;
      }

      // assign a circle to each point
      for(var i in points) {
          var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
          points[i].circle = c;
      }
  }

  // Event handling
  function addListeners() {
      if(!('ontouchstart' in window)) {
          window.addEventListener('mousemove', mouseMove);
      }
      window.addEventListener('scroll', scrollCheck);
      window.addEventListener('resize', resize);
  }

  function mouseMove(e) {
      var posx = posy = 0;
      if (e.pageX || e.pageY) {
          posx = e.pageX;
          posy = e.pageY;
      }
      else if (e.clientX || e.clientY)    {
          posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
          posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
      }
      target.x = posx;
      target.y = posy;
  }

  function scrollCheck() {
      if(document.body.scrollTop > height) animateHeader = false;
      else animateHeader = true;
  }

  function resize() {
      width = window.innerWidth;
      height = window.innerHeight;
      largeHeader.style.height = height+'px';
      canvas.width = width;
      canvas.height = height;
  }

  // animation
  function initAnimation() {
      animate();
      for(var i in points) {
          shiftPoint(points[i]);
      }
  }

  function animate() {
      if(animateHeader) {
          ctx.clearRect(0,0,width,height);
          for(var i in points) {
              // detect points in range
              if(Math.abs(getDistance(target, points[i])) < 4000) {
                  points[i].active = 0.3;
                  points[i].circle.active = 0.6;
              } else if(Math.abs(getDistance(target, points[i])) < 20000) {
                  points[i].active = 0.1;
                  points[i].circle.active = 0.3;
              } else if(Math.abs(getDistance(target, points[i])) < 40000) {
                  points[i].active = 0.02;
                  points[i].circle.active = 0.1;
              } else {
                  points[i].active = 0;
                  points[i].circle.active = 0;
              }

              drawLines(points[i]);
              points[i].circle.draw();
          }
      }
      requestAnimationFrame(animate);
  }

  function shiftPoint(p) {
      TweenLite.to(p, 1+1*Math.random(), {x:p.originX-50+Math.random()*100,
          y: p.originY-50+Math.random()*100, ease:Circ.easeInOut,
          onComplete: function() {
              shiftPoint(p);
          }});
  }

  // Canvas manipulation
  function drawLines(p) {
      if(!p.active) return;
      for(var i in p.closest) {
          ctx.beginPath();
          ctx.moveTo(p.x, p.y);
          ctx.lineTo(p.closest[i].x, p.closest[i].y);
          ctx.strokeStyle = 'rgba(156,217,249,'+ p.active+')';
          ctx.stroke();
      }
  }

  function Circle(pos,rad,color) {
      var _this = this;

      // constructor
      (function() {
          _this.pos = pos || null;
          _this.radius = rad || null;
          _this.color = color || null;
      })();

      this.draw = function() {
          if(!_this.active) return;
          ctx.beginPath();
          ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
          ctx.fillStyle = 'rgba(156,217,249,'+ _this.active+')';
          ctx.fill();
      };
  }

  // Util
  function getDistance(p1, p2) {
      return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
  }

})();
</script>
@endsection
