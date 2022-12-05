@extends('layouts.app')

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $user = App\Http\Controllers\UserController::getUserById($id); 
    /*array with auctions that user is watching*/
    $watching = App\Http\Controllers\WatchListController::getBidderWatchList($id); 
@endphp

@section('content')

<div class="watch-list">
    <div>
        <h2>Watch List</h2>
    </div>
</div>

<div class="img-row">
        @foreach($watching as $watch)
            @php
            $auction = App\Http\Controllers\AuctionController::getAuction($watch->id_auction);
            $img = App\Http\Controllers\AuctionImageController::getAuctionImage($watch->id_auction);
            @endphp

            <figure class="img-column">
                <a href={{url("/auction/".$watch->id_auction)}}><img src= "{{$img['link']}}" alt="Auction image" width="200" height="200"></a>
                <figcaption>{{$auction['name']}}</figcaption>   
            </figure>
        @endforeach
</div>
@endsection
