@extends('layouts.app')

@php
    /*in case we're in other use profile we'll need to get his profile*/
    $id = request()->route('id');
    $user = App\Http\Controllers\UserController::getUserById($id); 
    /*array with auctions that user is watching*/
    $watching = App\Http\Controllers\WatchListController::getBidderWatchList($id); 
@endphp

@section('content')
<section id="auction-container">
    <div class="second-header">
        <div class="categories">
            <a href="#header" class="category"> Home </a>
            @for($j = 1; $j <= 7; $j++)
                @php
                /*get auction category from database using ID*/
                $category = App\Http\Controllers\CategoryController::getCategoryById($j);
                @endphp
                <a href="#{{$category['type']}}" class="category"> {{$category['type']}} </a>
            @endfor
        </div>
        <hr>
    </div>
</section>

<div class="watch-list">
    <div>
        <h2>Watch List</h2>
        <p>User: {{ $user['username']}}</p>
        <p>Name: {{$user['name']}}</p>
        <p>Email: {{ $user['email']}}</p>
    </div>
</div>

<div class="img-row">
        @foreach($watching as $auction)
            @php
            $auction = App\Http\Controllers\AuctionController::getAuction($auction->id);
            $img = App\Http\Controllers\AuctionImageController::getAuctionImage($auction->id);
            @endphp

            <figure class="img-column">
                <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
                <figcaption>{{$auction['name']}}</figcaption>   
            </figure>
        @endforeach
</div>
@endsection
