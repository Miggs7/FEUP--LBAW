@extends('layouts.app')



@section('content')
<section id="auction-container">
    <div class="categories">
        <div class="category"> Home </div>
        @for($j = 1; $j <= 5; $j++)
            @php
            /*get auction category from database using ID*/
            $category = App\Http\Controllers\CategoryController::getCategoryById($j);
            @endphp
            <div class="category"> nome: {{$category['category_name']}} </div>
        @endfor
    </div>
    <hr>
    <div class="img-row">
    @for($i = 1; $i <= 3; $i++)
        @php
        /*get auction from database using ID*/
        $auction = App\Http\Controllers\AuctionController::getAuction($i);
        $img = App\Http\Controllers\AuctionImageController::getAuctionImage($i);
        @endphp
        <figure class="img-column">
            <a href="{{url('/auction/'.$i)}}">
                <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
            </a>
                <figcaption>This is {{$auction['name']}}</figcaption>
        </figure>
    @endfor   
    </div>
  </section>
@endsection