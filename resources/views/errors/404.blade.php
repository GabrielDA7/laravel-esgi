@extends('layouts.app')

@section('title')
Error 404
@endsection

@section('content')
  <div class="container py-4">
    <div class="row justify-content-center">
      <h1 class="error404">404 – Page not found</h1>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row justify-content-center">
          <h2>⬐ People are there ⬎</h2>
        </div>
        <div class="row justify-content-center">
          <img id="this-is-you" src="{{asset('img/monde.png')}}" style="width:80%;" alt="your position">
        </div>
      </div>
      <div class="col-md-4">
        <div class="row py-4 justify-content-center">
          <img id="this-is-you" src="{{asset('img/thisIsYou.png')}}" style="width:250px;" alt="your position">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/404.js') }}"></script>
@endsection
