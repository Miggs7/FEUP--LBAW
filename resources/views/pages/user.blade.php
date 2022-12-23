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
    $received_feedback = App\Http\Controllers\ReviewController::getAuthorReviews($id);
    $sent_feedback = App\Http\Controllers\ReviewController::getReceivedReviews($id);
    
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
          @if($user->profile_picture)
          <img src="{{$user['profile_picture']}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
          @else
          <img src="{{url('/images/profile/default.png')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
          @endif
          <h5 class="my-3">{{$user['username']}}</h5>
          <p class="text-muted mb-1">{{$user['name']}}</p>
          <p class="text-muted mb-1">{{$user['email']}}</p>
          <div class="d-flex justify-content-center align-items-center">
          @if(Auth::guard('web')->user()?->id == $id && !$is_banned)
          <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#form">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-pencil-fill" viewBox="0 0 16 16">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
          </button>
            <button type="submit" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
            </button>
          @endif
            {{--create reviews page--}}
            <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#reviews">
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
</div>

<!-- edit user modal form-->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="d-flex flex-column justify-content-center align-items-center">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="btn-close close mx-0 my-0" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      </div>
      <form method="POST" action={{url('user/'.$id.'/edit')}} enctype="multipart/form-data">
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
          <label for="username" class="username">Username</label>
          <input id="username" type="text" name="username" class="form-control"  pattern="[^' ']+" value="{{ old('username') }}">
          @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
          @endif
          </div>
      
          <div class="form-group mb-2">
            <label for="password" class="password">Password</label>
          <input id="password" type="password" class="form-control" name="password">
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif
          </div>
      
          <div class="form-group mb-2">
            <label for="password-confirm">Confirm Password</label>
          <input type="password" id="password-confirm" class="form-control" name="password_confirmation">
          </div>

          <div class="form-group mb-2">
            <label for="image">Image:</label>
            <input id="image" type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg">
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

{{--change this to help auctioneer,bidder and manager--}}
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpUserModal" aria-hidden="true">
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
              <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                    <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"></path>
                  </svg>
            </button>
            </th>
            <td>My Reviews</td>
          </tr>
        </table>
        </div>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="reviews" tabindex="-1" role="dialog" aria-labelledby="reviewModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="d-flex flex-column justify-content-center align-items-center my-5">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Received Reviews</h5>
        <button type="button" class="btn-close close mx-0 my-0" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      </div>
      <div class="table-responsive">

        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Receiver</th>
              <th scope="col">Comment</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sent_feedback as $sent)
            <tr>
              @if($sent['id_bidder'] == $id)
              <td>{{App\Http\Controllers\UserController::getUserById($sent['id_auctioneer'])}} </td>
              @else
              <td>{{App\Http\Controllers\UserController::getUserById($sent['id_bidder'])}} </td>
              @endif
              <td>{{$received['comment']}}</td>
            </tr>
            @endforeach
          </table>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center my-5">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">Sent Reviews</h5>
            </div>
          </div>

          <div class="table-responsive">

            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Author</th>
                  <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
                @foreach($received_feedback as $received)
                <tr>
                  <td>{{App\Http\Controllers\UserController::getUserById($received['author'])}} </td>
                  <td>{{$received['comment']}}</td>
                </tr>
                @endforeach
              </table>
            </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="d-flex flex-column justify-content-center align-items-center">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
      </div>

      <form action="{{url('user/'.$id.'/delete/')}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value={{$id}}>
        <p>Are you Sure?</p>
        <div class="d-flex flex-column justify-content-center align-items-center">
        <button type="submit" class="btn btn-primary profile">Yes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

</section>
        
@endsection
