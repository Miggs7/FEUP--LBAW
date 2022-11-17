@extends('layouts.app')

{{-- Only logged users should see profiles --}}
@if (!Auth::user())
    @php die(header('Location: /'));
    echo 'This is not your profile!'
    @endphp
@endif

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $user = App\Http\Controllers\UserController::getUserById($id);
@endphp

@section('content')
    <section id="user-profile">
    <p>This is the {{ $user['name']}}'s Profile Page</p>
    <p>Username: {{ $user['username']}} </p>
    <p>E-mail: {{ $user['email']}} </p>
        {{-- display a form to edit if user in it's own profile --}}
        @if (Auth::user()->id == $user['id'])
            <section id="edit_profile_container">
                <form method="POST" action={{route('edit')}}>
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value={{$id}} >
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                      <span class="error">
                          {{ $errors->first('name') }}
                      </span>
                    @endif
                    
                    {{--
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                      <span class="error">
                          {{ $errors->first('email') }}
                      </span>
                    @endif
                
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}">
                    @if ($errors->has('name'))
                      <span class="error">
                          {{ $errors->first('name') }}
                      </span>
                    @endif
                    --}}
                    {{-- don't forget to hash passwords in the function of edit user --}}
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password">
                    @if ($errors->has('password'))
                      <span class="error">
                          {{ $errors->first('password') }}
                      </span>
                    @endif
                
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" name="password_confirmation">
                
                    <button type="submit">
                      Edit
                    </button>    
            </section>
        @endif
    </section>
@endsection