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
        <div class="help">
          <a href="#" data-bs-toggle="modal" data-bs-target="#help">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
            </svg>
          </a>
        </div>
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
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Help</h5>
          <button type="button" class="btn-close close mx-0 my-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
      <form form method="POST" action={{url('manager/'.$id.'/edit')}} enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="id" value="{{$id}}">
        <div class="modal-body">
          <div class="form-group mb-2">
            <label for="name">Name</label>
          <input id="name" type="text" name="name" class="form-control" pattern="^[A-Za-z \s*]+$"  value="{{ old('name') }}">
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
            <input id="image" type="file" name="image" accept=".jpg,.png,.jpeg" class="form-control">
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
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Help</h5>
          <button type="button" class="btn-close close mx-0 my-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>   
        <div class="table-responsive">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Name</th>
              <th scope="col">Ban</th>
              <th scope="col">AuctionList</th>
            </tr>
          </thead>
          <tbody>
            @foreach(App\Models\User::all()->sortBy('id') as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td><a href={{url('/user/'.$user->id)}}>{{$user->username}}</a></td>
              <td>{{$user->name}}</td>
              <form form method="POST" action={{url('user/'.$id.'/ban')}} enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <input type="hidden" name="id" value={{$user->id}}>
              @if(!$user->is_banned)
                <input type="hidden" name="ban" value="1">
                <td>
                <button type="submit" class="btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-slash" viewBox="0 0 16 16">
                    <path d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465l3.465-3.465Zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465Zm-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                  </svg>
                </button>
                </td>
              @else
              <input type="hidden" name="ban" value="0">
              <td>
                <button type="submit" class="btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-slash" viewBox="0 0 16 16">
                    <path d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465l3.465-3.465Zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465Zm-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                  </svg>
                </button>
                </td>
              @endif
              </form>
              <td><a href={{url('/auctionlist/'.$user->id)}}>Auctions</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
</div>

{{--change this to help auctioneer,bidder and manager--}}
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Help</h5>
          <button type="button" class="btn-close close mx-0 my-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
      <div class="table-responsive">
  
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Button</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
              <button type="button" class="btn btn-primary profile">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
              </button>
              </th>
              <td>Edit Profile</td>
            </tr>
            <tr>
              <th scope="row">
                <button type="button" class="btn btn-primary profile">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                      <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"></path>
                    </svg>
              </button>
              </th>
              <td>List all Users</td>
            </tr>
          </table>
          </div>
    </div>
  </div>
  </div>
  </div>

        
@endsection

