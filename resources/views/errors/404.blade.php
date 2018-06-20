@extends('layouts.app')

@section('title')
Error 404
@endsection

@section('content')
  <div class="container py-4">
    <div class="row justify-content-center">
      <h1>404 – Page not found</h1>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row justify-content-center">
          <h2>⬐ This is everyone else ⬎</h2>
        </div>
        <div class="row justift-content-center">

        </div>
      </div>
      <div class="col-md-4">
        <div class="row py-4 justify-content-center">
          <img id="this-is-you" src="https://path.blue/wp-content/uploads/2017/09/404-offmap-short.png" style="width:250px;" alt="your position">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/404.js') }}"></script>
@endsection
