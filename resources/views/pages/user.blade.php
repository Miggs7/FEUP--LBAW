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
  <section id="about-section" class="pt-5 pb-5">
    <div class="container wrapabout">
        <div class="red"></div>
        <div class="row">
            <div class="col-lg-6 align-items-center justify-content-left d-flex mb-5 mb-lg-0">
                <div class="blockabout">
                    <div class="blockabout-inner text-center text-sm-start">
                        <div class="title-big pb-3 mb-3">
                            <h3>{{ $user['username']}}</h3>
                        </div>
                        <p class="description-p text-muted pe-0 pe-lg-0">
                           Email: {{ $user['email']}}
                        </p>
                        <p class="description-p text-muted pe-0 pe-lg-0">
                           Name: {{$user['name']}}
                        </p>
                        <a href="#" class="btn rey-btn mt-3">See More</a>
                    </div>
                </div>
            </div>
            
            @if (Auth::user()->id == $user['id'])
            <div class="col-lg-6 align-items-center justify-content-left d-flex mb-5 mb-lg-0">
                <div class="blockabout">
                    <div class="blockabout-inner text-center text-sm-start">
            <form method="POST" action={{url('/edit')}}>
                {{ csrf_field() }}
                <p class="description-p text-muted pe-0 pe-lg-0">
                    Edit user:
                </p>
                <input type="hidden" name="id" value={{$id}} >
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                  <span class="error">
                      {{ $errors->first('name') }}
                  </span>
                @endif

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
                @endif
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
        
@endsection
