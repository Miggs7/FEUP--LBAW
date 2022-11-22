@extends('layouts.app')



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


    @for($j = 1; $j <= 7; $j++)
        @php
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
                    <figcaption>{{$auction['name']}}</figcaption>
            </figure>
        @endforeach 
        </div>
    @endfor

  </section>
@endsection