@extends('layouts.app')

@section('content')
  <!-- Header -->
  <header class="masthead background-gradient">
    <div class="container">
      <h1>Make life easier</h1>
      <h2>IGotTheKeys remembers all your passwords for you.</h2>
    </div>
  </header>

  <div id="welcome" class="container">

    <div class="row justify-content-center text-center">
      <div class="col-md-8">
        <h2>The autopilot for all your passwords</h2>
        <p>IGotTheKeys removes obstacles so you can get back to what you love most.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Generate strong passwords</h5>
            <p class="card-text">The built-in password generator creates long, random passwords that protect you from hacking.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Share effortlessly</h5>
            <p class="card-text">Some information should not be sent by SMS. Share passwords conveniently and securely.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Ready for any eventuality</h5>
            <p class="card-text">Once you have registered a password in IGotTheKeys, it is always available.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
