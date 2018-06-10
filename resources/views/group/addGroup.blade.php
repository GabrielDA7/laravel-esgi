@extends('layout')

@section('content')
  <div class="title m-b-md">
      Read : Louis le noob<br><br>
  </div>

  <div>
    {!! Form::open(['url'=>'write']) !!}
      {!! Form::text('post_content') !!}
      {!! Form::submit('Write on the Wall') !!}
    {!! Form::close() !!}
  </div>

  <ul>
  </ul>

@endsection
