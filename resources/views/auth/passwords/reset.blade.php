@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center my-5">
  <div class="card h-100">
    <div class="d-flex justify-content-center align-items-center my-2">
    <p>Reset Password</p>
    </div>
    <div class="card-body">
<form method="POST" action="{{ route('password.update') }}">
    {{ csrf_field() }}
    <input type="hidden" name="email" value="{{Request::get("email")}}" required>
    <input type="hidden" name="token" value="{{Request::route("token")}}"required>
    <div class="form-group mb-2">
        <label for="password" class="password">Password</label>
      <input id="password" type="password" class="form-control"  name="password" required>
      @if ($errors->has('password'))
        <span class="error text-danger">
            {{ $errors->first('password') }}
        </span>
      @endif
      </div>
  
      <div class="form-group mb-3">
        <label for="password-confirm">Confirm Password</label>
      <input type="password" id="password-confirm" class="form-control"  name="password_confirmation" required>
      </div>

    <div class="d-flex justify-content-center align-items-center container my-2">
      <button type="submit" class="btn btn-primary mx-2">Reset</button>
    </div>
  </form>
    </div>
  </div>
</div>
@endsection