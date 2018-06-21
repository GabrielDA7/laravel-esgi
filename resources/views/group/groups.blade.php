@extends('layouts.app')

@section('content')
  <div id="groups" class="container py-4">
    @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              @foreach ($errors->all() as $error)
                <div class="row">
                  {{ $error }}
                </div>
              @endforeach
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
    @endif
    @if (Session::has('succes'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <div class="row">
                {{ Session::get('succes') }}
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
    @endif
    <div class="row">
      <div class="offset-md-4 col-md-4 text-center">
        <h1>My groups</h1>
      </div>
      <div class="col-md-4 text-right">
        <div class="btn-group">
          <button class="btn btn-primary" data-toggle="modal" data-target="#mdl-new-group">Add group</button>
          <button class="btn btn-secondary" data-toggle="modal" data-target="#mdl-share-group">Share group</button>
        </div>
      </div>
    </div>

    <div class="row justify-content-center py-4">
      <div class="col-md-8">
          @isset($groups)
            <div class="list-group">
              @foreach ($groups as $group)
                <div class="row list-group-item-clicked">
                  <div class="col-md-11 list-group-item-show">
                    {{ $group->name }}
                    <span class="author-group">by {{$group->users()->where('id', '=', $group->author)->first()->name}}</span>
                    <span class="hidden-content">{{ $group->id }}</span>
                  </div>
                  <div class="col-md-1">
                    <button id="delete-group" type="button" class="close" data-toggle="modal" data-target="#mdl-delete-group">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="row justify-content-center">
              <span>No groups yet !</span>
            </div>
          @endisset
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <!-- Add group -->
  <div id="mdl-new-group" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['url'=>'group/add']) !!}
            <div class="form-group">
              {!! Form::label('labelName', 'Name') !!}
              {!! Form::text('name',null , ['class'=>'form-control', 'autocomplete'=>'off']) !!}
            </div>
            {!! Form::submit('Add', ['class'=>'btn btn-primary form-control']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Delete group -->
  <div id="mdl-delete-group" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this group ?</p>
          {!! Form::open(['url'=>'group']) !!}
          {!! Form::button('Cancel', ['class'=>'btn btn-secondary', 'data-dismiss'=>'modal']) !!}
          {!! Form::submit('Delete', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Share group -->
  <div id="mdl-share-group" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Share group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['url'=>'group/share']) !!}
          <div class="container">
          @isset($groups)
              <div class="row">
                <div id="user_display" class="hidden-content"></div>
                {!! Form::hidden('user_added', "", ['id'=>'user_added']) !!}
              </div>
              <div class="row">
                {!! Form::text('search',null, ['class'=>'form-control', 'id'=>'search_user', 'placeholder'=>'Search User...', 'autocomplete'=>'off', 'disabled'=>true]) !!}
              </div>
              <div class="row">
                <div id="search_result" class="hidden-content"></div>
              </div>
              <div class="row padding-top">
                @foreach ($groups as $group)
                  {!! Form::checkbox('groups[' . $group->id . ']', trim(strtolower($group->name)),false, ['id'=>$group->id]) !!}
                  {!! Form::label(trim(strtolower($group->name)), $group->name) !!}
                @endforeach
              </div>
              <div class="row">
                {!! Form::submit('Share', ['class'=>'btn btn-primary form-control']) !!}
              </div>
          @else
            <div class="row justify-content-center">
              <span>No groups to share !</span>
            </div>
          @endisset
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/groups.js') }}"></script>
@endsection
