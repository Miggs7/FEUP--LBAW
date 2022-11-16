@extends('layouts.app')

@php
    /*get auction from database using ID*/
    $id = request()->route('id');
    $auction = App\Http\Controllers\AuctionController::getAuction($id);
    $img = App\Http\Controllers\AuctionImageController::getAuctionImage($id);
@endphp

@section('content')

<figure class="auction-img">
    <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
    <figcaption>This is {{$auction['name']}} Auction Page</figcaption>
</figure>

<div class="auction-info">
    <p> Starting bid: {{$auction['starting_bid']}} $</p>
    <p> Current bid: {{$auction['current_bid']}} $</p>
    <p> Description: {{$auction['description']}}</p>
    <p> Ends in: {{$auction['ending-date']}}</p>
    <a class="button" href="{{url('/auction/bid/'.$id)}}">Bid</a>
</div>

@endsection