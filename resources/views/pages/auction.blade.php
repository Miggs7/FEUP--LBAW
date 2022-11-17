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
    {{-- Bid form should only be visible to authenticated users --}}
    @if(Auth::user())
    <form method="post" action={{route('bid')}}>
        <label for="bid_value"> Bid Value:</label>
        @csrf
        <input type="number" name="bid_value">
        <input type="hidden" name="id" value={{$id}} >
        <input type="submit" value="submit">
    </form>
    @endif
</div>

@endsection