@extends('layouts.master')

@section('header.title')
News feed
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
      method:'GET',
      url: '{!! route('index') !!}',
      cache:false,
      success: function(response) {
        $('#content').html(response);
      }
    });
  });
</script>
@endsection
