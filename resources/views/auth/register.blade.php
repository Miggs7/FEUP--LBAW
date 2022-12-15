@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center container my-5 ">
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    
    <div class="form-group mb-2">
      <label for="exampleInputEmail1">Name</label>
    <input id="name" type="text" name="name" id="exampleInputEmail1" class="form-control"  value="{{ old('name') }}" required autofocus>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
      <label for="exampleInputEmail1">E-Mail Address</label>
    <input id="email" type="email" name="email" id="exampleInputEmail1" class="form-control"  value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
      <label for="exampleInputEmail1">Age: </label>
    <input id="age" type="number" name="age" id="exampleInputEmail1" class="form-control"  value="{{ old('age') }}" required>
    @if ($errors->has('age'))
      <span class="error">
          {{ $errors->first('age') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
    <label for="exampleInputEmail1">Username</label>
    <input id="username" type="text" name="username" class="form-control"  id="exampleInputEmail1" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
      <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-2">
      <label for="exampleInputEmail1">Password</label>
    <input id="password" type="password" id="exampleInputEmail1" class="form-control"  name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif
    </div>

    <div class="form-group mb-3">
      <label for="exampleInputEmail1">Confirm Password</label>
    <input id="password-confirm" type="password" id="exampleInputEmail1" class="form-control"  name="password_confirmation" required>
    </div>

    <button class="btn btn-primary" type="submit">
      Register
    </button>
    
    <a href="{{route('login')}}">
      <button type="button" class="btn btn-primary">Login</button>
    <a>
  
</form>
</div>
@endsection
