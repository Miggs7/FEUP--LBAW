<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
  /**
   * Gets auction by it's id.
   *
   * @param  int  $id
   * @return Response
   */
  public static function getAuction($id)
  {
    $auction = Auction::find($id);
    return $auction;
  }

    /**
   * function updates bid.
   *  
   * @param Request $request
   * @return redirect
   */
  public static function bid(Request $request)
  { 
    $input = $request->input();
    $auction = Auction::find($input['id']);

    if($auction->current_bid < $input['bid_value']){
      $auction->current_bid  = $input['bid_value'];
      $auction->save();
    }
    return redirect('/auction/'.$auction->id);
  }
}