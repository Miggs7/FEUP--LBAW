@extends('layouts.app')

@section('content')
    @php
    /*get auction category from database using ID*/
    $id = request()->route('id');
    $counter = 0;
    $category = App\Http\Controllers\CategoryController::getCategoryById($id);
    $auctionArray = App\Http\Controllers\AuctionCategoryController::getAuctionByCategory($category->id);
    @endphp
    <div class="h-100 d-flex align-items-center justify-content-center">
        <h2 class="categories-titles my-3" id="{{$category['type']}}"> {{$category['type']}} </h2>
    </div>
        <hr class="mb-5">
    <div class="container">
            <div class="row">
    @foreach($auctionArray as $auction)

        @php
        //$category = App\Http\Controllers\CategoryController::getCategoryById($auction->id);
        $auction = App\Http\Controllers\AuctionController::getAuction($auction->id);
        $img = App\Http\Controllers\AuctionImageController::getAuctionImage($auction->id);
        $counter++;
        @endphp
        
        
        <div class="col-lg-4 align-items-stretch">
            <div class="card mb-4">
                <div class="card-body text-center">
                        <a href="{{url('/auction/'.$auction->id)}}">
                            <img src= "{{$img['link']}}" class="figure-img img-fluid category" alt="Auction image" width="150" height="150">
                        </a>
                  <h5 class="my-3">{{$auction['name']}}</h5>
                  <p class="text mb-1">{{$auction['current_bid']}} $</p>
                </div>
              </div>
        </div>
    {{--every row will have 3 --}}
    @if($counter % 3 == 0)
        <div class="row">
    @endif
    @endforeach 
        </div>
    </div>
</div>
@endsection