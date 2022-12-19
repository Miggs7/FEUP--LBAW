@extends('layouts.app')

@php
    /*get auction from database using ID*/
    $id = request()->route('id');
    $auction = App\Http\Controllers\AuctionController::getAuction($id);
    $img = App\Http\Controllers\AuctionImageController::getAuctionImage($id);
    /*get auctioneer info*/
    $auctioneer_id = App\Http\Controllers\AuctionListController::getAuctioneer($id);
    $auctioneer = App\Http\Controllers\UserController::getUserById($auctioneer_id);

    /*check if auction is on watch_list*/
    if(Auth::check()){
        $is_watched = App\Http\Controllers\WatchListController::isOnWatchList($id,Auth::user()->id);
    }
    else $is_watched = false;
    
    /*button will be hidden if time has passed*/
    $date = ($auction['ending_date']);
    $now = time();
    $now_time_stamp = date("Y-m-d H:i:s", $now);

    $bids = App\Http\Controllers\BidController::getAuctionBids($id);

    $winner = App\Http\Controllers\BidController::getWinningBid($id);

    $payed = App\Http\Controllers\PaymentController::checkPayment($id);

@endphp

@section('content')
<div class="d-flex justify-content-center align-items-center my-5">
<div class="row">
    <div class="col">
      <div class="card mb-4">
        <div class="card-body text-center">
          <img src="{{url($img['link'])}}" alt="auction image" class="img-fluid" style="width: 150px;">
          <h5 class="my-3">{{$auction['name']}}</h5>
          <p class="text mb-1">Description: {{$auction['description']}}</p>
          <p class="text mb-1">Ending date: {{$auction['ending_date']}}</p>
          <p class="text mb-1">Current bid: {{$auction['current_bid']}} $</p>
          <p class="text mb-1">Auctioneer : {{$auctioneer['name']}}</p>
          <a href="#" data-bs-toggle="modal" data-bs-target="#bids">{{count($bids)}} bids</a>
          <div class="d-flex auction justify-content-center align-items-center">
            @if(((Auth::user('web')?->id == $auctioneer_id) || (Auth::guard('manager'))?->user()) && $auction['ongoing'])
            <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#form">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
            </button>
            <form action="{{url('auction/'.$id.'/delete/')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value={{$id}} >
                <button type="submit" class="btn btn-primary profile" value="delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                </button>
            </form>
          </div>
            @else
            {{--this should only appear if ongoing--}}
            @if($auction['ongoing'] && now() >= $auction['ending_date'])
            <form method="post" action={{url('auction/'.$id.'/bid/')}}>
                @csrf
                @method('PUT')
                <input type="hidden" name="id_bidder" value="{{Auth::user('web')?->id}}">
                @if($errors->has('id_bidder'))
                <span class="error">
                     Please login! 
                </span>
                @endif
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="current_bid" value="{{$auction['current_bid']}}">
                <label for="bid_value"> Bid Value:</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder=" > {{$auction['current_bid']}}" name="bid_value">
                    <button type="submit" class="btn btn-primary input-group-append">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="IconChangeColor" width="16" height="16"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M512 216.3c0-6.125-2.344-12.25-7.031-16.93L482.3 176.8c-4.688-4.686-10.84-7.028-16.1-7.028s-12.31 2.343-16.1 7.028l-5.625 5.625L329.6 69.28l5.625-5.625c4.687-4.688 7.03-10.84 7.03-16.1s-2.343-12.31-7.03-16.1l-22.62-22.62C307.9 2.344 301.8 0 295.7 0s-12.15 2.344-16.84 7.031L154.2 131.5C149.6 136.2 147.2 142.3 147.2 148.5s2.344 12.25 7.031 16.94l22.62 22.62c4.688 4.688 10.84 7.031 16.1 7.031c6.156 0 12.31-2.344 16.1-7.031l5.625-5.625l113.1 113.1l-5.625 5.621c-4.688 4.688-7.031 10.84-7.031 16.1s2.344 12.31 7.031 16.1l22.62 22.62c4.688 4.688 10.81 7.031 16.94 7.031s12.25-2.344 16.94-7.031l124.5-124.6C509.7 228.5 512 222.5 512 216.3zM227.8 238.1L169.4 297.4C163.1 291.1 154.9 288 146.7 288S130.4 291.1 124.1 297.4l-114.7 114.7c-6.25 6.248-9.375 14.43-9.375 22.62s3.125 16.37 9.375 22.62l45.25 45.25C60.87 508.9 69.06 512 77.25 512s16.37-3.125 22.62-9.375l114.7-114.7c6.25-6.25 9.376-14.44 9.376-22.62c0-8.185-3.125-16.37-9.374-22.62l58.43-58.43L227.8 238.1z" id="mainIconPathAttribute"></path>
                        </svg>
                    </div>
                  </div>
                  @if ($errors->has('bid_value'))
                  <span class="error">
                      Your bid is too low!
                  </span>
                  @endif
            </form>
            @if(!$is_watched)
                    <form method="post" action={{url('watchList/'.$id.'/add/')}}>
                        @csrf
                            <input type="hidden" name="id_auction" value={{$id}}>
                            <input type="hidden" name="id_bidder" value="{{Auth::user('web')?->id}}">
                            @if($errors->has('id_bidder'))
                            <span class="error">
                                 Please login! 
                            </span>
                            @endif
                            <button submit="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                    </form>
            @else
                {{--implement a confirmation message here--}}
                <form method="post" action={{url('watchList/'.$id.'/delete/')}}>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_auction" value={{$id}} >
                    <input type="hidden" name="id_bidder" value={{Auth::user()->id}} >
                    <button submit="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                          </svg>
                    </button>
                </form>
            @endif 
            @php 
            @endphp
            @elseif((Auth::user('web')?->id == $auctioneer_id) || Auth::user('web')?->id == $winner[0]->id_bidder)
            <button type="button" class="btn btn-primary profile" data-bs-toggle="modal" data-bs-target="#win">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                </svg>
            </button>
            @endif
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
</div>

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Edit Auction</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form form method="POST" action={{url('auction/'.$id.'/edit')}}>
          {{ csrf_field() }}
          @method('PUT')
          <input id="id" type="hidden" name="id" value="{{$id}}">
          <div class="modal-body">
            <div class="form-group mb-2">
              <label for="name">Name</label>
            <input id="name" type="text" name="name" class="form-control"  value="{{ old('name') }}">
            @if ($errors->has('name'))
              <span class="error">
                  {{ $errors->first('name') }}
              </span>
            @endif
            </div>
        
            <div class="form-group mb-2">
              <label for="description">Description</label>
            <input id="description" type="text" name="description" class="form-control"  value="{{ old('description') }}">
            @if ($errors->has('description'))
              <span class="error">
                  {{ $errors->first('description') }}
              </span>
            @endif
            </div>
        
            <div class="form-group mb-2">
            <label for="ending_date">Ending Date</label>
            <input id="ending_date" type="date" name="ending_date" class="form-control" value="{{ old('ending_date') }}">
            @if ($errors->has('ending_date'))
              <span class="error">
                  {{ $errors->first('ending_date') }}
              </span>
            @endif
            </div>

            <label for="ongoing">Ongoing</label>
            <div class="h-100 d-flex">
            <label for="ongoing">Yes</label>
            <input id="ongoing" type="checkbox" class="form-check-input"  name="ongoing" value="1" checked>
              <label for="ongoing">No</label>
            <input id="ongoing" type="checkbox" class="form-check-input"  name="ongoing" value="0">
            @if ($errors->has('ongoing'))
              <span class="error">
                  {{ $errors->first('ongoing') }}
              </span>
            @endif
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="bids" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Bid History</h5>
        </div>
        @foreach($bids as $bid)
        @php $bidder = App\Http\Controllers\UserController::getUserById($bid['id_bidder']) @endphp
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Bidder</th>
                <th scope="col">Bid</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">{{$bid->id}}</th>
                <td>{{$bidder->username}}</td>
                <td>{{$bid->bid_value}}</td>
              </tr>
        @endforeach
            </table>
            </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="win" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="d-flex flex-column justify-content-center align-items-center my-5">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Winner</h5>
        </div>
        @if(isset($winner[0]->id_bidder))
        @php
            $user_winner = App\Http\Controllers\UserController::getUserById($winner[0]->id_bidder)->username;
        @endphp
        <p>{{$user_winner}} who bid {{$winner[0]->bid_value}} $</p>
        {{--form to pay--}}
        @if(Auth::user('web')?->id == $winner[0]->id_bidder && !$payed)
        <form method="POST" action={{url('auction/'.$id.'/pay')}}>
            {{ csrf_field() }}
            <input id="id" type="hidden" name="id_bidder" value="{{$winner[0]->id_bidder}}">
            <input id="id" type="hidden" name="id_auctioneer" value="{{$auctioneer_id}}">
            <input id="id" type="hidden" name="id_auction" value="{{$id}}">
            <input id="id" type="hidden" name="value" value="{{$winner[0]->bid_value}}">
            <div class="modal-footer border-top-0 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                  </svg>
                </button>
            </div>
        </form>
        @elseif((Auth::user('web')?->id == $auctioneer_id))
            @if(!$payed)<p class="text mb-1 text-muted">Payment Pending...</p>
            @else
                <p class="text mb-1 text-muted">Payed!</p>
            @endif
        @endif
        @endif
      </div>
    </div>
  </div>
</div>
@endsection