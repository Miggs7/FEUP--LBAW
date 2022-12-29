@extends('layouts.app')

@push('pageJS')
<script src={{ asset('js/login.js') }} defer> </script>
@endpush

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
    <a href="#" data-bs-toggle="modal" data-bs-target="#modal">Forgot Password?</a>

    <div class="d-flex justify-content-center align-items-center container my-2">
      <button type="submit" class="btn btn-primary mx-2">Login</button>
      <a href="{{route('register')}}">
      <button type="button" class="btn btn-primary">Register</button>
      </a>
    </div>
  </form>
    <span id="passwordReseted" class="text-danger">Password has been reset!</span>
    </div>
  </div>
</div>



<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
        <button type="button" class="btn-close close mx-0 my-0" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="resetForm" method="POST" action="{{route("password.email")}}">
        @csrf
        <div class="modal-body">
          <div class="form-group mb-2">
            <label for="email">E-mail</label>
          <input id="email" type="email" name="email" id="email" class="form-control" required>
          @if ($errors->has('email'))
            <span class="error text-danger">
                {{ $errors->first('email') }}
            </span>
          @endif
          </div>
      
          <div class="modal-footer justify-content-center align-items-center">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
