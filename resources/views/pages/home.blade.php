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
        @for($i = 1; $i <= 3; $i++)

            @php
            $category = App\Http\Controllers\CategoryController::getCategoryById($i);
            $auction = App\Http\Controllers\AuctionController::getAuction($i);
            $img = App\Http\Controllers\AuctionImageController::getAuctionImage($i);
            @endphp

            <figure class="img-column">
                <a href="{{url('/auction/'.$i)}}">
                    <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
                </a>
                    <figcaption>{{$auction['name']}}</figcaption>
            </figure>
        @endfor   
        </div>
    @endfor

  </section>
@endsection