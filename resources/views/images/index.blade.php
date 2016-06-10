<div class="container">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">All photos</div>
        <div class="panel-body">
          @if(Session::has('message'))
            <div class="alert alert-success">
              {!! Session::get('message') !!}
            </div>
          @endif
          @if(count($errors) > 0)
            <div class="alert alert-danger">
              <b>:( Opps!</b>
              <ul>
                @foreach($errors->all() as $error)
                  <li>{!! $error !!}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if(count($images) > 0)
          <div class="list-image-all">
            @foreach($images as $image)
              <a href="{!! route('photo.show', [$image->user_id, $image->id]) !!}">
                <div class="image-grid" style="position: relative">
                  <div class="pull-right"  style="position: absolute; top: 0; right: 0">
                    {!! Form::open(['route' => ['photo.destroy',$image->user_id, $image->id], 'method' => 'DELETE']) !!}
                      {!! Form::button('xóa', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                  </div>
                  <img src="{!! asset($image->fullsize_url) !!}">
                </div>
              </a>
            @endforeach
          </div><!-- End list-image -->
          @else
            <div class="text-center text-info">
              No photos to show
            </div>
          @endif
        </div>
      </div>
    </div><!-- End col-md-10 -->
  </div><!-- End row -->
</div><!-- End container -->
