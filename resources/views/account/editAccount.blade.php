@extends('layouts.app')

@section('content')

  <div class="container py-4">
    <h1>Edition of {{ $account->name }}'s account</h1>
    {!! Form::model($account, ['route'=> array('account.update', $account->id)]) !!}
      <div class="form-group">
        {!! Form::label('labelSite', 'Site name') !!}
        {!! Form::text('name', null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('labelUrl', 'Url') !!}
        {!! Form::text('url', null,['class'=>'form-control'] ) !!}
      </div>
      <div class="form-group">
        {!! Form::label('labelUsername', 'Username') !!}
        {!! Form::text('username', null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('labelPassword', 'Password') !!}
        {!! Form::text('password', null, ['id'=>'input-password','class'=>'form-control']) !!}
      </div>
      {!! Form::button('Generate Password', ['id'=>'generate-password', 'class'=>'btn btn-secondary']) !!}
      {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>

@endsection


@section('script')
  <script type="text/javascript" src="{{ asset('js/vault.js') }}"></script>
@endsection
