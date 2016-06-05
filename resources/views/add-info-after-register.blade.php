@extends('layouts.master')

@section('header.title')
Add your info
@endsection

@section('body.content')
<div class="container fix-margin">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="card">
        <h4 class="text-indent">
          <span>Hi </span>
          <span><strong class="text-info">{!! \Auth::user()->name !!}</strong>, welcome to my site</span>
        </h4>
        <hr/>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors as $error)
            <li>{!! $error !!}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <p>Please, let's choose information about you in box below to find your friends easier! Thanks</p>
        <div class="form-add-info">
          {!! Form::open(['route' => ['add-info', \Auth::user()->id], 'method' => 'POST']) !!}
            <div class="form-group">
              {!! Form::label('sex', 'You are?') !!}
              <select name="sex" class="form-control" id="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('address', 'Where are you from?') !!}
              <select name="address" id="address" class="form-control">
                <option value="Hà Nội (TP)">Hà Nội (TP)</option>
                <option value="An Giang">An Giang</option>
                <option value="Bà Rịa-Vũng Tàu">Bà Rịa-Vũng Tàu</option>
                <option value="Bạc Liêu">Bạc Liêu</option>
                <option value="Bắc Kạn">Bắc Kạn</option>
                <option value="Bắc Giang">Bắc Giang</option>
                <option value="Bắc Ninh">Bắc Ninh</option>
                <option value="Bến Tre">Bến Tre</option>
                <option value="Bình Dương">Bình Dương</option>
                <option value="Bình Định">Bình Định</option>
                <option value="Bình Phước">Bình Phước</option>
                <option value="Bình Thuận">Bình Thuận</option>
                <option value="Cà Mau">Cà Mau</option>
                <option value="Cao Bằng">Cao Bằng</option>
                <option value="Cần Thơ (TP)">Cần Thơ (TP)</option>
                <option value="Đà Nẵng (TP)">Đà Nẵng (TP)</option>
                <option value="Đắk Lắk">Đắk Lắk</option>
                <option value="Đắk Nông">Đắk Nông</option>
                <option value="Điện Biên">Điện Biên</option>
                <option value="Đồng Nai">Đồng Nai</option>
                <option value="Đồng Tháp">Đồng Tháp</option>
                <option value="Gia Lai">Gia Lai</option>
                <option value="Hà Giang">Hà Giang</option>
                <option value="Hà Nam">Hà Nam</option>
                <option value="Hà Tây">Hà Tây</option>
                <option value="Hà Tĩnh">Hà Tĩnh</option>
                <option value="Hải Dương">Hải Dương</option>
                <option value="Hải Phòng (TP)">Hải Phòng (TP)</option>
                <option value="Hòa Bình">Hòa Bình</option>
                <option value="Hồ Chí Minh (TP)">Hồ Chí Minh (TP)</option>
                <option value="Hậu Giang">Hậu Giang</option>
                <option value="Hưng Yên">Hưng Yên</option>
                <option value="Khánh Hòa">Khánh Hòa</option>
                <option value="Kiên Giang">Kiên Giang</option>
                <option value="Kon Tum">Kon Tum</option>
                <option value="Lai Châu">Lai Châu</option>
                <option value="Lào Cai">Lào Cai</option>
                <option value="Lạng Sơn">Lạng Sơn</option>
                <option value="Lâm Đồng">Lâm Đồng</option>
                <option value="Long An">Long An</option>
                <option value="Nam Định">Nam Định</option>
                <option value="Nghệ An">Nghệ An</option>
                <option value="Ninh Bình">Ninh Bình</option>
                <option value="Ninh Thuận">Ninh Thuận</option>
                <option value="Phú Thọ">Phú Thọ</option>
                <option value="Phú Yên">Phú Yên</option>
                <option value="Quảng Bình">Quảng Bình</option>
                <option value="Quảng Nam">Quảng Nam</option>
                <option value="Quảng Ngãi">Quảng Ngãi</option>
                <option value="Quảng Ninh">Quảng Ninh</option>
                <option value="Quảng Trị">Quảng Trị</option>
                <option value="Sóc Trăng">Sóc Trăng</option>
                <option value="Sơn La">Sơn La</option>
                <option value="Tây Ninh">Tây Ninh</option>
                <option value="Thái Bình">Thái Bình</option>
                <option value="Thái Nguyên">Thái Nguyên</option>
                <option value="Thanh Hóa">Thanh Hóa</option>
                <option value="Thừa Thiên - Huế">Thừa Thiên - Huế</option>
                <option value="Tiền Giang">Tiền Giang</option>
                <option value="Trà Vinh">Trà Vinh</option>
                <option value="Tuyên Quang">Tuyên Quang</option>
                <option value="Vĩnh Long">Vĩnh Long</option>
                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                <option value="Yên Bái">Yên Bái</option>
              </select>
            </div>
            <div class="form-group">
              {!! Form::button('<span class="glyphicon glyphicon-ok"></span> update my information', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary']) !!}
              <a class="btn btn-sm btn-main" href="{!! route('index',['skip' => 'yes']) !!}"><span class="glyphicon glyphicon-remove"></span> Skip this step</a>
            </div>
          {!! Form::close() !!}
        </div><!-- end .form-add-info -->
      </div>
    </div><!-- end .col-sm-8 -->
  </div><!-- end .row -->
</div>
@endsection
