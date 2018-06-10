@extends('layouts.app')

@section('content')
  <div id="vault" class="container py-4">
    <div class="row">
      <div class="offset-md-4 col-md-4 text-center">
        <h1>My keys</h1>
      </div>
      <div class="col-md-4 text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#mdl-new-account">Add</a>
      </div>
    </div>

    @if ($errors->any())
      <div class="row justify-content-center text-center">
        <div class="col-md-8">
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        </div>
      </div>
    @endif

    <div class="row justify-content-start">
      @if(!$accounts->isEmpty())
        @foreach ($accounts as $account)
          <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ $account->name }}</h5>
                  <a class="card-text" href="{{ $account->url }}">{{  $account->url}}</a>
                  <span class="account-id">{{ $account->id }}</span>
                </div>
              </div>
          </div>
        @endforeach
      @else
        <span>No accounts yet !</span>
      @endif
    </div>
  </div>
@endsection


@section('modal')
  <div id="mdl-new-account" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['url'=>'account/add']) !!}
            <div class="form-group">
              {!! Form::label('labelSite', 'Site name') !!}
              {!! Form::text('name',null , ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('labelUrl', 'Url') !!}
              {!! Form::text('url', null , ['class'=>'form-control'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('labelUsername', 'Username') !!}
              {!! Form::text('username', null , ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('labelPassword', 'Password') !!}
              {!! Form::password('password' , ['id'=>'input-password','class'=>'form-control']) !!}
            </div>
            {!! Form::button('Generate Password', ['id'=>'generate-password', 'class'=>'btn btn-secondary']) !!}
            {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/vault.js') }}"></script>
@endsection