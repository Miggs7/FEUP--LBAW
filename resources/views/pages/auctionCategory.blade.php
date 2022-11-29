@extends('layouts.app')

@section('content')
<section id="auction-container">
    @php
    /*get auction category from database using ID*/
    $id = request()->route('id');
    $category = App\Http\Controllers\CategoryController::getCategoryById($id);
    $auctionArray = App\Http\Controllers\AuctionCategoryController::getAuctionByCategory($category->id);
    @endphp
    <div class="categories-titles" id="{{$category['type']}}"> {{$category['type']}} </div>
    <hr>
    <div class="img-row">
    @foreach($auctionArray as $auction)

        @php
        //$category = App\Http\Controllers\CategoryController::getCategoryById($auction->id);
        $auction = App\Http\Controllers\AuctionController::getAuction($auction->id);
        $img = App\Http\Controllers\AuctionImageController::getAuctionImage($auction->id);
        @endphp

        <figure class="img-column">
            <a href="{{url('/auction/'.$auction->id)}}">
                <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
            </a>
            <figcaption>
                <div>{{$auction['name']}}</div> 
                <div>{{$auction['current_bid']}}$</div>
            </figcaption>
        </figure>
    @endforeach 
    </div>
  </section>
@endsection