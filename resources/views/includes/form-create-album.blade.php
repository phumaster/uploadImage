{!! Form::open(['route' => ['album.store', \Auth::user()->id], 'method' => 'POST', 'class' => 'form-create-album']) !!}
  <div class="response"></div>
  <div class="form-group">
    {!! Form::label('album_name', 'Name') !!}
    {!! Form::text('album_name', '', ['class' => 'input-form-primary', 'id' => 'album_name']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('album_title', 'Title') !!}
    {!! Form::text('album_title', '', ['class' => 'input-form-primary', 'id' => 'album_title']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('album_description', 'Description') !!}
    {!! Form::textarea('album_description', '', ['class' => 'input-form-primary', 'id' => 'album_description']) !!}
  </div>
  <div class="form-group">
    {!! Form::button('<span class="glyphicon glyphicon-plus"></span> Create', ['class' => 'btn btn-main', 'type' => 'submit']) !!}
    {!! Form::button('<span class="glyphicon glyphicon-refresh"></span> Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
  </div>
{!! Form::close() !!}
