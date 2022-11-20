@extends('layouts.app')

@php
    /*get auction from database using ID*/
    $id = request()->route('id');
    $auction = App\Http\Controllers\AuctionController::getAuction($id);
    $img = App\Http\Controllers\AuctionImageController::getAuctionImage($id);
    /*get auctioneer info*/
    $auctioneer_id = App\Http\Controllers\AuctionListController::getAuctioneer($id);
    $auctioneer = App\Http\Controllers\UserController::getUserById($auctioneer_id);
    
    /*button will be hidden if time has passed*/
    $date = ($auction['ending_date']);
    $now = time();
    $now_time_stamp = date("Y-m-d H:i:s", $now);

@endphp

@section('content')
<div id="auction-content">
    <figure class="auction-img">
        <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
        <figcaption>{{$auction['name']}}</figcaption>
    </figure>

    <div class="auction-info">
        <div>
            <div> Starting bid: </div>
            <div>{{$auction['starting_bid']}} $</div>
        </div>
        <div>
            <div>Current bid:</div>
            <div>{{$auction['current_bid']}} $</div>
        </div>
        <div>
            <div>Description:</div>
            <div> {{$auction['description']}}</div>
        </div>
        <div>
            <div>Ends in:</div>
            <div> {{$date}}</div>
        </div>
        <div>
            <div>Auctioneer:</div>
            <div>{{$auctioneer['username']}}</div>
        </div>
        
        {{-- Bid form should only be visible to authenticated users --}}
        @if(Auth::user() && ($now_time_stamp <= $date))
            @if(Auth::user()->id != $auctioneer_id)
        <form method="post" action={{url('auction/'.$id.'/bid/')}}>
            <label for="bid_value"> Bid Value:</label>
            @csrf
            @method('PUT')
            <script>
                function play() {
                  var audio = document.getElementById("audio");
                  audio.play();
                }
            </script>
            <input type="number" name="bid_value">
            <input type="hidden" name="id" value={{$id}} >
            <input type="submit" value="submit" onclick="play()">
            <audio id="audio" src="https://dl.dropboxusercontent.com/sh/jz3oyiijegxrf0z/ZgxS3tP6QY/sfx-gavelpoundx3.mp3"></audio>    
        </form>
            @endif
        @endif
    </div>
</div>
        {{-- Update or delete if owner of auction --}}
        @if(Auth::user())
            @if(Auth::user()->id == $auctioneer_id)
            <div class="auction-form">
                <form method="POST" action={{url('auction/'.$id.'/edit/')}}>
                    @csrf
                    @method('PUT')
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
            </div>
            @endif
        @endif

        {{-- delete if manager, it will break the main page for now--}}
        @if(Auth::guard('manager'))
            @if(Auth::guard('manager')->user())
            <form action="{{url('auction/'.$id.'/delete/')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value={{$id}} >
                <button type="submit" value="delete">
                    Delete auction
                </button>
            </form>
            @endif
        @endif
@endsection