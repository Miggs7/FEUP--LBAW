@extends('layouts.app')

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $counter = 0;
    $user = App\Http\Controllers\UserController::getUserById($id); 
    /*array with auctions that user put up for auction*/
    $list = App\Http\Controllers\AuctionListController::auctioneerAuctions($id); 
@endphp

@section('content')

<div class="h-100 d-flex align-items-center justify-content-center">
    <h2 class="categories-titles my-3" id="{{$user['username']}}"> {{$user['username']}}'s Auctionlist </h2>
</div>
    <hr class="mb-5">
<div class="container d-flex flex-wrap justify-content-center p-2">
        @foreach($list as $l)
            @php
            $auction = App\Http\Controllers\AuctionController::getAuction($l->id_auction);
            $img = App\Http\Controllers\AuctionImageController::getAuctionImage($l->id_auction);
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
@endforeach 
</div>
@endsection
