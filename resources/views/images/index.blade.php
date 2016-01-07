@extends('layouts.master')

@section('header.title')
This is title
@endsection

@section('body.content')
{!! Form::open(['route' => ['image.destroy', 2], 'method' => 'DELETE']) !!}
  <button class="btn btn-link">Ok! execute????</button>
{!! Form::close() !!}
@endsection
