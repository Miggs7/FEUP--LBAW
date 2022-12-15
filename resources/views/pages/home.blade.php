@extends('layouts.app')



@section('content')
    @php
    $j = rand(1,7);
    $counter = 0;
    /*get auction category from database using ID*/
    $category = App\Http\Controllers\CategoryController::getCategoryById($j);
    @endphp
    <div class="h-100 d-flex align-items-center justify-content-center">
    <h2 class="categories-titles my-3" id="{{$category['type']}}"> {{$category['type']}} </h2>
    </div>
    <hr class="mb-5">
    <div class="container">
        <div class="row">
    @foreach(App\Models\Auction::all() as $auction)

        @php
        $category = App\Http\Controllers\CategoryController::getCategoryById($auction->id);
        $auction = App\Http\Controllers\AuctionController::getAuction($auction->id);
        $img = App\Http\Controllers\AuctionImageController::getAuctionImage($auction->id);
        $counter++;
        @endphp

        <div class="col-sm">
        <figure class="img-column">
            <a href="{{url('/auction/'.$auction->id)}}">
                <img src= "{{$img['link']}}" alt="Auction image" width="200" height="200">
            </a>
                <figcaption>
                    <div>{{$auction['name']}}</div>
                    <div>{{$auction['current_bid']}} $</div>
                </figcaption>
        </figure>
        </div>
        {{--every row will have 3 --}}
        @if($counter % 3 == 0)
            <div class="row">
        @endif
    @endforeach 
        </div>
    </div>
</div>
@endsection