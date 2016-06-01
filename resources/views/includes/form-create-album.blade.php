{!! Form::open(['route' => ['album.store', \Auth::user()->id], 'method' => 'POST']) !!}
  <div class="form-group">
    {!! Form::label('album_name', 'Name') !!}
    {!! Form::text('album_name', '', ['class' => 'form-control', 'id' => 'album_name']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('album_title', 'Title') !!}
    {!! Form::text('album_title', '', ['class' => 'form-control', 'id' => 'album_title']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('album_description', 'Description') !!}
    {!! Form::textarea('album_description', '', ['class' => 'form-control', 'id' => 'album_description']) !!}
  </div>
  <div class="form-group">
    {!! Form::button('<i class="fa fa-plus"></i> Create', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
    {!! Form::button('<i class="fa fa-refresh"></i> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
  </div>
{!! Form::close() !!}
