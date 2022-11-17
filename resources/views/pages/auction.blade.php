@extends('layouts.app')

@php
    /*get auction from database using ID*/
    $id = request()->route('id');
    $auction = App\Http\Controllers\AuctionController::getAuction($id);
    $img = App\Http\Controllers\AuctionImageController::getAuctionImage($id);
    /*get auctioneer info*/
    $auctioneer_id = App\Http\Controllers\AuctionListController::getAuctioneer($id);
    $auctioneer = App\Http\Controllers\UserController::getUserById($id);
    $date = date('Y-m-d', strtotime($auction['ending_date']));

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
    <p> Ends in: {{$date}}</p>
    <p> Username of the auctioneer: {{$auctioneer['username']}}</p>
    {{-- Bid form should only be visible to authenticated users --}}
    @if(Auth::user() && ($auction['ongoing'] == TRUE))
    <form method="post" action={{route('bid')}}>
        <label for="bid_value"> Bid Value:</label>
        @csrf
        <input type="number" name="bid_value">
        <input type="hidden" name="id" value={{$id}} >
        <input type="submit" value="submit">
    </form>
    @endif
    {{-- Update or delete if owner of auction --}}
    @if(Auth::user())
        @if(Auth::user()->id == $auctioneer_id)
        <p> this is the owner</p>
        <form method="post" action={{route('updateAuction')}}>
            @csrf
            <label for="name"> Name:</label>
            <input type="text" name="name">
            
            <label for="description"> Description:</label>
            <input type="text" name="description">

            <label for="starting_bid"> Starting Bid:</label>
            <input type="number" name="starting_bid">

            <label for="ending_date"> Ending date:</label>
            <input type="date" name="ending_date">

            <label for="id_item"> Id item:</label>
            <input type="number" name="id_item">

            <label for="ongoing"> Ongoing</label>
            <input type="checkbox" name="ongoing" value="1" checked>

            <label for="ongoing"> Stopping</label>
            <input type="checkbox" name="ongoing" value="0">

            <input type="hidden" name="id" value={{$id}} >
            <input type="submit" value="submit">

        </form>
        @endif
    @endif
</div>

@endsection