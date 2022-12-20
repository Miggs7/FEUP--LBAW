@extends('layouts.app')

@php 
   $categories = App\Http\Controllers\CategoryController::getCategories(); 
@endphp

@section('content')
    @if(!Auth::Check())
    <script>
        alert('You need to be logged in to create auctions!');
        window.history.back();
    </script>
    @endif
    <div class="d-flex justify-content-center align-items-center container my-5 ">
        <div class="card h-100">
          <div class="card-body">
<form method="POST" action={{url('auction/new')}} enctype="multipart/form-data" >
    {{ csrf_field() }}
    <p class="description-p pe-0 pe-lg-0">
        Create New Auction
    </p>

    <div class="form-group">
    <label for="name">Name:</label>
    <input id="name" type="text" class="form-control" name="name" pattern="^[A-Za-z \s*]+$" required>
    @if ($errors->has('name'))
    <span class="error">
        {{ $errors->first('name') }}
    </span>
    @endif
    </div>

    <div class="form-group">
    <label for="description">Description: </label>
    <input id="description" type="text" class="form-control" name="description" pattern="^[A-Za-z \s*]+$" required>
    @if ($errors->has('description'))
    <span class="error">
        {{ $errors->first('description') }}
    </span>
    @endif
    </div>
    
    <div class="form-group">
    <label for="ending_date">Ending Date:</label>
    <input id="ending_date" type="date" class="form-control" name="ending_date" min="{{now()}}" required>
    @if ($errors->has('ending_date'))
    <span class="error">
         Invalid Date!
    </span>
    @endif
    </div>
    
    {{-- don't forget to hash passwords in the function of edit user --}}
    <div class="form-group">
    <label for="starting_bid">Starting Bid: </label>
    <input id="starting_bid" type="number" class="form-control" name="starting_bid" min="5" required>
    @if ($errors->has('starting_bid'))
    <span class="error">
        {{ $errors->first('starting_bid') }}
    </span>
    @endif
    </div>

    <div class="form-group">
    <label for="item">Item:</label>
    <input id="item" type="text" class="form-control" pattern="^[A-Za-z \s*]+$" name="item">
    @if ($errors->has('item'))
    <span class="error">
        {{ $errors->first('item') }}
    </span>
    @endif
    </div>

    <div class="form-group">
    <label for="category"></label>Category:</label>
    <p class="m-0"></p>
    @foreach($categories as $category)
    <label for={{$category['name']}}></label>{{$category['type']}}</label>
    <input id="category" type="checkbox" name="category" class="form-check-input" value={{$category['id']}}>
    @endforeach
    @if ($errors->has('category'))
    <span class="error">
        {{ $errors->first('category') }}
    </span>
    @endif
    </div>

    <div class="form-group mb-2">
    <label for="image">Image:</label>
    <input id="image" type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg" required>
    </div>
    @if ($errors->has('image'))
    <span class="error">
        Please upload JPG,PNG or JPEG!
    </span>
    @endif
    
    <input id="id_auctioneer" type="hidden" name="id_auctioneer" value={{Auth::user()?->id}} required>
    <input id="today" type="hidden" name="today" value={{now()}} required>

    <div class="d-flex justify-content-center align-items-center container">
    <button type="submit" class="btn btn-primary">
      Create
    </button>
    </div>
</form>
          </div>
    </div>
</div>
@endsection
