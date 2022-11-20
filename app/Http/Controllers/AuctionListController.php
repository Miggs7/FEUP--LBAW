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
        foreach (AuctionList::all() as $auction){
            if($auction->id_auction == $id_auction){
              return $auction->id_auctioneer;
            }
        }        
    }
  public static function auctioneerAuctions($id_auctioneer){
      $auctions = array();
      foreach(AuctionList::all() as $auction){
        if($auction->id_auctioneer == $id_auctioneer){
          $auctions[] = $auction;
        }
      }
      return $auctions;
  }
  
  public static function create($id_auctioneer,$id_auction){
    $auction_list = new AuctionList;
    $auction_list->id_auctioneer = $id_auctioneer;
    $auction_list->id_auction = $id_auction;
    $auction_list->save();
  }
}