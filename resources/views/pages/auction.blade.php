@extends('layouts.app')

@php
    /*get auction from database using ID*/
    $id = request()->route('id');
    $auction = App\Http\Controllers\AuctionController::getAuction($id);
@endphp

@section('content')
<div>This is the {{ $auction['name']}} Auction Page</div>
@endsection