{{--@extends('layouts.app')

{{-- Only logged users should see profiles --}}
{{--
@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $manager = App\Http\Controllers\ManagerController::getManagerById($id);
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
                            <h3>{{ $manager['name']}}</h3>
                        </div>
                        <p class="description-p text-muted pe-0 pe-lg-0">
                           Email: {{ $manager['email']}}
                        </p>
                        <a href="#" class="btn rey-btn mt-3">See More</a>
                    </div>
                </div>
            </div>
</section>
        
@endsection
--}}

@extends('layouts.app')

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $manager = App\Http\Controllers\ManagerController::getManagerById($id);
    
@endphp

@section('content')
<div class="d-flex justify-content-center align-items-center my-5">
<div class="row">
    <div class="col">
      <div class="card mb-4">
        <div class="card-body text-center">
          {{--@if($user->profile_picture)
          <img src="{{$user['profile_picture']}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
          @else--}}
          <img src="{{url('/images/profile/default.png')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
          {{--@endif--}}
          <h5 class="my-3">{{$manager['name']}}</h5>
          <p class="text-muted mb-1">{{$manager['email']}}</p>
          @if(Auth::guard('manager')->user()?->id == $id)
          <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#form">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-pencil-fill" viewBox="0 0 16 16">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
          </button>  
            {{--list users--}}
            <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#users">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                  </svg>
            </button>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
</div>

<!-- edit user modal form-->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form form method="POST" action={{url('manager/'.$id.'/edit')}} enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="id" value="{{$id}}">
        <div class="modal-body">
          <div class="form-group mb-2">
            <label for="name">Name</label>
          <input id="name" type="text" name="name" class="form-control"  value="{{ old('name') }}">
          @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
          @endif
          </div>
      
          <div class="form-group mb-2">
            <label for="email">E-Mail Address</label>
          <input id="email" type="email" name="email" class="form-control"  value="{{ old('email') }}">
          @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
          @endif
          </div>
      
          <div class="form-group mb-2">
            <label for="password" class="password">Password</label>
          <input id="password" type="password" class="form-control"  name="password">
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif
          </div>
      
          <div class="form-group mb-2">
            <label for="password-confirm">Confirm Password</label>
          <input type="password" id="password-confirm" class="form-control"  name="password_confirmation">
          </div>

          <div class="form-group mb-2">
            <label for="image">Image:</label>
            <input id="image" type="file" name="image" class="form-control">
            </div>
            @if ($errors->has('image'))
            <span class="error">
                Please upload JPG,PNG or JPEG!
            </span>
            @endif

        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

{{--this modal will be used to list users, put ban submit next to them and a button to go to user's auctionlist--}}
<div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Users</h5>
        </div>
        @foreach(App\Models\User::all() as $user)
        <a href={{url('/user/'.$user['id'])}}><p>{{$user['username']}}</p></a>
      @endforeach
      </div>
    </div>
</div>

        
@endsection

