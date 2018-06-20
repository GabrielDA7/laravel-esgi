@extends('layouts.app')

@section('content')
  <div id="vault" class="container py-4">
    <div class="row">
      <div class="offset-md-4 col-md-4 text-center">
        <h1>{{$title}}</h1>
      </div>
      <div class="col-md-4 text-right">
        <div class="btn-group">
          <button class="btn btn-primary" data-toggle="modal" data-target="#mdl-{{$action}}-account">{{ ucfirst($action) }} account</a>
          @can('manage', $group)
            <button class="btn btn-secondary" data-toggle="modal" data-target="#mdl-share-group">Manage the group</button>
          @endcan
        </div>
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

      @if(!$accounts->isEmpty())
        <div class="row justify-content-start">
          @foreach ($accounts as $account)
            <div class="col-md-3">
                <div class="card">
                  <div class="card-header">
                    @can('delete', $account)
                      <button type="button" class="close" data-toggle="modal" data-target="#mdl-delete-account">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    @endcan
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">{{ $account->name }}</h5>
                    <a class="card-text" href="{{ $account->url }}">{{  $account->url}}</a>
                    <span class="hidden-content">{{ $account->id }}</span>
                  </div>
                </div>
              </div>
          @endforeach
        </div>
      @else
        <div class="row justify-content-center">
          <span>No accounts yet !</span>
        </div>
      @endif
  </div>
@endsection


@section('modal')
  <!-- Add account -->
  <div id="mdl-add-account" class="modal" tabindex="-1" role="dialog">
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
            <div class="form-group">
              {!! Form::button('Generate Password', ['id'=>'generate-password', 'class'=>'btn btn-secondary']) !!}
              {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Delete account -->
  <div id="mdl-delete-account" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this account ?</p>
          {!! Form::open(['url'=>'account']) !!}
          {!! Form::submit('Delete', ['class'=>'btn btn-primary form-control']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Share account -->
  <div id="mdl-share-account" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Share accounts</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            {!! Form::open(['url'=>'account/share']) !!}
            @if(!$userAccounts->isEmpty())
                <div class="row">
                  @foreach ($userAccounts as $userAccount)
                    {!! Form::checkbox('userAccounts[' . $userAccount->id . ']', trim(strtolower($userAccount->name))) !!}
                    {!! Form::label(trim(strtolower($userAccount->name)), $userAccount->name) !!}
                  @endforeach
                  {!! Form::hidden('group_id', $group->id) !!}
                </div>
            @else
              <div class="row justify-content-center">
                <span>No accounts to share !</span>
              </div>
            @endif
            {!! Form::submit('Share', ['class'=>'btn btn-primary form-control']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/vault.js') }}"></script>
@endsection
