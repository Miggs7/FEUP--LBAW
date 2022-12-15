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
<div class="container">
        <div class="row">
        @foreach($list as $l)
            @php
            $auction = App\Http\Controllers\AuctionController::getAuction($l->id_auction);
            $img = App\Http\Controllers\AuctionImageController::getAuctionImage($l->id_auction);
            $counter++;
            @endphp

<div class="col-sm">
            <figure class="img-column">
                <a href={{url("/auction/".$l->id_auction)}}><img src= "{{$img['link']}}" alt="Auction image" width="200" height="200"></a>
                <figcaption>{{$auction['name']}}</figcaption>   
            </figure>
</div>
@if($counter % 3 == 0)
<div class="row">
@endif
@endforeach 
    </div>
</div>
@endsection
