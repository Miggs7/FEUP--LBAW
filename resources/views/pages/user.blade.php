@extends('layouts.app')

{{-- Only logged users should see profiles 
@if (!Auth::user())
    @php die(header('Location: /'));
    echo 'This is not your profile!'
    @endphp
@endif
--}}
@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $user = App\Http\Controllers\UserController::getUserById($id);
    $is_banned = App\Http\Controllers\UserController::checkIfBanned($id);
    
@endphp

@section('content')
<div class="d-flex justify-content-center align-items-center my-5">
<div class="row">
    <div class="col">
      <div class="card mb-4">
        <div class="card-body text-center">
          @if($user->profile_picture)
          <img src="{{$user['profile_picture']}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
          @else
          <img src="{{url('/images/profile/default.png')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
          @endif
          <h5 class="my-3">{{$user['username']}}</h5>
          <p class="text-muted mb-1">{{$user['name']}}</p>
          <p class="text-muted mb-1">{{$user['email']}}</p>
          @if(Auth::guard('web')->user()?->id == $id && !$is_banned)
          <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#form">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-pencil-fill" viewBox="0 0 16 16">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
          </button>  
          @endif
            {{--create reviews page--}}
            <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                    <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                  </svg>
            </button>
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
      <form form method="POST" action={{url('user/'.$id.'/edit')}} enctype="multipart/form-data">
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
          <label for="username" class="username">Username</label>
          <input id="username" type="text" name="username" class="form-control" value="{{ old('username') }}">
          @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
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

</section>
        
@endsection
