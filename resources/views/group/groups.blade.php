@extends('layouts.app')

@section('content')
  <div id="groups" class="container py-4">

    <div class="row">
      <div class="offset-md-4 col-md-4 text-center">
        <h1>My groups</h1>
      </div>
      <div class="col-md-4 text-right">
        <div class="btn-group">
          <button class="btn btn-primary" data-toggle="modal" data-target="#mdl-new-group">Add group</a>
          <button class="btn btn-secondary" data-toggle="modal" data-target="#mdl-share-group">Share group</a>
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

    <div class="row justify-content-center py-4">
      <div class="col-md-8">
        <div class="list-group">
          @if(!$groups->isEmpty())
            @foreach ($groups as $group)
              <div class="list-group-item list-group-item-action">
                {{ $group->name }}
                <button type="button" class="close" data-toggle="modal" data-target="#mdl-delete-group">
                  <span aria-hidden="true">&times;</span>
                </button>
                <span class="hidden-content">{{ $group->id }}</span>
              </div>
            @endforeach
          @else
            <span>No groups yet !</span>
          @endif
        </div>
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
              {!! Form::text('name',null , ['class'=>'form-control']) !!}
            </div>
            {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
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
          {!! Form::open(['url'=>'account/share']) !!}
          @if($groups != null)
            <div class="container py-4">
              <div class="row">
                {!! Form::text('search',null, ['class'=>'form-control', 'id'=>'search_user', 'placeholder'=>'Search User...']) !!}
              </div>
              <div class="row">
                <div id="search_result" class="hidden-content"></div>
                <div class="cssload-loader-inner hidden-content">
                  <div class="cssload-cssload-loader-line-wrap-wrap">
                    <div class="cssload-loader-line-wrap"></div>
                  </div>
                  <div class="cssload-cssload-loader-line-wrap-wrap">
                    <div class="cssload-loader-line-wrap"></div>
                  </div>
                  <div class="cssload-cssload-loader-line-wrap-wrap">
                    <div class="cssload-loader-line-wrap"></div>
                  </div>
                  <div class="cssload-cssload-loader-line-wrap-wrap">
                    <div class="cssload-loader-line-wrap"></div>
                  </div>
                  <div class="cssload-cssload-loader-line-wrap-wrap">
                    <div class="cssload-loader-line-wrap"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                @foreach ($groups as $group)
                  {!! Form::checkbox('groups[' . $group->id . ']', trim(strtolower($group->name))) !!}
                  {!! Form::label(trim(strtolower($group->name)), $group->name) !!}
                @endforeach
              </div>
            </div>
          @else
            <span>No groups to share !</span>
          @endif
          {!! Form::button('Cancel', ['class'=>'btn btn-secondary', 'data-dismiss'=>'modal']) !!}
          {!! Form::submit('Share', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/groups.js') }}"></script>
@endsection
