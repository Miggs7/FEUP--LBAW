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
<form method="POST" action={{url('new')}}>
    {{ csrf_field() }}
    <p class="description-p pe-0 pe-lg-0">
        Create New Auction
    </p>

    <div class="form-group">
    <label for="name">Name:</label>
    <input id="name" type="text" class="form-control" name="name" required>
    </div>

    <div class="form-group">
    <label for="description">Description: </label>
    <input id="description" type="text" class="form-control" name="description" required>
    </div>
    
    <div class="form-group">
    <label for="ending_date">Ending Date:</label>
    <input id="ending_date" type="date" class="form-control" name="ending_date" required>
    </div>
    
    {{-- don't forget to hash passwords in the function of edit user --}}
    <div class="form-group">
    <label for="starting_bid">Starting Bid: </label>
    <input id="starting_bid" type="number" class="form-control" name="starting_bid" required>
    </div>

    <div class="form-group">
    <label for="item">Item:</label>
    <input id="item" type="text" class="form-control" name="item">
    </div>

    <div class="form-group">
    <label for="category"></label>Category:</label>
    <p class="m-0"></p>
    @foreach($categories as $category)
    <label for={{$category['name']}}></label>{{$category['type']}}</label>
    <input id="category" type="checkbox" name="category" class="form-check-input" value={{$category['id']}}>
    @endforeach
    </div>

    <div class="form-group mb-2">
    <label for="image">Image URL</label>
    <input id="image" type="text" name="image" class="form-control">
    </div>
    
    @if(Auth::user())
    <input id="id_auctioneer" type="hidden" name="id_auctioneer" value={{Auth::user()->id}}>
    @endif
    <button type="submit" class="btn btn-primary justify-content-center">
      Create
    </button>
</form>
          </div>
    </div>
</div>
@endsection
