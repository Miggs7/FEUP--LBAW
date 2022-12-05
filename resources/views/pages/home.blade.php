@extends('layouts.app')



@section('content')
<section id="auction-container">
    @php
    $j = rand(1,7);
    /*get auction category from database using ID*/
    $category = App\Http\Controllers\CategoryController::getCategoryById($j);
    @endphp
    <div class="categories-titles" id="{{$category['type']}}"> {{$category['type']}} </div>
    <hr>
    <div class="img-row">
    @foreach(App\Models\Auction::all() as $auction)

        @php
        $category = App\Http\Controllers\CategoryController::getCategoryById($auction->id);
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