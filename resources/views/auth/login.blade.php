@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center my-5">
  <div class="card h-100">
    <div class="card-body">
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      @if ($errors->has('email'))
      <span class="error text-danger">
        {{ $errors->first('email') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      @if ($errors->has('password'))
      <span class="error text-danger">
          {{ $errors->first('password') }}
      </span>
      @endif
    </div>

    <div class="d-flex justify-content-center align-items-center container my-2">
      <button type="submit" class="btn btn-primary mx-2">Login</button>
      <a href="{{route('register')}}">
      <button type="button" class="btn btn-primary">Register</button>
      <a>
    </div>
  </form>
    </div>
  </div>
</div>
@endsection
