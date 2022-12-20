@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center container my-5 ">
  <div class="card h-100">
    <div class="card-body">
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    
    <div class="form-group mb-2">
      <label for="name">Name</label>
    <input id="name" type="text" name="name" class="form-control" pattern="^[A-Za-z \s*]+$"  value="{{ old('name') }}" required autofocus>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
      <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" class="form-control"  value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
      <label for="age" class="age">Age: </label>
    <input id="age" type="number" name="age" class="form-control" min="17"  value="{{ old('age') }}" required>
    @if ($errors->has('age'))
      <span class="error">
          {{ $errors->first('age') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
    <label for="username" class="username">Username</label>
    <input id="username" type="text" name="username" class="form-control"  pattern="[^' ']+" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
      <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
      <label for="password" class="password">Password</label>
    <input id="password" type="password" class="form-control"  name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-3">
      <label for="password-confirm">Confirm Password</label>
    <input type="password" id="password-confirm" class="form-control"  name="password_confirmation" required>
    </div>
    
    <div class="d-flex justify-content-center align-items-center container">
      <a href="{{route('login')}}">
        <button type="button" class="btn btn-primary">Login</button>
      <a>
      <button class="btn btn-primary mx-2" type="submit">
          Register
      </button>
    </div>
  
</form>
    </div>
  </div>
</div>
@endsection
