<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
  /**
   * Gets bids by his auction.
   *
   * @param  int  $id_auction
   * @return array
   */
  public static function getAuctionBids($id_auction){
    $bids = [];
    foreach(Bid::all() as $bid){
        if($bid->id_auction == $id_auction){
            $bids[] = $bid;
        }
    }
    return $bids;
  }

  public static function getWinningBid($id_auction){
    
    $win = DB::table('bid')
            ->select('id_bidder',DB::raw('max(bid_value) as bid_value'))
            ->where('id_auction',$id_auction)
            ->groupBy('id_bidder')
            ->get();

    return $win;
  }
}
?>