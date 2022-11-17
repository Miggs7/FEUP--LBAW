<?php

namespace App\Http\Controllers;

use App\Models\AuctionList;
use Illuminate\Http\Request;

class AuctionListController extends Controller{
  /**
   * Gets auction by it's id_auction.
   *
   * @param  int  $id
   * @return Response
   */
  public static function getAuctioneer($id_auction){ 
        foreach (AuctionList::all() as $auction_list){
            if($auction_list->id_auction == $id_auction){
              return $auction_list->id_auctioneer;
            }
        }        
    }    
}